import { Controller } from 'stimulus';
import jQuery from 'jquery';
import datepicker from '@chenfengyuan/datepicker'


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
        jQuery(document).ready(function() {
            jQuery('.js-datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        });

    }
}
