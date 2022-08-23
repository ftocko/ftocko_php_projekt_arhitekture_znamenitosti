<?php

$direktorij = getcwd();
$putanjaNavigacija = dirname($_SERVER["REQUEST_URI"]);
include "biblioteke/Zaglavlje.php";
include "biblioteke/baza.class.php";
include "biblioteke/VirtualnoVrijeme.class.php";
include "biblioteke/Konfiguracija.class.php";
include "IstekSesije.php";
include "biblioteke/dnevnik.class.php";

$korisnik = Sesija::dajKorisnika();
$uloga = $korisnik["uloga"];

if ($korisnik == null) {
    header("Location:Gradovi.php");
}

$putanja = "";
$poruka = "";
ProvjeraIstekaSesije();

$dnevnik = new Dnevnik();
$dnevnik->radnja = "Dodavanje materijala";
$dnevnik->tip_id_radnje = 5;
$dnevnik->Zapisi($korisnik);

function ProvjeraPostojanjaPutanjeMaterijalaUBazi($putanja) {

    $postoji = false;
    $baza = new Baza();
    $baza->spojiDB();

    $query = "SELECT * FROM materijal WHERE putanja = '$putanja';";
    $rezultat = $baza->selectDB($query);

    if (mysqli_num_rows($rezultat) >= 1) {
        $postoji = true;
    }

    $baza->zatvoriDB();

    return $postoji;
}

function SpremiMaterijal() {

    global $putanja;
    global $poruka;
    global $korisnik;
    $baza = new Baza();
    $baza->spojiDB();

    $tip = $_POST["tipMaterijala"];
    $znamenitost = htmlspecialchars($_POST["nazivZnam"]);

    $tipId = DohvatiIdTipa($tip);
    $znamenitostId = DohvatiIdZnamenitosti($znamenitost);
    settype($tipId, "integer");
    settype($znamenitostId, "integer");
    $nazivMaterijala = $_POST["nazivMaterijala"];
    $opisMaterijala = $_POST["opisMaterijala"];
    $putanjaMaterijala = $putanja;

    $postoji = ProvjeraPostojanjaPutanjeMaterijalaUBazi($putanja);
    
    if ($postoji !== true) {

        $upit = "INSERT INTO materijal(naziv_materijala,tip_materijal_id,opis_materijala,znamenitost_id,putanja) VALUES ('$nazivMaterijala',$tipId,'$opisMaterijala',$znamenitostId,'$putanjaMaterijala');";
        $baza->InsertDB($upit);
        
        $dnevnik = new Dnevnik();
        $dnevnik->radnja = "Korisnik je dodao materijal $nazivMaterijala.";
        $dnevnik->tip_id_radnje = 10;
        $dnevnik->Zapisi($korisnik);

        $poruka = "Uspješno ste dodali novi materijal!";
    }
    
    else{
        $poruka = "Ponovno ste postavili traženi materijal!";
    }
    
    $baza->zatvoriDB();
}

function DohvatiIdZnamenitosti($znamenitost) {

    $veza = new Baza();
    $veza->spojiDB();

    $znamenitost = str_replace(" ", "", $znamenitost);
    $znamenitost = str_replace("", " ", $znamenitost);

    $upit = "select znamenitost_id from znamenitost where naziv_znamenitosti like '%$znamenitost%';";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $znamenitostId = $red["znamenitost_id"];
    }

    $veza->zatvoriDB();
    return $znamenitostId;
}

function DohvatiIdTipa($tip) {

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "select tip_materijal_id from tip_materijal where naziv_tipa = '$tip';";
    $rez = $veza->selectDB($upit);

    while ($red = mysqli_fetch_array($rez)) {

        $tipId = $red["tip_materijal_id"];
    }

    $veza->zatvoriDB();
    return $tipId;
}

function DodajMaterijal() {

    global $putanja;
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

    $upfile = 'materijali/' . $userfile_name;
    $putanja = $upfile;

    if (is_uploaded_file($userfile)) {
        if (!move_uploaded_file($userfile, $upfile)) {
            echo 'Problem: nije moguće prenijeti datoteku na odredište';
            exit;
        }
    } else {
        echo 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
        exit;
    }
}

if (isset($_POST["submitPostaviMaterijal"])) {

    DodajMaterijal();
    SpremiMaterijal();
}


$smarty->assign("poruka", $poruka);
$smarty->assign("uloga", $uloga);
$smarty->assign("korisnik", $korisnik);
$smarty->assign("putanjaNavigacija", $putanjaNavigacija);
$smarty->display("dodavanjeMaterijala.tpl");



