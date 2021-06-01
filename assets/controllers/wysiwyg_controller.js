import { Controller } from 'stimulus';
import jQuery from 'jquery';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


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
        ClassicEditor.create(jQuery('textarea')[0])
    }
}
