import { Controller } from 'stimulus';

export default class extends Controller
{
    connect(){
        let table = $('#dataTable');

        let dataSet = JSON.parse(table[0].dataset.tabledata);
        console.log(dataSet);
        let options = {};
        $(document).ready(() => {
            let hiddenInputType = $('#type');
            let hiddenInputriasecMajeur = $('#riasecMajeur');
            let hiddenInputriaseMineur = $('#riasecMineur');
            let type = hiddenInputType[0].value;
            let riasecMajeur = hiddenInputriasecMajeur[0].value;
            let riasecMineur = hiddenInputriaseMineur[0].value;
            if(type === 'competence'){
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
                    ],
                    columnDefs:[
                        {
                            "targets": 2,
                            "data": "libelle",
                            "render": ( data, type, row, meta ) => {
                                return '<div class="pointer btn border-0 btn-hover-shine btn-outline-dark btn-pill" data-code="'+row.code+'">'+data+'</div>';
                            }
                        },
                    ]
                };
            }else{
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
                            title: '',
                            defaultContent: "",
                            searchable: false,
                            sortable: false
                        },
                        {
                            title: '',
                            defaultContent: "Soft Skills",
                            searchable: false,
                            sortable: false
                        },

                    ],
                    columnDefs:[
                        {
                            "targets": 2,
                            "data": "libelle",
                            "render": ( data, type, row, meta ) => {
                                return '<div class="pointer btn border-0 btn-hover-shine btn-outline-dark btn-pill" data-code="'+row.code+'">'+data+'</div>';
                            }
                        },
                        {
                            "targets": 4,
                            "data": "lien_offredemploi",
                            "render": ( data, type, row, meta ) => {
                                return '<button class="btn btn-outline-dark btn-shadow border-0 btn-pill btn-hover-shine" id="pole_emploi" data-code="'+row.code+'">Offre d\'emploi</button>';
                            }
                        },
                        {
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
                    "searchCols": [
                        { "search": riasecMajeur },
                        { "search": riasecMineur },
                        null,
                        null,
                        null,
                        null
                    ]

                };
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
                console.log(code);
            }
        });
        table.on('click', 'td div', (e) => {
            let code = e.target.dataset.code;
            let url = new URL('https://candidat.pole-emploi.fr/marche-du-travail/fichemetierrome?codeRome='+code);
            console.log(url)
            window.open(url, '_blank');
        })

    }
}