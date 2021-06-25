import { Controller } from 'stimulus';

export default class extends Controller
{
    connect(){
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = 0.5;
                var max = 1;
                var score = parseFloat(data[0]);

                return min <= score && score <= max;

            }
        );
        let table = $('#dataTable');

        let dataSet = JSON.parse(table[0].dataset.tabledata);
        let options = {};
        $(document).ready(() => {
            options = {
                    data: dataSet,
                    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "Tout"]],
                    language: {
                        infoFiltered: "<span class='quickApproveTable_info_filtered_span'>(filtered from _MAX_ total entries)</span>",
                        url: '../local/fr_fr.json'
                    },
                    dom: 't',
                    order: [[ 2, "asc"]],
                    columns: [
                        {
                            title: 'Score',
                            data: "score",
                            defaultContent: "n/a",
                            render: ( data, type, row, meta ) => {
                                return parseFloat(data).toFixed(2);
                            }
                        },
                        {
                            title: 'Résumé',
                            data: 'summary',
                            defaultContent: "Aucun",
                            render: (data) => {
                                return '<div style="color: #fd9644;text-decoration: underline">'+data+'</div>'
                            }
                        },
                        {
                            title: 'Details',
                            data: 'details',
                            defaultContent: "pas de details",
                            searchable: false,
                            className: 'détails_soft_skills',
                        },
                    ],
                };
            table.DataTable(options);
        });
        $(() => {
           $('<button class="btn btn-outline-primary btn-hover-shine btn-shadow btn-pill"><i class="fa fa-arrow-left btn-icon-wrapper"></i>Retour</button>')
        });

    }
}