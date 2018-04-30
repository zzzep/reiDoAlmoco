function vote(id) {
    var body = {
        "id": id
    };
    $("#loading-image").show();
    $.ajax({
        type: "POST",
        url: "api/vote",
        data: JSON.stringify(body),
        success: function (data) {
            var response = JSON.parse(data);
            alert(response.message);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Erro inesperado!");
            console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    }).done(function () {
        $("#loading-image").hide();
    });
}

function sendEmailToWinner(id) {
    var body = {
        "id": id
    };
    $("#loading-image").show();
    $.ajax({
        type: "POST",
        url: "api/send-email",
        data: JSON.stringify(body),
        success: function (data) {
            var response = JSON.parse(data);
            $("#loading-image").hide();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest, textStatus, errorThrown);
            $("#loading-image").hide();
        }
    });
}