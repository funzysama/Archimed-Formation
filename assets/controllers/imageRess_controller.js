import { Controller } from 'stimulus';
import jQuery from 'jquery';
require('jquery-ui');


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * pdf_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */

export default class extends Controller {
    deleteImage() {
        let url = "/admin/ressource/delete/image/"+e.target.dataset.id;
        $.ajax(
            {
                url: url,
                type: 'POST',
                success: () => {
                    window.location.reload();
                },
                error: (e) => {
                    console.log(e)
                },
            });

    }
    connect() {
        $('#delete_image').on('click', (e) => {
            jQuery(document).on('click', '.js-open-modal', () => {
                $('#delete_image').modal("show");
            });
        })

    }
}
