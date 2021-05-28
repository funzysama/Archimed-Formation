<?php


namespace App\Service;


class pdfDataFormatter
{
    public function convertI3PResultat($resultat, $profil)
    {
        $array = [];
        $array[0] = [
            "Nom" => $resultat->getUtilisateur()->getNom(),
            "prenom" => $resultat->getUtilisateur()->getPrenom(),
            "profil" => $profil->getNom(),
            "energie" => $profil->getEnergie(),
            "information" => $profil->getInformation(),
            "decision" => $profil->getDescision(),
            "organisation" => $profil->getOrganisation(),
            "enerLetter" => $profil->getEnergieLetter(),
            "infoLetter" => $profil->getInformationLetter(),
            "DeciLetter" => $profil->getDescisionLetter(),
            "orgaLetter" => $profil->getOrganisationLetter(),
            "dominant" => $profil->getDominant(),
            "auxiliaire" => $profil->getAuxiliaire(),
            "tertiaire" => $profil->getTertiaire(),
            "inferieur" => $profil->getInfeur(),
            "Extraversion" => $resultat->getExtraversion(),
            "Introversion" => $resultat->getIntroversion(),
            "Sensation" => $resultat->getSensation(),
            "Intuition" => $resultat->getIntuition(),
            "Feeling" => $resultat->getFeeling(),
            "Opening" => $resultat->getOpening(),
            "Rightness" => $resultat->getRightness(),
            "Thinking" => $resultat->getThinking()
        ];
        $array[1] = [
            "profilPerso" => $profil->getProfilPerso(),
            "profilPro" => $profil->getProfilPro(),
            "valeur1" => $profil->getNom(),
            "valeur2" => $profil->getNom(),
            "valeur3" => $profil->getNom(),
            "valeur4" => $profil->getNom(),
            "valeur5" => $profil->getNom(),
            "valeur6" => $profil->getNom(),
        ];
        return $array;
    }
}