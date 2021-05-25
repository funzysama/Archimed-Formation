<?php


namespace App\Service;


use App\Entity\I3PResultat;

class I3PCalculator
{
    private $data;
    private $repository;

    public function __construct($data, $repository)
    {
        $this->data = $data;
        $this->repository = $repository;
    }

    function A($n) {
        if ($this->data["Question" .$n] == 1) {
            return (0);
        } else {
            return (1);
        }
    }

    // Repérage des boutons sur "0"
    function B($n) {
        if ($this->data["Question" .$n] == 1) {
            return (1);
        } else {
            return (0);
        }
    }

    function fh($F, $H) {
        return($F * $this->B(0) + $H * $this->A(0));
    }

    function famille($port) {
        if (($port == "ESFR") || ($port == "ESTR") || ($port == "ISFR") || ($port == "ISTR")) { return "SR"; }
        if (($port == "ESFO") || ($port == "ESTO") || ($port == "ISFO") || ($port == "ISTO")) { return "SO"; }
        if (($port == "ENFR") || ($port == "ENFO") || ($port == "INFR") || ($port == "INFO")) { return "NF"; }
        if (($port == "ENTR") || ($port == "ENTO") || ($port == "INTR") || ($port == "INTO")) { return "NT"; }
    }

    function calculate(){
        $E = array(0,0,0,0);
        $I = array(0,0,0,0);
        $N = array(0,0,0,0);
        $S = array(0,0,0,0);
        $F = array(0,0,0,0);
        $T = array(0,0,0,0);
        $R = array(0,0,0,0);
        $O = array(0,0,0,0);

        $E[1] = 2 * $this->A(1) + $this->A(53) + $this->fh(2, 1) * $this->A(11) + 2 * $this->A(61) + 2 * $this->A(20) + $this->A(68);
        $I[1] = 2 * $this->B(1) + 2 * $this->B(53) + $this->B(11) + $this->B(61) + $this->fh(0, 1) * $this->B(20) + $this->B(68);
        $N[1] = 2 * $this->A(2) + $this->fh(1, 2) * $this->A(54) + 2 * $this->A(12) + 2 * $this->A(62) + $this->fh(1, 2) * $this->A(21) + $this->fh(0, 1) * $this->A(69);
        $S[1] = $this->fh(1, 0) * $this->B(2) + $this->fh(2, 1) * $this->B(54) + $this->fh(2, 1) * $this->B(12) + $this->fh(2, 1) * $this->B(62) + 2 * $this->B(21) + $this->fh(0, 2) * $this->B(69);
        $F[1] = $this->A(3) + $this->fh(0, 1) * $this->A(55) + 2 * $this->A(13) + $this->A(63) + $this->A(22) + $this->fh(0, 2) * $this->A(70);
        $T[1] = $this->B(3) + 2 * $this->B(55) + $this->fh(2, 0) * $this->B(13) + 2 * $this->B(63) + 2 * $this->B(22) + $this->fh(0, 1) * $this->B(70);
        $R[1] = 2 * $this->A(4) + $this->A(56) + $this->A(14) + $this->A(23) + $this->fh(2, 1) * $this->A(71);
        $O[1] = 2 * $this->B(4) + $this->B(56) + 2 * $this->B(14) + 2 * $this->B(23) + $this->B(71);
        $E[2] = $this->A(5) + $this->fh(0, 2) * $this->A(57) + $this->A(64) + 2 * $this->A(24) + 2 * $this->A(72);
        $I[2] = 2 * $this->B(5) + 2 * $this->B(15) + $this->B(64) + $this->B(24) + $this->fh(0, 1) * $this->B(72);
        $R[2] = 2 * $this->A(6) + 2 * $this->A(58) + $this->A(16) + $this->A(65) + $this->fh(1, 0) * $this->A(25);
        $O[2] = 2 * $this->B(6) + $this->fh(2, 1) * $this->B(58) + 2 * $this->B(16) + 2 * $this->B(65) + 2 * $this->B(25);
        $S[2] = $this->fh(0, 1) * $this->A(7) + 2 * $this->A(59) + 2 * $this->A(17) + 2 * $this->A(66) + 2 * $this->A(26);
        $N[2] = $this->fh(0, 2) * $this->B(7) + $this->fh(0, 1) * $this->B(59) + $this->fh(0, 1) * $this->B(17) + $this->fh(0, 1) * $this->B(66) + $this->fh(1, 2) * $this->B(26);
        $O[3] = $this->fh(2, 1) * $this->A(8) + $this->A(60) + 2 * $this->A(18) + $this->A(67) + 2 * $this->A(27);
        $R[3] = $this->B(8) + $this->B(60) + 2 * $this->B(18) + $this->B(67) + $this->fh(1, 2) * $this->B(27);
        $I[3] = 2 * $this->A(9) + $this->A(28);
        $E[3] = 2 * $this->B(9) + 2 * $this->B(19) + $this->fh(1, 2) * $this->B(28);
        $T[2] = $this->fh(0, 2) * $this->A(10);
        $F[2] = $this->fh(0, 1) * $this->B(10);
        $S[3] = $this->fh(1, 2) * $this->A(35) + 2 * $this->A(79) + 2 * $this->A(41) + $this->A(85) + $this->fh(2, 1) * $this->A(47);
        $N[3] = $this->fh(1, 2) * $this->B(29) + 2 * $this->B(73) + $this->B(35) + $this->fh(1, 0) * $this->B(79) + 2 * $this->B(85) + $this->B(47);
        $T[3] = $this->A(30) + 2 * $this->A(74) + $this->fh(2, 0) * $this->A(86) + $this->fh(2, 1) * $this->A(48) + $this->fh(2, 1) * $this->A(89);
        $F[3] = $this->fh(1, 2) * $this->B(30) + $this->B(74) + 2 * $this->B(36) + 2 * $this->B(80) + 2 * $this->B(42);
        $R[4] = 2 * $this->A(31) + $this->fh(0, 2) * $this->A(75) + $this->A(81) + 2 * $this->A(43) + $this->fh(1, 2) * $this->A(87) + $this->fh(1, 0) * $this->A(49);
        $O[4] = 2 * $this->B(31) + 2 * $this->B(37) + $this->fh(0, 1) * $this->B(81) + $this->fh(0, 1) * $this->B(87) + $this->fh(1, 2) * $this->B(49);
        $N[4] = 2 * $this->A(32) + 2 * $this->A(76) + $this->A(38) + $this->fh(1, 0) * $this->A(82) + 2 * $this->A(44) + $this->A(50);
        $S[4] = $this->B(32) + $this->fh(1, 2) * $this->B(76) + $this->B(38) + 2 * $this->B(82) + 2 * $this->B(44) + $this->B(50);
        $F[4] = 2 * $this->A(33) + 2 * $this->A(39) + $this->fh(2, 0) * $this->A(83) + 2 * $this->A(54) + $this->fh(1, 0) * $this->A(88);
        $T[4] = 2 * $this->B(33) + 2 * $this->B(77) + $this->fh(2, 1) * $this->B(39) + $this->fh(1, 0) * $this->B(83) + 2 * $this->B(51);
        $E[4] = 2 * $this->A(40) + $this->fh(1, 0) * $this->A(84) + $this->fh(1, 2) * $this->A(46);
        $I[4] = 2 * $this->B(34) + 2 * $this->B(78) + $this->B(40) + $this->B(84) + $this->B(46) + $this->fh(2, 1) * $this->B(52);
        $E[0] = 0;
        $I[0] = 0;
        $S[0] = 0;
        $N[0] = 0;
        $T[0] = 0;
        $F[0] = 0;
        $R[0] = 0;
        $O[0] = 0;

        for ($v = 1; $v <= 4; $v++) {
            $E[0] = $E[0] + $E[$v];
            $I[0] = $I[0] + $I[$v];
            $S[0] = $S[0] + $S[$v];
            $N[0] = $N[0] + $N[$v];
            $T[0] = $T[0] + $T[$v];
            $F[0] = $F[0] + $F[$v];
            $R[0] = $R[0] + $R[$v];
            $O[0] = $O[0] + $O[$v];
        }


        $resultat = [
            'Extraversion' => $E[0],
            'Introversion' => $I[0],
            'Sensation' => $S[0],
            'Intuition' => $N[0],
            'Pensée (Thinking)' => $T[0],
            'Sentiment (Feeling)' => $F[0],
            'Structuration (Rightness)' => $R[0],
            'Flexibilité (Opening)' => $O[0],
        ];

        // Calcul des portraits
        if ($E[0] > $I[0]) { $Portrait = "E"; }
        else { $Portrait = "I"; }
        if ($S[0] > $N[0]) { $Portrait .= "S"; }
        else { $Portrait .= "N"; }
        if ($T[0] > $F[0]) { $Portrait .= "T"; }
        else { $Portrait .= "F"; }
        if ($R[0] > $O[0]) { $Portrait .= "R"; }
        else { $Portrait .= "O"; }

        array_push($resultat, $Portrait);
        $famille = $this->famille($Portrait);
        array_push($resultat, $famille);
        return $resultat;
    }

    function createResultat($resultat)
    {
        $i3pResultat = new I3PResultat();
        $i3pResultat->setExtraversion($resultat["Extraversion"]);
        $i3pResultat->setIntroversion($resultat["Introversion"]);
        $i3pResultat->setSensation($resultat["Sensation"]);
        $i3pResultat->setIntuition($resultat["Intuition"]);
        $i3pResultat->setThinking($resultat["Pensée (Thinking)"]);
        $i3pResultat->setFeeling($resultat["Sentiment (Feeling)"]);
        $i3pResultat->setRightness($resultat["Structuration (Rightness)"]);
        $i3pResultat->setOpening($resultat["Flexibilité (Opening)"]);
        $profil = $this->repository->findOneBy(['nom' => 'ENTO']);
        dump($profil);
        $i3pResultat->setProfil($profil);
        return $i3pResultat;
    }
}