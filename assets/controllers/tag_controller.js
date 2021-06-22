import { Controller } from 'stimulus';
import jQuery from 'jquery';

export default class extends Controller {
    connect() {
        $(document).ready(function(){
            $(function(){

                $("#i3p_profils_Valeurs").on({
                    focusout : function() {
                        var txt = this.value.replace(/[^A-zÀ-ÿ ]/,''); // allowed characters
                        if(txt) $("<span/>", {text:txt, appendTo:"#tag-container", class:"dashfolio-tag"});

                        this.value = "";
                    },
                    keyup : function(ev) {
                        // if: comma|enter (delimit more keyCodes with | pipe)
                        if(/(188|13)/.test(ev.which)) $(this).focusout();
                    }
                });
                $('.tag-container').on('click', 'span', function() {
                    if(confirm("Supprimer la valeurs \""+ $(this).text() +"\" ?")) $(this).remove();
                });

                $('button').on('click', (e) => {
                    e.preventDefault();
                    let valeurs = [];
                    $('.dashfolio-tag').each((id, elem)=>{
                        valeurs.push(elem.innerText);
                    })
                    $('#valeurs_array')[0].value = JSON.stringify(valeurs);
                    $('form').submit();
                })

            });
            $(window).keydown(function(event){
                if(event.target.id === 'i3p_profils_Valeurs' && event.keyCode === 13 ) {
                    event.preventDefault();
                    return false;
                }
            });

        });

    }
}
