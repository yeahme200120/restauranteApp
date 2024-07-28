function buscarCP() {
    codigo = $("#codigo_postal").val();
    console.log("Codigo a buscar:", codigo);

    url = `api/getCP/${codigo}`;
    try {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            timeout: 5000,
            success: function (data, textStatus) {
                //console.log(data,textStatus);
                if(data == 0){
                    $("#pais").val("")
                    $("#ciudad").val("")
                    $("#codigo_postal").val("");
                    alert("El codigo postal no se localizo");
                    $("#codigo_postal").focus();
                }else{
                    //console.log(data);
                    $("#pais").val(data.pais)
                    $("#ciudad").val(data.municipio)
                }

            },
            fail: function (xhr, textStatus, errorThrown) {
                alert("request failed", xhr, textStatus, errorThrown);
            },
        });
    } catch (error) {
        alert("No encontrado");
    }
}
