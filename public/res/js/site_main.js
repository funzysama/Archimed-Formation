
// ATTENTION /!\

// Aucun caractère accentué ne doit être passé dans le JS lorsque le jeu de caractères
// du site est Unicode / UTF-8 et que le JS reste en Occidental / iso-8859-1~15 !!

// Bug relevé avec IE, mais uniquement dans le cas d'un JS distant..
// Aucun pb avec un JS en local..


function externalLinks() {
	if (!document.getElementsByTagName)
		return;
	var anchors = document.getElementsByTagName("a");
	for (var i = 0; i < anchors.length; i++) {
		var anchor = anchors[i];
		if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external") 
			anchor.target = "_blank";
	}
}

function displayStatusMsg() { // Message Barre d'Etat au survol des liens
	status = "Bienvenue sur le site d'Archi-Med";
	document.returnValue = true;
}

function verif_textarea(cible,counter,taillemax) {
	var texte = cible.value;
	var taille = cible.value.length;
	if (taille > taillemax) {
		var texte_ok = texte.substring(0,taillemax);
		cible.value = texte_ok;
		counter.value = 0;	// 'nomform' est le nom du formulaire dans lequel la fonction est appelée
	}							// Il doit être transmis dans la fonction sous la forme 'document.nom-du-form'..
	else {							// En attendant mieux, bien-évidemment :-)..
		counter.value = (taillemax - taille);
	}
}

function buttonSizeIE() { // "redresse" la largeur des boutons avec IE.. Tire de 'ChangeClassNameStyle.doc'
	NAV = navigator.appVersion
	oldIE = (NAV.substr(NAV.indexOf('MSIE')+5,1) <= '5') ? true : false;
	if (oldIE) { var elems = document.all; }
	else { var elems = document.getElementsByTagName("*"); }
	for ( var i = 0; ( elem = elems[i] ); i++ ) {
		if ( elem.className == "Validate" ) {
			var size = elem.clientWidth;
			elem.style.width = ((size * 0.62) + 20) + 'px';
		}
	}
}
