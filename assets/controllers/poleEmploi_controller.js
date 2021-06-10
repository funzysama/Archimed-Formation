import { Controller } from 'stimulus';

export default class extends Controller
{
    connect(){
        let table = $('#dataTable');
        let dataSet = JSON.parse(table[0].dataset.tabledata);
        let options = {};
        let optionsResponsive = {};
        console.log(dataSet);
        $(document).ready(() => {
            let hiddenInputriasecMajeur = $('#riasecMajeur');
            let hiddenInputriaseMineur = $('#riasecMineur');
            let riasecMajeur = hiddenInputriasecMajeur[0].value;
            let riasecMineur = hiddenInputriaseMineur[0].value;
            options = {
                data: dataSet,
                responsive: true,
                columns: [
                    {
                        title: 'Intitulé',
                        data: 'libelle',
                        defaultContent: "libelle",
                        searchable: false,
                        responsivePriority: 1
                    },
                    {
                        title: 'Riasec Majeur',
                        data: "riasecMajeur",
                        defaultContent: "RiasecMaj",
                        sortable: false,
                        responsivePriority: 1000
                    },
                    {
                        title: 'Riasec Mineur',
                        data: 'riasecMineur',
                        defaultContent: "riasecMin",
                        sortable: false,
                        responsivePriority: 1000
                    },
                    {
                        title: 'ROME',
                        data: 'code',
                        defaultContent: "code",
                        searchable: false,
                        responsivePriority: 500
                    },
                    {
                        title: '',
                        defaultContent: "Offre d'emploi",
                        searchable: false,
                        sortable: false,
                        responsivePriority: 300
                    },
                    {
                        title: '',
                        defaultContent: "Soft Skills",
                        searchable: false,
                        sortable: false,
                        responsivePriority: 400
                    },

                ],
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "Tout"]],
                language: {
                    url: '../local/fr_fr.json'
                },
                dom: '<"top d-flex flex-md-row justify-content-between"li>rtp',
                order: [[ 0, "asc"]],
                columnDefs:[
                    {
                        "responsivePriority": 1,
                        "targets": 0,
                        "data": "libelle",
                        "render": ( data, type, row, meta ) => {
                            return '<div class="pointer btn border-0 btn-hover-shine btn-outline-dark btn-pill" data-code="'+row.code+'">'+data+'</div>';
                        }
                    },
                    {
                        "responsivePriority": 2,
                        "targets": 4,
                        "data": "lien_offredemploi",
                        "render": ( data, type, row, meta ) => {
                            return '<button class="btn btn-outline-dark btn-shadow border-0 btn-pill btn-hover-shine" id="pole_emploi" data-code="'+row.code+'">Offre d\'emploi</button>';
                        }
                    },
                    {
                        "responsivePriority": 3,
                        "targets": 5,
                        "data": "lien_softskills",
                        "render": ( data, type, row, meta ) => {
                            return '<button ' +
                                'class="btn btn-outline-dark btn-shadow border-0 btn-pill btn-hover-shine" ' +
                                'id="soft_skills" ' +
                                'data-code="'+row.code+'">Soft Skills</button>';
                        }
                    }
                ],
                searchCols: [
                    null,
                    { "search": riasecMajeur },
                    { "search": riasecMineur },
                    null,
                    null,
                    null
                ]

            };
            optionsResponsive = {
                data: dataSet,
                responsive: true,
            }
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
                window.open('/pole-emploi/SoftSkills?code='+code,"_self");
            }
        });
        table.on('click', 'td div', (e) => {
            let code = e.target.dataset.code;
            let url = new URL('https://candidat.pole-emploi.fr/marche-du-travail/fichemetierrome?codeRome='+code);
            window.open(url, '_blank');
        })
    }
}