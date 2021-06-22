import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        $(() => {
            let questions = document.getElementsByClassName('questionLabel');
            let count = questions.length;
            for(let i = 0; i < count; i++){
                let current = questions[0];
                let intituler = current.textContent;
                let intitulerArray = intituler.split('\n');

                current.remove();

                let container = document.getElementById('question'+(i+1));
                let labelcontainer = document.createElement("div");
                labelcontainer.classList.add('questionLabel-container');

                let labelleft = document.createElement("div");
                labelleft.classList.add('questionLabel-left');

                let labelmiddle = document.createElement("div");
                labelmiddle.classList.add('questionLabel-middle');

                let labelright = document.createElement("div");
                labelright.classList.add('questionLabel-right');

                labelleft.innerText = intitulerArray[0];
                labelmiddle.innerHTML = '&nbsp';
                labelright.innerText = intitulerArray[1];
                labelcontainer.appendChild(labelleft);
                labelcontainer.appendChild(labelmiddle);
                labelcontainer.appendChild(labelright);
                container.prepend(labelcontainer);
                let elem = document.getElementsByClassName('col-sm-10');
                for(let i = 0; i < elem.length; i++){
                    elem[i].classList.add('col-sm-12');
                    elem[i].classList.remove('col-sm-10');
                }
            }

        });

        let form = $('#riasecForm');
        form.on('submit', (e) => {
            e.preventDefault();
            let formData = form.serializeArray();
            let counter = 0;
            $(formData).each((id, data)=>{
                if(data.name !== "irmr[Question0]" && data.value === "0"){
                    counter++;
                }
            })
            if(counter > 4){
                alert("Vous n'avez le droit qu'as 4 zero maximum.");
                counter = 0;
            }else{
                form[0].submit();
            }
        });
    }
}
