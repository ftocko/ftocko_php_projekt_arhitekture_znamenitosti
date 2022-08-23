<?php
/* Smarty version 3.1.39, created on 2021-06-14 11:59:37
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/korisnici.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c72889e618e0_04247418',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7431829fe48418e42d40b2ff7b3da7c4412ed16c' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/korisnici.tpl',
      1 => 1623606193,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c72889e618e0_04247418 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link id="dizajn" rel="stylesheet" href="../CSS/ftocko.css">
        <title>Statistika korištenja</title>
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="../javascript/ajaxIspisKorisnika.js"><?php echo '</script'; ?>
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
            <h2> Statistika korištenja </h2>
            
            <dl class="ListaStranica">
                
                 <dt class="ElementListe"> <a class="element" href="../index.php"> Početni zaslon </a> </dt>
                 
            </dl>
            

            
        </header>
                 
        <br> <br>
        
        <div style="text-align: center;">
            
            <h2 style="color:black;"> Ispis korisnika </h2>
        
            <table border="3" id="users" style="color:black; text-align:center; margin-left: auto; margin-right: auto; width:50%;">
                <thead style="color:black; background-color:white;"> 
                 <th> Ime </th>
                 <th> Prezime </th>
                 <th> Korisničko ime </th>
                 <th> Tip korisnika </th>
                 <th> Lozinka </th>
                 <th> Email </th>
                </thead>
            </table>
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
