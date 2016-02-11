$(document).ready(function(){
    // ajout des icons aux boutons des formulaires
    $(".addButton").prepend("<span class=\"el-icon-plus\"></span> ");
    $(".deleteButton").prepend("<span class=\"el-icon-trash\"></span> ");
    $(".updateButton").prepend("<span class=\"el-icon-refresh\"></span> ");
    // ajout datepicker pour sélection mois et années
    $('#datepicker-container .input-group.date').datepicker({
        format: "yyyy-mm",
        startView: 1,
        minViewMode: 1,
        language: "fr",
        autoclose: true
    });
    // lancement des fonctions ajax d'affichage de la liste des pointages
    $("#select-contrat").change(function(){listPointage();});
    $("#select-date").change(function(){listPointage();});
});
