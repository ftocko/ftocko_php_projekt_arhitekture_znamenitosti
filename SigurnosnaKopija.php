<?php

$direktorij = getcwd();
$putanja = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];
$poruka = "";

ProvjeraIstekaSesije();

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Sigurnosna kopija";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

if ($uloga === "2" || $uloga === "3" || $korisnik == null) {

    header("Location:Gradovi.php");
}

function DohvatiSveZnamenitosti() {

    $znamenitosti = array();
    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT z.znamenitost_id from znamenitost z, materijal m where m.znamenitost_id = z.znamenitost_id;";

    $rez = $baza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $znamenitosti [] = $red["znamenitost_id"];
    }

    $baza->zatvoriDB();
    return $znamenitosti;
}

function ProvjeriZnamenitost($id) {

    $baza = new Baza();
    $baza->spojiDB();

    $upit = "SELECT z.znamenitost_id, m.putanja from znamenitost z inner join materijal m on m.znamenitost_id = z.znamenitost_id where z.znamenitost_id = $id;";

    $rez = $baza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $putanja = $red["putanja"];
    }

    $baza->zatvoriDB();

    $polje = explode("/", $putanja);
    $srcMaterijal = $polje[1];

    return $srcMaterijal;
}

function ProvjeraPostojanjaFizickihDatotekaMaterijala() {

    $nepronadjeniMaterijali = array();
    $src = "";
    $znamenitosti = DohvatiSveZnamenitosti();
    $files = scandir('materijali/');

    foreach ($znamenitosti as $znam) {

        $postoji = false;

        $src = ProvjeriZnamenitost($znam);

        foreach ($files as $file) {

            if ($src == $file) {

                $postoji = true;
                break;
            }
        }

        if ($postoji == false) {

            $nepronadjeniMaterijali[] = $znam;
        }
    }

    return $nepronadjeniMaterijali;
}

function IspisZnamenitostiZaMail($nepronadjeniMaterijali) {

    $sql = "";
    $stringZaSlanje = "";

    for ($i = 0; $i < count($nepronadjeniMaterijali); $i++) {

        if ($i === count($nepronadjeniMaterijali) - 1) {
            $sql .= "z.znamenitost_id = {$nepronadjeniMaterijali[$i]}";
        } else {
            $sql .= "z.znamenitost_id = {$nepronadjeniMaterijali[$i]} or ";
        }
    }

    $upit = "SELECT z.naziv_znamenitosti, m.putanja from znamenitost z, materijal m where z.znamenitost_id = m.znamenitost_id and ($sql);";
    $veza = new Baza();
    $veza->spojiDB();

    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $stringZaSlanje .= "{$red["naziv_znamenitosti"]}->{$red["putanja"]}";
        $stringZaSlanje .= "\n";
    }

    $veza->zatvoriDB();
    return $stringZaSlanje;
}

$mailPoslan = false;

function PosaljiMailKorisniku($email) {

    $nepronadjeniMaterijali = ProvjeraPostojanjaFizickihDatotekaMaterijala();
    $stringZaSlanje = IspisZnamenitostiZaMail($nepronadjeniMaterijali);
    global $mailPoslan;

    if (count($nepronadjeniMaterijali) > 0) {
        $primatelj = $email;
        $subject = "Nepronađeni materijali za znamenitosti";
        $poruka = "Molim Vas da ponovo postavite materijale za sljedeće znamenitosti: \n $stringZaSlanje";

        $uspjesno = mail($primatelj, $subject, $poruka);
        $mailPoslan = true;
    }
    
    return $mailPoslan;
}

