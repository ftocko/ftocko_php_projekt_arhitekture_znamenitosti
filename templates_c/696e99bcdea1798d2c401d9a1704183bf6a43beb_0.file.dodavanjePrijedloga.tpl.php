<?php
/* Smarty version 3.1.39, created on 2021-06-09 20:27:35
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/dodavanjePrijedloga.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c10817086df8_98695332',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '696e99bcdea1798d2c401d9a1704183bf6a43beb' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/dodavanjePrijedloga.tpl',
      1 => 1623263134,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c10817086df8_98695332 (Smarty_Internal_Template $_smarty_tpl) {
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
        <title> Dodavanje prijedloga</title>
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="javascript/ajaxGradoviSelect.js"> <?php echo '</script'; ?>
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
            <h2> Dodavanje prijedloga </h2>
            
            <dl class="ListaStranica">
                
                <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "1") {?>
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <?php }?>
                 
                 <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "2") {?>
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <?php }?>
                 
                 <?php if ($_smarty_tpl->tpl_vars['uloga']->value === "3") {?>
                  <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="Odjava.php"> Odjava </a> </dt>
                 <?php }?>
                 
                 <?php if ($_smarty_tpl->tpl_vars['korisnik']->value === null) {?>
                 <dt class="ElementListe"> <a class="element" href="Gradovi.php"> Gradovi </a> </dt>
                 <dt class="ElementListe"> <a class="element" href="index.php"> Početna stranica </a> </dt>
                 <?php }?>
                 
            </dl>
            
        </header>

        <br>
        <div style="text-align:center;">
            
        <form id="prijedlog" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
">
                
                <div>
                <label> Unesite ime i prezime:</label>
                </div>
                <input type="text" name="imePrezime" id="imePrezime" size="20">
                <br> <br>
                <div>
                <label> Unesite nadimak:</label>
                </div>
                <input type="text" name="nadimak" id="nadimak" size="20">
                <br> <br>
                <div>
                <label> Odaberite grad:</label>
                </div>
                <select id="grad" name="grad">  </select>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                <label> Unesite naziv znamenitosti:</label>
                </div>
                <input type="text" name="nazivZnam" id="nazivZnam" size="20">
                <br> <br>
                <div style="text-align:center;">
                <label> Unesite opis znamenitosti:</label>
                </div>
                <textarea name="opisZnam" id="opisZnam" rows="5" cols="52">  </textarea>
                <br> <br>
                <input class="GumbPrijedlog" type="submit" name="submit" id="submit" value="Dodaj prijedlog" style="height:50px;width:150px;">
                <input class="GumbOdustani"type="reset" name="reset" id="reset" value="Odustani" style="height:50px;width:150px;">
                <br>
            </form>
        <br> <br>
        <p> <?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>
 </p>
        </div>
             
        
        <footer>
            <p> Autor:Filip Tocko </p> 
            <p> Fakultet organizacije i informatike (FOI) </p>
            <address> <a href="mailto:ftocko@foi.hr"> ftocko@foi.hr </a> </address>



        </footer>

    </body>
</html>

<?php }
}
