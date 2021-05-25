
function defineFocus() {
	const profileLink = document.getElementById('profile-menu');
	const testsLink = document.getElementById('tests-menu');
	const resultatsLink = document.getElementById('resultats-menu');

	let path = window.location.pathname;
	let pathArray = path.split('/');
	let location = pathArray[3];

	if(location === 'tests'){
		testsLink.classList.add('focus');
	}else if(location === 'resultats'){
		resultatsLink.classList.add('focus');
	}else{
		profileLink.classList.add('focus');
	}
}

function openIframe() {
	let iframe = document.getElementById("iframe");
	let iframeDiv = document.getElementById("iframeDiv");
	let iframeClass = iframeDiv.classList;
	let iframeDoc = iframe.contentDocument;
	let buttonCreateInIframe = iframeDoc.getElementById("question_Ajouter");
	let buttonCancelInIframe = iframeDoc.getElementById("question_Annuler");

	iframeClass.replace("closed", "open");
	buttonCreateInIframe.addEventListener("click", closeIframeAfterSubmit);
	buttonCancelInIframe.addEventListener("click", closeIframe);

}

function closeIframeAfterSubmit() {
	let iframe = document.getElementById("iframe");
	iframe.addEventListener("load", function(){
		let iframeClass = iframe.classList;
		iframeClass.replace("open", "closed");
		closeIframe();
	})
}

function closeIframe() {
	let iframe = document.getElementById("iframeDiv");
	let iframeClass = iframe.classList;
	iframeClass.replace("open", "closed");
	window.location = window.location;
}

function comfirmationOpen(){
	console.log('yahoooooo');
}
