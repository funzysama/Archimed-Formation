<?php


namespace App\Service;


use App\Entity\IrmrResultat;
use Symfony\Component\Process\Exception\LogicException;

class IRMRCalculator
{

    private $data;
    private $user;
    /**
     * IRMRCalculator constructor.
     * @param mixed $data
     */
    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function calculate()
    {
        $R = 0;
        $I = 0;
        $A = 0;
        $S = 0;
        $E = 0;
        $C = 0;

        $resultData = $this->data;

        if($resultData["Question1"] < 0){
            $C += 1 * abs($resultData["Question1"]);
        }elseif ($resultData["Question1"] > 0){
            $A += $resultData["Question1"];
        }

        if($resultData["Question2"] < 0){
            $I += 1 * abs($resultData["Question2"]);
        }elseif ($resultData["Question2"] > 0){
            $E += $resultData["Question2"];
        }

        if($resultData["Question3"] < 0){
            $S += 1 * abs($resultData["Question3"]);
        }elseif ($resultData["Question3"] > 0){
            $R += $resultData["Question3"];
        }

        if($resultData["Question4"] < 0){
            $A += 1 * abs($resultData["Question4"]);
        }elseif ($resultData["Question4"] > 0){
            $C += $resultData["Question4"];
        }

        if($resultData["Question5"] < 0){
            $E += 1 * abs($resultData["Question5"]);
        }elseif ($resultData["Question5"] > 0){
            $I += $resultData["Question5"];
        }

        if($resultData["Question6"] < 0){
            $R += 1 * abs($resultData["Question6"]);
        }elseif ($resultData["Question6"] > 0){
            $S += $resultData["Question6"];
        }

        if($resultData["Question7"] < 0){
            $A += 1 * abs($resultData["Question7"]);
        }elseif ($resultData["Question7"] > 0){
            $C += $resultData["Question7"];
        }

        if($resultData["Question8"] < 0){
            $I += 1 * abs($resultData["Question8"]);
        }elseif ($resultData["Question8"] > 0){
            $E += $resultData["Question8"];
        }

        if($resultData["Question9"] < 0){
            $S += 1 * abs($resultData["Question9"]);
        }elseif ($resultData["Question9"] > 0){
            $R += $resultData["Question9"];
        }

        if($resultData["Question10"] < 0){
            $C += 1 * abs($resultData["Question10"]);
        }elseif ($resultData["Question10"] > 0){
            $A += $resultData["Question10"];
        }

        if($resultData["Question11"] < 0){
            $E += 1 * abs($resultData["Question11"]);
        }elseif ($resultData["Question11"] > 0){
            $I += $resultData["Question11"];
        }

        if($resultData["Question12"] < 0){
            $R += 1 * abs($resultData["Question12"]);
        }elseif ($resultData["Question12"] > 0){
            $S += $resultData["Question12"];
        }

        if($resultData["Question13"] < 0){
            $A += 1 * abs($resultData["Question13"]);
        }elseif ($resultData["Question13"] > 0){
            $C += $resultData["Question13"];
        }

        if($resultData["Question14"] < 0){
            $S += 1 * abs($resultData["Question14"]);
        }elseif ($resultData["Question14"] > 0){
            $R += $resultData["Question14"];
        }

        if($resultData["Question15"] < 0){
            $I += 1 * abs($resultData["Question15"]);
        }elseif ($resultData["Question15"] > 0){
            $E += $resultData["Question15"];
        }

        if($resultData["Question16"] < 0){
            $C += 1 * abs($resultData["Question16"]);
        }elseif ($resultData["Question16"] > 0){
            $A += $resultData["Question16"];
        }

        if($resultData["Question17"] < 0){
            $R += 1 * abs($resultData["Question17"]);
        }elseif ($resultData["Question17"] > 0){
            $S += $resultData["Question17"];
        }

        if($resultData["Question18"] < 0){
            $E += 1 * abs($resultData["Question18"]);
        }elseif ($resultData["Question18"] > 0){
            $I += $resultData["Question18"];
        }

        if($resultData["Question19"] < 0){
            $A += 1 * abs($resultData["Question19"]);
        }elseif ($resultData["Question19"] > 0){
            $C += $resultData["Question19"];
        }

        if($resultData["Question20"] < 0){
            $S += 1 * abs($resultData["Question20"]);
        }elseif ($resultData["Question20"] > 0){
            $R += $resultData["Question20"];
        }

        if($resultData["Question21"] < 0){
            $I += 1 * abs($resultData["Question21"]);
        }elseif ($resultData["Question21"] > 0){
            $E += $resultData["Question21"];
        }

        if($resultData["Question22"] < 0){
            $C += 1 * abs($resultData["Question22"]);
        }elseif ($resultData["Question22"] > 0){
            $A += $resultData["Question22"];
        }

        if($resultData["Question23"] < 0){
            $R += 1 * abs($resultData["Question23"]);
        }elseif ($resultData["Question23"] > 0){
            $S += $resultData["Question23"];
        }

        if($resultData["Question24"] < 0){
            $E += 1 * abs($resultData["Question24"]);
        }elseif ($resultData["Question24"] > 0){
            $I += $resultData["Question24"];
        }

        // Etalonnage

        $sexe = $this->user->getSexe();
        if($sexe === "M"){
            /*  Dimension Réaliste */
            if($R === 0 and $S >= 19){
                $etalR = 1;
            }elseif($R === 0 and $S < 19){
                $etalR = 2;
            }elseif($R === 1){
                $etalR = 3;
            }elseif ($R >= 2 and $R <= 4 ){
                $etalR = 4;
            }elseif ($R >= 5 and $R <= 9 ){
                $etalR = 5;
            }elseif ($R >= 10 and $R <= 15 ){
                $etalR = 6;
            }elseif ($R >= 16 and $R <= 21 ){
                $etalR = 7;
            }

            /*  Dimension Investigateur */
            if($I === 0){
                $etalI = 1;
            }elseif($I === 1){
                $etalI = 2;
            }elseif ($I >= 2 and $I <= 3 ){
                $etalI = 3;
            }elseif ($I >= 4 and $I <= 6 ){
                $etalI = 4;
            }elseif ($I >= 7 and $I <= 12 ){
                $etalI = 5;
            }elseif ($I >= 13 and $I <= 17 ){
                $etalI = 6;
            }elseif ($I >= 18 and $I <= 24 ){
                $etalI = 7;
            }

            /*  Dimension Artiste */
            if($A === 0){
                $etalA = 1;
            }elseif($A === 1){
                $etalA = 2;
            }elseif ($A >= 2 and $A <= 4 ){
                $etalA = 3;
            }elseif ($A >= 5 and $A <= 8 ){
                $etalA = 4;
            }elseif ($A >= 9 and $A <= 12 ){
                $etalA = 5;
            }elseif ($A >= 13 and $A <= 16 ){
                $etalA = 6;
            }elseif ($A >= 17 and $A <= 24 ){
                $etalA = 7;
            }

            /*  Dimension Social */
            if($S === 0){
                $etalS = 1;
            }elseif($S >= 1 and $S <= 2){
                $etalS = 2;
            }elseif ($S >= 3 and $S <= 5 ){
                $etalS = 3;
            }elseif ($S >= 6 and $S <= 8 ){
                $etalS = 4;
            }elseif ($S >= 9 and $S <= 13 ){
                $etalS = 5;
            }elseif ($S >= 14 and $S <= 18 ){
                $etalS = 6;
            }elseif ($S >= 19 and $S <= 24 ){
                $etalS = 7;
            }

            /*  Dimension Entreprenant */
            if($E === 0 and $I >= 18){
                $etalE = 1;
            }elseif($E === 0 and $I < 18){
                $etalE = 2;
            }elseif ($E >= 1 and $E <= 2 ){
                $etalE = 3;
            }elseif ($E >= 3 and $E <= 6 ){
                $etalE = 4;
            }elseif ($E >= 7 and $E <= 14 ){
                $etalE = 5;
            }elseif ($E >= 15 and $E <= 19 ){
                $etalE = 6;
            }elseif ($E >= 20 and $E <= 24 ){
                $etalE = 7;
            }

            /*  Dimension Conventionnel */
            if($C === 0 and $A >= 17){
                $etalC = 1;
            }elseif($C === 0 and $A < 17){
                $etalC = 2;
            }elseif ($C >= 1 and $C <= 2 ){
                $etalC = 3;
            }elseif ($C >= 3 and $C <= 4 ){
                $etalC = 4;
            }elseif ($C >= 5 and $C <= 8 ){
                $etalC = 5;
            }elseif ($C >= 9 and $C <= 14 ){
                $etalC = 6;
            }elseif ($C >= 15 and $C <= 19 ){
                $etalC = 7;
            }
        }else if($sexe === "F"){
            /*  Dimension Réaliste */
            if($R === 0 and $S >= 19){
                $etalR = 1;
            }elseif($R === 0 and $S < 19){
                $etalR = 2;
            }elseif($R === 1){
                $etalR = 3;
            }elseif ($R === 2){
                $etalR = 4;
            }elseif ($R >= 3){
                $etalR = 5;
            }elseif ($R >= 4 and $R <= 7 ){
                $etalR = 6;
            }elseif ($R >= 8 and $R <= 19 ){
                $etalR = 7;
            }

            /*  Dimension Investigateur */
            if($I === 0){
                $etalI = 1;
            }elseif($I === 1){
                $etalI = 2;
            }elseif ($I >= 2 and $I <= 4 ){
                $etalI = 3;
            }elseif ($I >= 5 and $I <= 8 ){
                $etalI = 4;
            }elseif ($I >= 9 and $I <= 12 ){
                $etalI = 5;
            }elseif ($I >= 13 and $I <= 16 ){
                $etalI = 6;
            }elseif ($I >= 17 and $I <= 23 ){
                $etalI = 7;
            }

            /*  Dimension Artiste */
            if($A === 0){
                $etalA = 1;
            }elseif($A > 0 and $A <= 2){
                $etalA = 2;
            }elseif ($A >= 3 and $A <= 5 ){
                $etalA = 3;
            }elseif ($A >= 6 and $A <= 9 ){
                $etalA = 4;
            }elseif ($A >= 10 and $A <= 14 ){
                $etalA = 5;
            }elseif ($A >= 15 and $A <= 18 ){
                $etalA = 6;
            }elseif ($A >= 19 and $A <= 24 ){
                $etalA = 7;
            }

            /*  Dimension Social */
            if($S >= 0 and $S <= 2){
                $etalS = 1;
            }elseif($S >= 3 and $S <= 5){
                $etalS = 2;
            }elseif ($S >= 6 and $S <= 8 ){
                $etalS = 3;
            }elseif ($S >= 9 and $S <= 12 ){
                $etalS = 4;
            }elseif ($S >= 13 and $S <= 15 ){
                $etalS = 5;
            }elseif ($S >= 16 and $S <= 18 ){
                $etalS = 6;
            }elseif ($S >= 19 and $S <= 24 ){
                $etalS = 7;
            }

            /*  Dimension Entreprenant */
            if($E === 0 and $I >= 17){
                $etalE = 1;
            }elseif($E === 0 and $I < 17){
                $etalE = 2;
            }elseif ($E >= 1 and $E <= 2 ){
                $etalE = 3;
            }elseif ($E >= 3 and $E <= 6 ){
                $etalE = 4;
            }elseif ($E >= 7 and $E <= 11 ){
                $etalE = 5;
            }elseif ($E >= 12 and $E <= 17 ){
                $etalE = 6;
            }elseif ($E >= 18 and $E <= 24 ){
                $etalE = 7;
            }

            /*  Dimension Conventionnel */
            if($C === 0 and $A >= 19){
                $etalC = 1;
            }elseif($C === 0 and $A < 19){
                $etalC = 2;
            }elseif ($C === 1 ){
                $etalC = 3;
            }elseif ($C >= 2 and $C <= 5 ){
                $etalC = 4;
            }elseif ($C >= 6 and $C <= 10 ){
                $etalC = 5;
            }elseif ($C >= 11 and $C <= 13 ){
                $etalC = 6;
            }elseif ($C >= 14 and $C <= 21 ){
                $etalC = 7;
            }
        }else{
            throw new LogicException("Une erreur c\'est produite, Veuillez ressayer. <a href='{{ path('main_home') }}'>retour</a>");
        }

        /* Calcul Indice de différenciation */
        $riasec = [$R, $I, $A, $S, $E, $C];
        rsort($riasec);
        $D = ($riasec[0]-(($riasec[1]+$riasec[2])/2))+($riasec[2]-(($riasec[3]+$riasec[4]) / 2));

        $IrmrResultat = new IrmrResultat();
        $IrmrResultat->setUtilisateur($this->user);

        $IrmrResultat->setDifferenciation($D);

        $IrmrResultat->setRealiste($R);
        $IrmrResultat->setInvestigateur($I);
        $IrmrResultat->setArtiste($A);
        $IrmrResultat->setSocial($S);
        $IrmrResultat->setEntrepreneur($E);
        $IrmrResultat->setConventionnel($C);

        $IrmrResultat->setRealisteEtalonne($etalR);
        $IrmrResultat->setInvestigateurEtalonne($etalI);
        $IrmrResultat->setArtisteEtalonne($etalA);
        $IrmrResultat->setSocialEtalonne($etalS);
        $IrmrResultat->setEntrepreneurEtalonne($etalE);
        $IrmrResultat->setConventionnelEtalonne($etalC);

        $IrmrResultat->setRealistePourcent($R*(100/24));
        $IrmrResultat->setInvestigateurPourcent($I*(100/24));
        $IrmrResultat->setArtistePourcent($A*(100/24));
        $IrmrResultat->setSocialPourcent($S*(100/24));
        $IrmrResultat->setEntrepreneurPourcent($E*(100/24));
        $IrmrResultat->setConventionnelPourcent($C*(100/24));
        $baseValueArray = [];
        $baseValueArray["Realiste"] =  $R;
        $baseValueArray["Investigateur"] =  $I;
        $baseValueArray["Artiste"] =  $A;
        $baseValueArray["Social"] =  $S;
        $baseValueArray["Entrepreneur"] =  $E;
        $baseValueArray["Conventionnel"] =  $C;

        $twoBest = array_filter($baseValueArray, function ($value) use ($baseValueArray) {
            if($value == $this->twoHighest($baseValueArray)){
                return $value;
            }
            if($value == max($baseValueArray)){
                return $value;
            }
            return null;
        });

        $twoLowest = array_filter($baseValueArray, function ($value) use ($baseValueArray) {
            if($value == min($baseValueArray)){
                return $value;
            }
            if($value == $this->twoLowest($baseValueArray)){
                return $value;
            }
            if($value == min($baseValueArray) || $value == 0){
                $data = [];
                dump($data);
                array_push($data, $value);
                return $data;
            }
            return null;
        });

        arsort($twoBest);
        $majMin = array_flip($twoBest);
        dump($twoLowest);
        arsort($twoLowest);
        $inferieurs = array_flip($twoLowest);
        if(in_array(0, $baseValueArray)){
            $flippedArray = array_flip($baseValueArray);
            ksort($flippedArray);
            $firstLowest = array_shift($flippedArray);
        }else{
            $firstLowest = $inferieurs[min($baseValueArray)];
        }
        $secondLowest = $inferieurs[$this->twoLowest($baseValueArray)];
        $firstBest = $majMin[max($baseValueArray)];
        $secondBest = $majMin[$this->twoHighest($baseValueArray)];
        $IrmrResultat->setMajeur($firstBest);
        $IrmrResultat->setMineur($secondBest);
        $IrmrResultat->setInferieur1($firstLowest);
        $IrmrResultat->setInferieur2($secondLowest);

        return $IrmrResultat;
    }

    function twoHighest(array $arr) {

        sort($arr);

        return $arr[sizeof($arr)-2];
    }

    function twoLowest(array $arr) {

        rsort($arr);
        return $arr[sizeof($arr)-2];
    }

    function change_key( $array, $old_key, $new_key ) {

        if( ! array_key_exists( $old_key, $array ) )
            return $array;

        $keys = array_keys( $array );
        $keys[ array_search( $old_key, $keys ) ] = $new_key;

        return array_combine( $keys, $array );
    }

}