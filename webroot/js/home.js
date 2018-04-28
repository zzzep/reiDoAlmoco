function vote(id) {
    var body = {
        "id": id
    };
    $("#loading-image").show();
    $.ajax({
        type: "POST",
        url: "api/vote",
        data: body,
        success: function (data) {
            alert(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Erro inesperado!");
            console.log(XMLHttpRequest, textStatus, errorThrown);
        }
    }).done(function(){
        $("#loading-image").hide();
    });
}