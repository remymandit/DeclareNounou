function listPointage(){
    var dateSelected = $("#select-date").val()+'-01';
    $.ajax({
        type: 'GET',
        url: 'http://declarenounou.dev/app_dev.php/pointage/list/'+$("#select-contrat").val()+'/'+dateSelected,
        datatype: "html",
        beforeSend: load,
        success: update
    });
};

function load(){
    $("#list-pointage").html('<tr><td class="load" colspan="8" align="center"><img src="/bundles/declarenounougestnounou/images/chargeur.gif" height=40 width=40 /></td></tr>');
};

function update(data){
    $(".load").remove();
    $("#list-pointage").html(data);
};
