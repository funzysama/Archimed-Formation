import { Controller } from 'stimulus';
import DataTable from "datatables.net";

import jQuery from "jquery";

export default class extends Controller
{
    connect(){
        let table = jQuery('#metiers');
        let dataSet = JSON.parse(table[0].dataset.poleEmploi);
        let data = JSON.parse(dataSet);
        jQuery(document).ready(() => {
            table.DataTable({
                data: data,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "Tout"]],
                language: {
                    url: '../local/fr_fr.json'
                },
                dom: '<"top d-flex flex-md-row justify-content-between"li>rt<"bottom"p>',
                order: [[ 2, "desc"]],
                columns: [
                    {
                        title: 'Riasec Majeur',
                        data: "riasecMajeur",
                        defaultContent: "RiasecMaj",
                        sortable: false,
                    },
                    {
                        title: 'Riasec Majeur',
                        data: 'riasecMineur',
                        defaultContent: "riasecMin",
                        sortable: false,
                    },
                    {
                        title: 'Intitulé',
                        data: 'libelle',
                        defaultContent: "libelle",
                        searchable: false
                    },
                    {
                        title: 'ROME',
                        data: 'code',
                        defaultContent: "code",
                        searchable: false
                    },
                    {
                        title: 'Offre d\'Emploi',
                        defaultContent: '',
                        searchable: false
                    },
                    {
                        title: 'Soft Skills',
                        defaultContent: '',
                        searchable: false
                    },

                ],
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>');
                        if(column[0][0] === 0 || column[0][0] === 1) {
                            select.appendTo($(column.header()))
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });
                        }

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                },
            })
        });
        table.on('click', (e) => {
            console.log(e);
            if(e.target.dataset.code != null){
                let code = e.target.dataset.code;
                let detailsMetier = new URL('http://recrutement.pole-emploi.fr/fichesrome/ficherome?codeRome='+code);
                window.open(detailsMetier, '_blank');
            }
        });

    }
}