import { Controller } from 'stimulus';
import jQuery from 'jquery';

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
    connect() {

        var $displayModal = jQuery('#js-display-image');

        var filename = jQuery('.js-open-modal')[0].dataset.filename

        function previewFile(filename) {
            console.log(filename)
            var href = '/manager/file/'+filename+'?conf=main&route=/ressources/images';
            $displayModal.find('img').attr('src', href);
        }

        jQuery(document).on('click', '.js-open-modal', () => {
            previewFile(filename);
            $displayModal.modal("show");
        });
    }
}
