/*
 *  function onInit()
 *  Fonction qui réarrange l'intituler de chaque question pour la mise en page
 */
function onInit(){
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
    }
}

function preSubmitCheck(e){
    e.preventDefault();
    let form = document.getElementById('riasecForm');
    let formData = new FormData(form);
    let counter = 0;
    for(let i = 1;i <=24;i++){
        let formResult = formData.getAll('irmr[Question'+i+']');
        console.log(formResult);
        if(formResult[0] === "0"){
            counter++;
        }
    }
    if(counter > 4){
        alert("Vous n'avez le droit qu'as 4 zero maximum.");
    }else{
        form.submit();
    }
}