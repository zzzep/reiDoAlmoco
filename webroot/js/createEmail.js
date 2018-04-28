function saveEmail() {
    event.preventDefault();
    $("#loading-image").show();
    var body = {};
    $.ajax({
        type: "POST",
        url: "create-email",
        data: body,
        success: function (data) {
            alert(data);
            $('#email-creation')[0].reset();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Erro inesperado!");
            console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    }).done(function(){
        $("#loading-image").hide();
    });
}