<?php

include_once "Konfiguracija.class.php";

class stranicenjeGalerija {

    public $broj_stranica = 0;
    public $broj_podataka = 4;
    public $polje_pomaka = array();
    public static $broj_redaka;

    function __construct() {

        $config = new Konfiguracija();
        $brojPodataka = $config->DohvatiBrojPodataka();
        stranicenjeGalerija::$broj_redaka = $brojPodataka;

        $this->broj_podataka = self::$broj_redaka;
        
    }

    public function SetBrojStranica($numRows) {

        $this->broj_stranica = ceil($numRows / $this->broj_podataka);
    }

    public function SetPoljePomaka() {

        $pomak = 0;

        for ($i = 1; $i <= $this->broj_stranica; $i++) {

            if ($i === 1) {

                $this->polje_pomaka[$i] = 0;
            } else {
                $this->polje_pomaka[$i] = $pomak;
            }

            $pomak = $pomak + $this->broj_podataka;
        }
    }

    public function GenerirajOpcije() {

        $opcije = "";

        for ($i = 1; $i <= $this->broj_stranica; $i++) {

            $opcije .= "<option value=$i> $i </option>";
        }

        return $opcije;
    }

}

?>

