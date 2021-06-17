import { Controller } from 'stimulus';
import {baseball} from "ionicons/icons";

export default class extends Controller
{
    resizeIframe (){
        let iframe = $('#profil-iframe');
        iframe.on('load', () =>{
            let h = $(iframe).contents().find(".card").height();
            $(iframe).width('500')
            $(iframe).height(h);
        });
    }
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
                        searchable: false,
                        // render: (d, t, r, m) => {
                        //     return '<button id="show-profil" class="btn border-0 btn-hover-shine btn-outline-dark btn-pill" data-email="'+d+'">'+d+'</button>'
                        // }
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
                            console.log(row)
                            let response = '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">\n' +
                                            '<input type="checkbox" class="custom-control-input" id="chkToggle" data-userEmail="' + row.email + '" ';
                                            if (data === true) {
                                                response += 'checked ';
                                            }
                            response += '><label class="custom-control-label" for="chkToggle"></label>\n' +
                                         '</div>'
                            return response;
                        }
                    },
                    {
                        title: 'Action',
                        defaultContent: 'Voir modifier supprimer',
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            let response = '<button class="btn btn-link-dark btn-shadow border-0 btn-hover-shine btn-xs btn-icon" id="view-profil" data-id="'+row.id+'"><i class="fa fa-eye"></i></button>';
                            response += '<button class="btn btn-link btn-shadow border-0 btn-hover-shine btn-xs btn-icon" id="edit-profil" data-id="'+row.id+'"><i class="fa fa-edit"></i></button>';
                            response += '<button class="btn btn-link text-danger btn-shadow border-0 btn-hover-shine btn-xs btn-icon" id="delete-profil" data-id="'+row.id+'"><i class="fa fa-trash-alt"></i></button>';
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
            // $('input').each(() => {
            //     $('input#chkToggle').bootstrapToggle()
            // })
            $(() => {
                $('input#chkToggle').change((e) => {
                    let data = {
                        "email": e.target.dataset.useremail
                    }
                    $.ajax({
                        url: '/switchActif',
                        method: 'POST',
                        data: data

                    })
                });
                let modal = $('#profil-modal');
                table.on('click','td button', (e) => {
                    if(e.target.id === "view-profil"){
                        let iframe = document.createElement('iframe');
                        iframe.id = 'profil-iframe';
                        iframe.src = '/profil/view/'+e.target.dataset.id;
                        modal[0].appendChild(iframe);
                        this.resizeIframe();
                        modal.modal().show();
                        let iframeProfil = $('#profil-iframe');
                        iframeProfil.on('load', () => {
                            let button = $(iframeProfil).contents().find('#profil-close');
                            button.on('click', (e) => {
                                modal.modal('toggle');
                            })
                        })
                    }
                    if(e.target.id === "edit-profil"){
                        let basepath = window.location.origin
                        let url = new URL(basepath+'/user/edit/'+e.target.dataset.id);
                        window.location.replace(url);
                    }

                })
                modal.on('hidden.bs.modal', () => {
                    $('#profil-iframe').remove();
                })
            })
        })
    }
}