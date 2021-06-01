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
        jQuery('#iframeEdit').on('load', (e) => {
            jQuery('#iframeApercu')[0].contentWindow.location.reload(true);
        });


        jQuery('#questions').on('click', (e) => {
            let id = e.target.parentElement.dataset.id;
            let urlView = new URL(window.location.origin+'/question/'+id);
            let urlEdit = new URL(window.location.origin+'/question/'+id+'/edit');
            jQuery('#viewingIframe').attr('src',urlView);
            jQuery('#editingIframe').attr('src',urlEdit);
            jQuery('.content').animate({ scrollTop: 0 }, 'fast');
        })

        jQuery('#editingIframe').on('load', (e) => {
            jQuery('#viewingIframe')[0].contentWindow.location.reload(true);
        });

    }
}
