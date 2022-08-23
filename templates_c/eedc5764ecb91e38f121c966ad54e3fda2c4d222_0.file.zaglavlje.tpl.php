<?php
/* Smarty version 3.1.39, created on 2021-05-23 11:33:25
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021/templates/zaglavlje.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60aa216559c0f6_41775931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eedc5764ecb91e38f121c966ad54e3fda2c4d222' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021/templates/zaglavlje.tpl',
      1 => 1621703433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60aa216559c0f6_41775931 (Smarty_Internal_Template $_smarty_tpl) {
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
    
    <body>
        <header>
            <h2> Početna stranica </h2>
            
            <dl class="ListaStranica">
                <dt class="ElementListe"> <a class="element" href="GlavniZaslon.php">Ulaz kao gost </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Prijava.php">Prijava </a> </dt>
                <dt class="ElementListe"> <a class="element" href="O_autoru.php">O autoru </a> </dt>
                <dt class="ElementListe"> <a class="element" href="Dokumentacija.php">Dokumentacija </a> </dt>
                
            </dl>
            <p align="center"> Niste registrirani?&nbsp; <a href="Registracija.php"> Registracija </a> </p>
            <figure style="text-align:right; position:relative;">
            <img id="designLogo" src="multimedija/design_icon.png" height="50" width="50">
            </figure>
            
            
            
            
        </header>
<?php }
}
