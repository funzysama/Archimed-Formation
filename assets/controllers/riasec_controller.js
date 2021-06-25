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
                images[i].style = "width:25px; height:25px;";
            }

        }
        var ctx = document.getElementById('myChart').getContext('2d');
        const data = {
            labels: ['Réaliste', 'Investigateur', 'Artiste', 'Social', 'Entrepreneur', 'Conventionnel'],
            datasets: [{
                label: 'Resultats',
                data: dataRiasec,
                backgroundColor: [
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
                {
                    label: 'Resultats étalonnés',
                    data: dataEtalonne,
                    backgroundColor: [
                        'rgba(64, 112, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(64, 112, 255, 1)'
                    ],
                    borderWidth: 1
                }]
        };
        const config = {
            type: 'radar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true,
                    }
                }
            }
        }
        var myChart = new Chart(ctx, config);

    }
}
