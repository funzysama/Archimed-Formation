import { Controller } from 'stimulus';

export default class extends Controller
{
    connect (){
        let table = $('#dataTable');
        let dataSet = JSON.parse(table[0].dataset.users);
        $(document).ready(() => {
            table.DataTable({
                data: dataSet,
                responsive: true,
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
                        searchable: true,
                        sortable: false
                    },
                    {
                        title: 'Actif',
                        data: 'actif',
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            let response = '<input id="chkToggle" type="checkbox" data-on="Oui" ';
                            if (data === true) {
                                response += 'checked ';
                            }
                            // if(row.consultant === 'Administrateur' || row.consultant === 'Consultant'){
                            //     response += 'disabled ';
                            // }
                            response += 'data-off="Non" data-toggle="toggle" data-onstyle="success" data-userEmail="' + row.email + '" data-offstyle="danger">';
                            return response;
                        }
                    },

                ],
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<br><select><option value=""></option></select>');
                        if(column[0][0] === 4 ) {
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
            });
            $('input').each(() => {
                $('input#chkToggle').bootstrapToggle()
            })
            $(function () {
                $('input#chkToggle').change((e) => {
                    let data = {
                        "email": e.target.dataset.useremail
                    }
                    $.ajax({
                        url: '/switchActif',
                        method: 'POST',
                        data: data

                    })
                })
            })
        })
    }
}