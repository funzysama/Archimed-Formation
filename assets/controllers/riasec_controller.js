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
        let images = jQuery('.Image');
        for(let i = 0; i < images.length; i++){
            let size = images[i].dataset.riasec;
            if(parseInt(size) !== 0){
                images[i].style = "width:"+(parseInt(size)+50)+"px; height:"+(parseInt(size)+50)+"px;";
            }else{
                images[i].style = "width:0; height:0;";
            }
            console.log(images[i]);

        }
    }
}
