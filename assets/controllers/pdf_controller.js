import { Controller } from 'stimulus';
import labelmake from "labelmake";
import { degrees, PDFDocument, StandardFonts, rgb } from 'pdf-lib'

import basePdf from "../pdf";
import schemas from "../schema";
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
        let resultId = this.element.dataset.pdfData;
        this.element.addEventListener('click', () => {
            jQuery.ajax({
                url: '/ajax',
                type: 'GET',
                data: 'id=' + resultId,
                dataType: 'json',
            }).then( (data) => {
                (async () => {
                    const template = {
                        basePdf,
                        schemas
                    };
                    const inputs = [
                        {
                            nom: data.nom,
                            Energie: data.Energie,
                            Information: data.Information,
                            Descision: data.Descision,
                            Organisation: data.Organisation,
                            EnergieLetter: data.EnergieLetter,
                            InformationLetter: data.InformationLetter,
                            DescisionLetter: data.DescisionLetter,
                            OrganisationLetter: data.OrganisationLetter,
                            Dominant: data.Dominant,
                            Auxiliaire: data.Auxiliaire,
                            Tertiaire: data.Tertiaire,
                            Infeur: data.Infeur,
                            Extraversion: data.Extraversion+'',
                            Introversion: data.Introversion+'',
                            Sensation: data.Sensation+'',
                            Intuition: data.Intuition+'',
                            Feeling: data.Feeling+'',
                            Opening: data.Opening+'',
                            Rightness: data.Rightness+'',
                            Thinking: data.Thinking+'',
                            ProfilPerso: data.ProfilPerso,
                            ProfilPro: data.ProfilPro
                        },
                    ];
                    const pdf = await labelmake({ template, inputs });
                    const blob = new Blob([pdf.buffer], { type: "application/pdf" });
                    window.location = URL.createObjectURL(blob);
                })();
            });
        })
    }
}
