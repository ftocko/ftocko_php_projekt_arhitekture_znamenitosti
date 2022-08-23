<?php
/* Smarty version 3.1.39, created on 2021-06-09 20:27:39
  from '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/sadrzajPrijava.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c1081bbc34d8_14702949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f90341230f40ac387fa06e8e58cb9ad85fe78af5' => 
    array (
      0 => '/home/WebDiP_04/ftocko/Projekt_WebDiP2021_backup/templates/sadrzajPrijava.tpl',
      1 => 1621963798,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c1081bbc34d8_14702949 (Smarty_Internal_Template $_smarty_tpl) {
?> <div id="pomoc" style="position: absolute; top: 25%; right: 10%; text-align: right; background:black; color: white;" onclick="pomoc();"> 
         <h2 id="text"> POMOĆ! </h2>
 </div>

<section class="SadrzajPrijava">  
            <br> <br> <br> <br>  <br> <br>
            <form id="prijava" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
">
                
                <label for="username"> Korisničko ime: </label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['korisnicko_ime']->value;?>
" name="username" id="username" size="20">
                <br>
                <br> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="lozinka"> Lozinka:</label>
                <input type="password" name="lozinka" id="lozinka" size="20">
                <br> <br>
                &nbsp;&nbsp;&nbsp; <label for="zapamtiMe"> Zapamti me </label>
                <input type="radio" id="zapamtiMe" name="zapamtiMe">
                &nbsp;
                <a class="PosebanLink" href="PovratLozinke.php"> Zaboravili ste lozinku? </a>
                <br> <br>
                <input class="GumboviPrijava" type="submit" name="submit" id="submit" value="Prijava" style="height:50px;width:150px;">
                <input class="GumboviPrijava"type="reset" name="reset" id="reset" value="Inicijalizacija" style="height:50px;width:150px;">
                <br>
                <br>
                <p align="center"> Niste registrirani?&nbsp; <a class="PosebanLink" href="Registracija.php"> Registracija </a> </p>
            </form>
                <br>
                <p style="color:red;"> <?php echo $_smarty_tpl->tpl_vars['greska']->value;?>
 </p>
                <br>
                <p style="color:green"> <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
 </p>
 
            <br>


        </section>
<?php }
}
