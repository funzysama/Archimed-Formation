import { Controller } from 'stimulus';
import jQuery from 'jquery';
import tinymce from "tinymce";


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
        $(function(){
            jQuery('#i3pProfil').on('change', (e) => {
                let url = new URL(window.location.origin+'/i3p/profils/'+e.target.value+'/edit');
                $('#iframeEditProfils')[0].attributes.src.value = url;
            })
        });
    }
}
