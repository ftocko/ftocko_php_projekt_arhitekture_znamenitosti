<?php
/* Smarty version 3.1.39, created on 2021-06-14 11:59:13
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/zaglavljeRegistracija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c72871ac2e02_21281586',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a2cd00f8758e1e2219aba75e6cbbbc70666b0ff' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/zaglavljeRegistracija.tpl',
      1 => 1623407108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c72871ac2e02_21281586 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="CSS/ftocko.css">
        <title>Registracija</title>
    </head>
    <?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js' async defer ><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="javascript/validacijaRegistracija.js"> <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="javascript/registracijaPomoc.js"> <?php echo '</script'; ?>
>
    
    
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

if (DohvatiKolacic("Dizajn")) {

    $trazeniDizajn = DohvatiKolacic("Dizajn");
    dizajn = document.getElementById("dizajn");
    dizajn.href = $trazeniDizajn;
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
window.location.href = "Registracija.php?unreset=unreset";

<?php }?>
    
    
        
<?php echo '</script'; ?>
>
    <body class="BodyRegistracija">
        <header class="DizajnHeader">
            <h2> Registracija </h2>
            <dl class="ListaStranica">
                <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Prijava.php">Prijava </a> </dt>
                <dt class="ElementListe"> <a class="element" href="O_autoru.php">O autoru </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Dokumentacija.php">Dokumentacija </a> </dt>
            </dl>

        </header>
<?php }
}
