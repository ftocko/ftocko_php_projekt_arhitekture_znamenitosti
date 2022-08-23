<?php
/* Smarty version 3.1.39, created on 2021-06-15 12:08:43
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/sadrzajRegistracija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c87c2bd3e9a8_35334793',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c264f5d67e748366e175a6a07552e154784306a' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/sadrzajRegistracija.tpl',
      1 => 1623708257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c87c2bd3e9a8_35334793 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <div id="pomoc" style="position: absolute; top: 25%; right: 10%; text-align: right; background:black; color: white;" onclick="pomoc();"> 
         <h2 id="text"> POMOĆ! </h2>
 </div>
<section class="SadrzajRegistracija">  
            <br> <br> <br>
            <form id="registracija" name="registracijaObrazac" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
">
                <label for="ime"> Unesite ime: </label>
                <input type="text" name="ime" id="ime" size="20">
                <br>
                <br> 
                <label for="prezime"> Unesite prezime:</label>
                <input type="text" name="prezime" id="prezime" size="20">
                <br> <br>
                <label for="korime"> Unesite korisničko ime:</label>
                <input type="text" name="korime" id="korime" size="20">
                <br> <br>
                <label for="lozinka"> Unesite lozinku:</label>
                <input type="password" name="lozinka" id="lozinka" size="20">
                <br> <br>
                <label for="ponovljenaLozinka"> Ponovite lozinku:</label>
                <input type="password" name="ponovljenaLozinka" id="ponovljenaLozinka" size="20">
                <br> <br>
                <label for="email"> Unesite E-mail:</label>
                <input type="text" name="email" id="email" size="20">
                <br> <br>
                
                
                <input class="GumboviRegistracija" type="submit" name="submitRegister" id="submit" value="Registracija" style="height:50px;width:150px;">
                <input class="GumboviRegistracija"type="reset" name="reset" id="reset" value="Inicijalizacija" style="height:50px;width:150px;">
                <br>
                <div style=text-align:left;" class="g-recaptcha" data-sitekey="6LelrxcbAAAAAEAFzHHyjC2_JeZ6--FRVojMRhTE"></div>
            </form>
            <br> <br>
                
            <p style="color:red;"> <?php echo $_smarty_tpl->tpl_vars['greska']->value;?>
 </p>
            <p style="color:green;"> <?php echo $_smarty_tpl->tpl_vars['message']->value;?>
 </p>
                  
        </section>
            
                
                
                
                <?php }
}
