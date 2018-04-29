function saveEmail() {
    event.preventDefault();
    $("#loading-image").show();

    if ( $(".invalid").html() != undefined || $("#imageText").val() == "" ) {
        $("#loading-image").hide();
        alert("Favor informar todos os campos");
        return;
    }
    var body = {};
    $("#email-creation").find(":input").each(function (key, field) {
        if (field.name == "save" || field.name == "clear") {
            return;
        }
        body[field.name] = field.value;
    });

    $.ajax({
        type: "POST",
        url: "api/create-email",
        data: JSON.stringify(body),
        success: function (data) {
            var response = JSON.parse(data);
            alert(response.message);
            if (response.code == 200) {
                $('#email-creation')[0].reset();
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Erro inesperado!");
            console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    }).done(function () {
        $("#loading-image").hide();
    });
}

function encodeImagetoBase64(element) {

    var file = element.files[0];

    var reader = new FileReader();

    reader.onloadend = function () {
        $("#imageText").val(reader.result);
    };

    reader.readAsDataURL(file);

}

$(document).ready(function () {
    $('input[name=name]').on('input', function () {
        var input = $(this);
        var is_name = input.val();
        if (is_name) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });
    $('input[name=email]').on('input', function () {
        var input = $(this);
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email = re.test(input.val());
        if (is_email) {
            input.removeClass("invalid").addClass("valid");
        } else {
            input.removeClass("valid").addClass("invalid");
        }
    });
});