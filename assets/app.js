// Imports

import './bootstrap';
import $ from "jquery";
import jQuery from "jquery";
import tippy from "tippy.js";
import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'metismenu';
import DataTable from "datatables.net";


// Stylesheets

import './styles/app.css';
import './styles/main.css';
import './styles/main.scss';
import './styles/gestion-i3p.css';
import './styles/index.css';
import './styles/profile.css';
import './styles/register.css';
import './styles/test-I3P.css';
import './styles/test-IRMR.css';
import './styles/test-IRMR.scss';
import './assets/base.scss';


let visibilityContainer = jQuery('#visibility-container');
if(Object.entries(visibilityContainer).length !== 0){
    let roleSelector = jQuery('#registration_form_role');
    if(Object.entries(roleSelector).length !== 0) {
        roleSelector.on('change', (e) => {
            let role = e.currentTarget.value;
            if (role === "ROLE_USER") {
                let classList = visibilityContainer[0].classList;
                if (classList.contains('is-hidden')) {
                    classList.remove('is-hidden');
                    classList.add('is-block');
                }
            } else {
                let classList = visibilityContainer[0].classList;
                if (classList.contains('is-block') && !classList.contains('is-hidden')) {
                    classList.add('is-hidden');
                    classList.remove('is-block');
                } else if (!classList.contains('is-block') && !classList.contains('is-hidden')) {
                    classList.add('is-hidden');
                }
            }
        })
    }else{
        let classList = visibilityContainer[0].classList;
        classList.remove('is-hidden');
    }
}

let riasecFilters = jQuery('#riasec-filters');
if(Object.entries(riasecFilters).length !== 0){
    let form = riasecFilters[0];
    let formData = new FormData(form)
    console.log(formData)
}

let iframeContainer = jQuery('.iframe-wrapper');
iframeContainer.css('height',$('.height-container').innerHeight());

let passChange = jQuery('#pass-change');
if(Object.entries(passChange).length !== 0){
    passChange.on('click', (e) => {
        let url = new URL('http://funzystar.ddns.net/security/changePass');
        jQuery('#iframe-changePass').attr('src', url);
    })
}