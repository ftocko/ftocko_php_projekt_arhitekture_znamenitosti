<?php
/* Smarty version 3.1.39, created on 2021-06-15 18:56:03
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/zaglavlje.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c8dba391cef5_98065497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23d720e123d3cc7feaa4a9689c2591c170c1c999' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/zaglavlje.tpl',
      1 => 1623766873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c8dba391cef5_98065497 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="design" rel="stylesheet" href="CSS/ftocko.css">
        <title>Početna stranica</title>
        <?php echo '<script'; ?>
 src="javascript/pocetna.js"> <?php echo '</script'; ?>
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
    expires.setTime(expires.getTime() + <?php echo $_smarty_tpl->tpl_vars['trajanjeKolacica']->value;?>
 * 24 * 60 * 60 * 1000);

    document.cookie = kljuc + '=' + vrijednost + "; expires=" + expires.toGMTString() + ";";
}
        
    function ProvjeraUvjeta() {

    if (!DohvatiKolacic("UvjetiKoristenja")) {

        var rezultat = confirm("Prihvaćate li uvjete korištenja? ");

        if (rezultat) {

            vrijeme = new Date();
            vrijemeMonth = vrijeme.getMonth() + 1;

            datumTimestamp = new Date();
            timestamp = Math.round(datumTimestamp.getTime() / 1000);
            
            PostaviKolacic("VrijemePrihvacanja", timestamp);
            PostaviKolacic("UvjetiKoristenja", "Prihvaćeni");


            alert("Uvjeti korištenja su prihvaćeni!");

        } else {
            alert("Prihvaćanje uvjeta korištenja je obavezno!");
            location.reload();
        }
    }
    

}

function BrisanjeKolacicaUvjeta(){
    
    document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';
}

<?php if ($_smarty_tpl->tpl_vars['obrisi']->value == "true") {?>
BrisanjeKolacicaUvjeta();
<?php }?>
    
ProvjeraUvjeta();

    
<?php if ($_smarty_tpl->tpl_vars['resetirani']->value == 1) {?>
    
document.cookie = "UvjetiKoristenja" + '=; Max-Age=0';
window.location.href = "index.php?unreset=unreset";

<?php }?>
        
    <?php echo '</script'; ?>
>
    
    <body>
        <header>
            <h2> Početna stranica </h2>
            
            <dl class="ListaStranica">
                <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php">Ulaz kao gost </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Prijava.php">Prijava </a> </dt>
                <dt class="ElementListe"> <a class="element" href="O_autoru.php">O autoru </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Dokumentacija.php">Dokumentacija </a> </dt>
                <dt class="ElementListe"> <a class="element" href="privatno/korisnici.php">Korisnici </a> </dt>
                
            </dl>
            
            <p align="center"> Niste registrirani?&nbsp; <a href="Registracija.php"> Registracija </a> </p>
            
            <div style="display: flex;flex-flow: row wrap; text-align:right;">
            <figure style="margin-left:auto;">
            <img id="designLogo" src="multimedija/design_icon.png" height="50" width="50">
            <img id="designAccesibility" src="multimedija/pristupacnost.jpg" height="50" width="50" onclick="PrilagodbaDisleksije();">
            </figure>
            </div>
            
            
            
            
        </header>
        
<?php }
}
