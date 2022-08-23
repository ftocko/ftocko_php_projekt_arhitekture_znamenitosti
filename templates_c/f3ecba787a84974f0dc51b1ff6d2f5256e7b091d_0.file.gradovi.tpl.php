<?php
/* Smarty version 3.1.39, created on 2021-06-15 18:56:44
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/gradovi.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c8dbccbb6552_02856940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3ecba787a84974f0dc51b1ff6d2f5256e7b091d' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/gradovi.tpl',
      1 => 1623756431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c8dbccbb6552_02856940 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="CSS/ftocko.css">
        <title>Gradovi</title>
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="javascript/ajaxStatistikaGradovi.js"> <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="javascript/ajaxGradovi.js"> <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="javascript/gradoviPomoc.js"> <?php echo '</script'; ?>
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
    
    <body>
        <header>
            <h2> Gradovi </h2>
            
            <dl class="ListaStranica">
                
                <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "1") {?>
                 <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php"> Glavni zaslon </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="SigurnosnaKopija.php"> Sigurnosna kopija </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="GalerijaZnamenitosti.php"> Galerija znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Znamenitosti.php"> Znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Prijedlozi.php"> Prijedlozi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Zahtjevi.php"> Zahtjevi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 <?php }?>
                 
                 <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "2") {?>
                 <dt class="ElementListe"> <a class="element" href="GalerijaZnamenitosti.php"> Galerija znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Znamenitosti.php"> Znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Prijedlozi.php"> Prijedlozi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Zahtjevi.php"> Zahtjevi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 <?php }?>
                 
                 <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "3") {?>
                 <dt class="ElementListe"> <a class="element" href="GalerijaZnamenitosti.php"> Galerija znamenitosti </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Prijedlozi.php"> Prijedlozi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 <?php }?>
                 
                 <?php if ($_smarty_tpl->tpl_vars['korisnik']->value === null) {?>
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 <figure style="text-align:right;">
                 <a href="rss.php"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Generic_Feed-icon.svg" height="50" width="50" alt="RSS icon"> </a>
                 </figure>
                 <?php }?>
                 
            </dl>
            
            <?php if ($_smarty_tpl->tpl_vars['uloga']->value === null) {?>
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
            <?php }?> 
            
            <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "3") {?>
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
                <button id="gumbZahtjev"  style="position: absolute;left:80%;bottom:40%;"> <a style="color:black;" href="DodavanjeZahtjeva.php"> Novi zahtjev za znamenitost </a> </button>
                <button id="gumbMaterijal"  style="position: absolute;left:80%;bottom:30%;"> <a style="color:black;" href="DodavanjeMaterijala.php"> Novi materijal za znamenitost </a> </button>
            <?php }?> 
            
            <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "2") {?>
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
                <button id="gumbZahtjev"  style="position: absolute;left:80%;bottom:40%;"> <a style="color:black;" href="DodavanjeZahtjeva.php"> Novi zahtjev za znamenitost </a> </button>
                <button id="gumbMaterijal"  style="position: absolute;left:80%;bottom:30%;"> <a style="color:black;" href="DodavanjeMaterijala.php"> Novi materijal za znamenitost </a> </button>
            <?php }?> 
            
            
            <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "1") {?>
                <button id="gumbPrijedlog" style="position: absolute;left:80%;bottom:40%;"> <a style="color:black;" href="DodavanjePrijedloga.php"> Novi prijedlog za znamenitost </a> </button>
                <button id="gumbDodajGrad" style="position: absolute;left:80%;bottom:50%;"> <a style="color:black;" href="DodavanjeGradova.php"> Dodaj novi grad </a> </button>
                <button id="gumbDodijeliModeratore" style="position: absolute;left:80%;bottom:60%;"> <a style="color:black;" href="DodjelaModeratora.php"> Dodijeli moderatore </a> </button>
                <button id="gumbZahtjev"  style="position: absolute;left:80%;bottom:30%;"> <a style="color:black;" href="DodavanjeZahtjeva.php"> Novi zahtjev za znamenitost </a> </button>
                <button id="gumbMaterijal"  style="position: absolute;left:80%;bottom:20%;"> <a style="color:black;" href="DodavanjeMaterijala.php"> Novi materijal za znamenitost </a> </button>
            <?php }?> 
           
            
        </header>
            
        <div id="pomoc" style="position: absolute; top: 32%; right: 90%; text-align: center; background:black; color: white;" onclick="pomoc();"> 
                   <h2 id="text"> POMOĆ! </h2>
        </div>
        
        <div class="Sadrzaj" style="text-align:center;">
            
            <h2 style="color:black;font-size:22px;"> Odaberite grad </h2>
            
            <table id="gradovi" style="color:black; text-align:center; background-color:white; margin-left: auto; margin-right: auto; width:50%; text-transform: uppercase; border-color:white;" border="2">
                
            </table>
            
           
             

        </div>
        <br>
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="stranica" name="stranica[]"> <?php echo $_smarty_tpl->tpl_vars['opcijeGradovi']->value;?>
 </select>
            &nbsp;&nbsp;
            <label for="pretraga"> Pretraga po imenu grada: </label>
            <input id="pretraga" name="pretraga" type="text">
        </form>
        
        </div>
        
        <br> <br>
        
        
        <div style="text-align: center;">
            
            <h2 style="color:black;"> Statistika broja znamenitosti po gradovima </h2>
        
            <table border="3" id="statistikaGradova" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Naziv grada </th>
                 <th> Broj znamenitosti </th>
                </thead>
            </table>
        </div>
        
        <br>
        
        <div style="text-align:center;">
            
        <button id="gumbBrojZnam" class="gumbSort"> Sortiraj po broju znamenitosti </button>
        
        </div>
       
        <br> <br>
        
        <div style="text-align:center;">
        <form style="margin-left: auto; margin-right: auto;">
            <select id="page" name="page[]"> <?php echo $_smarty_tpl->tpl_vars['opcije']->value;?>
 </select>
        </form>
        </div>
        
        <br>
             
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>
<?php }
}
