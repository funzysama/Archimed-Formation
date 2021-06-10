import { Controller } from 'stimulus';

export default class extends Controller
{
    connect(){
        let table = $('#dataTable');

        let dataSet = JSON.parse(table[0].dataset.tabledata);
        let options = {};
        $(document).ready(() => {
            options = {
                    data: dataSet,
                    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "Tout"]],
                    language: {
                        url: '../local/fr_fr.json'
                    },
                    dom: '<"top d-flex flex-md-row justify-content-between"li>rtp',
                    order: [[ 2, "asc"]],
                    columns: [
                        {
                            title: 'Score',
                            data: "score",
                            defaultContent: "n/a",
                        },
                        {
                            title: 'Résumé',
                            data: 'summary',
                            defaultContent: "Aucun",
                        },
                        {
                            title: 'Details',
                            data: 'details',
                            defaultContent: "pas de details",
                            searchable: false
                        },
                    ],
                    // columnDefs:[
                    //     {
                    //         "targets": 2,
                    //         "data": "libelle",
                    //         "render": ( data, type, row, meta ) => {
                    //             return '<div class="pointer btn border-0 btn-hover-shine btn-outline-dark btn-pill" data-code="'+row.code+'">'+data+'</div>';
                    //         }
                    //     },
                    // ],
                };
            table.DataTable(options);
        });
        table.on('click','tr button', (e) => {
            if(e.target.id === "pole_emploi"){
                let code = e.target.dataset.code;
                let url = new URL('https://candidat.pole-emploi.fr/offres/recherche?motsCles='+code+'&offresPartenaires=true&rayon=10&tri=0');
                window.open(url, '_blank');
            }
            if(e.target.id === "soft_skills"){
                let code = e.target.dataset.code;
                window.open('/pole-emploi/SoftSkills?code='+code);
            }
        });
        table.on('click', 'td div', (e) => {
            let code = e.target.dataset.code;
            let url = new URL('https://candidat.pole-emploi.fr/marche-du-travail/fichemetierrome?codeRome='+code);
            window.open(url, '_blank');
        })

    }
}