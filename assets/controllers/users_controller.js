import { Controller } from 'stimulus';

export default class extends Controller
{
    connect (){
        let table = $('#dataTable');
        let dataSet = JSON.parse(table[0].dataset.users);
        console.log(dataSet);
        $(document).ready(() => {
            table.DataTable({
                data: dataSet,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                let data = row.data();
                                console.log(row, data);
                                return 'Details pour '+data.nom+' '+data.prenom;
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                    }
                },
                columns: [
                    {
                        title: 'Nom',
                        data: "nom",
                        sortable: false,
                    },
                    {
                        title: 'Prenom',
                        data: 'prenom',
                        sortable: false,
                    },
                    {
                        title: 'Email',
                        data: 'email',
                        searchable: false
                    },
                    {
                        title: 'Agence',
                        data: 'agence',
                        searchable: false
                    },
                    {
                        title: 'Consultant',
                        data: 'consultant',
                        searchable: false,
                        sortable: false
                    },
                    {
                        title: 'Actif',
                        data: 'actif',
                        searchable: false,
                        sortable: false
                    },
                ],
            });
        })
    }
}