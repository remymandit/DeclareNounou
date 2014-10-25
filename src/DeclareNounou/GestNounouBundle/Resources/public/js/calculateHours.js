var heureDebut = $('select#declarenounou_gestnounoubundle_pointage_heureDebut_hour');
var minuteDebut = $('select#declarenounou_gestnounoubundle_pointage_heureDebut_minute');
var heureFin = $('select#declarenounou_gestnounoubundle_pointage_heureFin_hour');
var minuteFin = $('select#declarenounou_gestnounoubundle_pointage_heureFin_minute');
var heuresRealisees = $('input#declarenounou_gestnounoubundle_pointage_heuresRealiseesPointage');

jQuery(document).ready(function(){
    heureDebut.change(function(){
        calculerHeures();
    });
    minuteDebut.change(function(){
       calculerHeures();
    });
    heureFin.change(function(){
        calculerHeures();
    });
    minuteFin.change(function(){
       calculerHeures();
    });
});

function calculerHeures(){
    heuresRealisees.val(((parseFloat(heureFin.val()) + (parseFloat(minuteFin.val())/60))-(parseFloat(heureDebut.val()) + (parseFloat(minuteDebut.val())/60))).toString());
}