function VratiIzSigurnosneKopije() {

    $userfile = $_FILES['datoteka']['tmp_name'];
    $userfile_name = $_FILES['datoteka']['name'];
    $userfile_size = $_FILES['datoteka']['size'];
    $userfile_type = $_FILES['datoteka']['type'];
    $userfile_error = $_FILES['datoteka']['error'];

    if ($userfile_error > 0) {
        echo 'Problem: ';
        switch ($userfile_error) {
            case 1: echo 'Veličina veća od ' . ini_get('upload_max_filesize');
                break;
            case 2: echo 'Veličina veća od ' . $_POST["MAX_FILE_SIZE"] . 'B';
                break;
            case 3: echo 'Datoteka djelomično prenesena';
                break;
            case 4: echo 'Datoteka nije prenesena';
                break;
        }
        exit;
    }

    $upfile = 'secKopija/' . $userfile_name;

    if (is_uploaded_file($userfile)) {
        if (!move_uploaded_file($userfile, $upfile)) {
            echo 'Problem: nije moguće prenijeti datoteku na odredište';
            exit;
        }
    } else {
        echo 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
        exit;
    }

    $dirFile = 'secKopija/' . $userfile_name;
    $contents = file($dirFile);
    $insertQueries = array();

    for ($i = 0; $i < count($contents); $i++) {

        $insertQueries[] = htmlspecialchars($contents[$i]);
    }

    $base = new Baza();
    $base->spojiDB();

    $sqlUpitMat = "TRUNCATE TABLE materijal;";
    $sqlUpitForeign = "ALTER TABLE materijal DROP FOREIGN KEY fk_materijal_znamenitost1;";

    $base->InsertDB($sqlUpitMat);
    $base->InsertDB($sqlUpitForeign);
    $base->zatvoriDB();

    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpitZnam = "TRUNCATE TABLE znamenitost;";

    $baza->InsertDB($sqlUpitZnam);

    $sqlUpitForeign = "ALTER TABLE materijal ADD CONSTRAINT fk_materijal_znamenitost1 FOREIGN KEY (znamenitost_id) REFERENCES znamenitost (znamenitost_id) ON DELETE NO ACTION ON UPDATE NO ACTION;";
    $baza->InsertDB($sqlUpitForeign);

    for ($i = 0; $i < count($insertQueries); $i++) {

        $upit = $insertQueries[$i];
        $baza->InsertDB($upit);
    }

    $baza->zatvoriDB();
    $email = $_POST["emailAdresa"];
    PosaljiMailKorisniku($email);
}

function NapraviSigurnosnuKopiju() {

    $baza = new Baza();
    $baza->spojiDB();

    $data = array();
    $sadrzajDatoteke = "";

    $sqlUpit = "SELECT * FROM znamenitost;";
    $rezultat = $baza->selectDB($sqlUpit);

    if ($rezultat) {

        while ($red = mysqli_fetch_array($rezultat)) {

            $data[] = "INSERT INTO znamenitost(znamenitost_id,zahtjev_id,moderator_id,predlozio,naziv_znamenitosti,godina,datum_i_vrijeme_dodavanja,opis) VALUES ({$red["znamenitost_id"]},{$red["zahtjev_id"]},{$red["moderator_id"]},'{$red["predlozio"]}','{$red["naziv_znamenitosti"]}',{$red["godina"]},'{$red["datum_i_vrijeme_dodavanja"]}','{$red["opis"]}');";
        }
    }

    $upit = "SELECT * FROM materijal";
    $rez = $baza->selectDB($upit);

    if ($rez) {

        while ($red = mysqli_fetch_array($rez)) {

            $data[] = "INSERT INTO materijal(materijal_id,naziv_materijala,tip_materijal_id,opis_materijala,znamenitost_id,putanja) VALUES ({$red["materijal_id"]},'{$red["naziv_materijala"]}',{$red["tip_materijal_id"]},'{$red["opis_materijala"]}',{$red["znamenitost_id"]},'{$red["putanja"]}');";
        }
    }

    $baza->zatvoriDB();


    for ($i = 0; $i < count($data); $i++) {

        $sadrzajDatoteke .= $data[$i];
        $sadrzajDatoteke .= "\n";
    }

    file_put_contents("izvorne datoteke/SigurnosnaKopija.sql", $sadrzajDatoteke);

    $file = 'izvorne datoteke/SigurnosnaKopija.sql';

    if (file_exists($file)) {

        ob_end_clean();
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Content-Type: ' . mime_content_type($file));
        header("Content-Transfer-Encoding: binary");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

if (isset($_POST["NapraviSecKopiju"])) {

    $dnevnik->radnja = "Napravljena je sigurnosna kopija znamenitosti i materijala.";
    $dnevnik->tip_id_radnje = 11;
    $dnevnik->Zapisi($korisnik);

    NapraviSigurnosnuKopiju();
}

if (isset($_POST["VratiIzSecKopije"])) {

    VratiIzSigurnosneKopije();
    if($mailPoslan==true){
        $poruka = "Podaci su uspješno vraćeni iz sigurnosne kopije, molimo provjerite Vaš E-mail račun!";
    }
    else{
         $poruka = "Podaci su uspješno vraćeni iz sigurnosne kopije!";
    }

    $dnevnik->radnja = "Podaci o znamenitostima i materijalima su uspješno vraćeni iz sigurnosne kopije.";
    $dnevnik->tip_id_radnje = 11;
    $dnevnik->Zapisi($korisnik);
}

$smarty->assign("poruka", $poruka);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanja", $putanja);
$smarty->display("sigurnosnaKopija.tpl");


