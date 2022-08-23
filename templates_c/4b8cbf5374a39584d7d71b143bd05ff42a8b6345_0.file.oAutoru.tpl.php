<?php
/* Smarty version 3.1.39, created on 2021-06-15 12:07:39
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/oAutoru.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c87bebad0de4_03182373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b8cbf5374a39584d7d71b143bd05ff42a8b6345' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/oAutoru.tpl',
      1 => 1623751657,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c87bebad0de4_03182373 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="CSS/ftocko.css">
        <title>O autoru</title>
        <?php echo '<script'; ?>
 src="javascript/autor.js"> <?php echo '</script'; ?>
>
    </head>
    
    <?php echo '<script'; ?>
>
    
    function DohvatiKolacic(kljuc) {
        var keyValue = document.cookie.match('(^|;) ?' + kljuc + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] :
                null;
    }

    function PostaviKolacic(kljuc, vrijednost) {

        let expires = new Date();
        expires.setTime(expires.getTime() + 7 * 24 * 60 * 60 * 1000);

        document.cookie = kljuc + '=' + vrijednost + "; expires=" + expires.toGMTString() + ";";
    }
    
    if (DohvatiKolacic("Dizajn")) {

            $trazeniDizajn = DohvatiKolacic("Dizajn");
            dizajn = document.getElementById("dizajn");
            dizajn.href = $trazeniDizajn;
    } 
    
    
    <?php echo '</script'; ?>
>
    
    <body id="autor">
        <header class="DizajnHeader">
            <h2> O autoru </h2>
            <dl class="ListaStranica">
                <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Prijava.php">Prijava </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Dokumentacija.php">Dokumentacija </a> </dt>
            </dl>
        </header>
        <br> <br>

        <section class="SadrzajAutor">
            
            <p> Ime i prezime autora: Filip Tocko </p>
            <p> JMBAG: 0016137478 </p>
            <p style="display:inline"> Email: </p> <address style="display:inline"> <a id="emailLink" href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> <address>
            <hr>
            <p> Opis aplikacije:  </p>
            <pre> 
    Ovo je web aplikacija o arhitekturi, koja služi za upravljanje znamenitostima i prikazuje znamenitosti po gradovima te pritom određenim ulogama korisnika,
    omogućava dinamičko kreiranje sadržaja iste. Aplikacija nudi još brojne mogućnosti u vezi spomenute domene. </pre>
            <hr>
            <br>
            <p> Slika autora:</p>
            
            <figure id="slikaAutora">
            <img id="slikaAutor" src="multimedija/f1.jpg" height="180" width="180">
            </figure>
            <br>
            
        </section>

        <footer class="DizajnFooter">
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>
<?php }
}
