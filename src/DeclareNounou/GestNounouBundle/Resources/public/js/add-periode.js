var container = $('div#declarenounou_gestnounoubundle_pointage_periodes');
var index = container.find(':input').length;
var $lienAjout = $('<a href="#" id="ajout_periode" class="btn btn-primary"><span class="el-icon-plus"></span> Ajouter une période</a>');
var $nouveauLienP = $('<p></p>').append($lienAjout);

jQuery(document).ready(function(){
    container.find('div').each(function(){
        ajouterLienSuppression($(this));
    });
    container.append($nouveauLienP);
    $lienAjout.on('click', function(e){
        ajouterPeriode(container,$nouveauLienP);
        e.preventDefault(); //évite qu'un # apparaisse dans l'url
    });
});
    
function ajouterPeriode(container,$nouveauLienP){
        var prototype = container.attr('data-prototype');
        var nouveauForm = prototype.replace(/__name__label__/g,'Période n° '+(index+1)).replace(/__name__/g,index);
        var $nouveauFormDiv = $('<div></div>').append(nouveauForm);
        $nouveauLienP.before($nouveauFormDiv);
        ajouterLienSuppression($nouveauFormDiv);
        index++;
    }
    
function ajouterLienSuppression($periodeFormDiv){
        var $lienSuppression = $('<a href="#" class="btn btn-danger"><span class="el-icon-trash"></span> Supprimer cette période</a><hr>');
        var $lienSupprimP = $('<p></p>').append($lienSuppression);
        $periodeFormDiv.append($lienSupprimP);
        $lienSuppression.on('click',function(e){
            e.preventDefault();
            $periodeFormDiv.remove();
        });
    }