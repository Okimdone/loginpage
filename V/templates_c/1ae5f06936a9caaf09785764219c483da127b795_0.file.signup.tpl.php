<?php
/* Smarty version 3.1.33, created on 2019-03-12 03:14:23
  from '/var/www/html/loginpage/V/templates/signup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c87240f3a4fe6_17597699',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ae5f06936a9caaf09785764219c483da127b795' => 
    array (
      0 => '/var/www/html/loginpage/V/templates/signup.tpl',
      1 => 1552360376,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c87240f3a4fe6_17597699 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18505993885c87240f3a3500_26469851', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8890498345c87240f3a45d8_92358322', 'body');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layout.tpl");
}
/* {block 'title'} */
class Block_18505993885c87240f3a3500_26469851 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_18505993885c87240f3a3500_26469851',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Créer votre compte<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_8890498345c87240f3a45d8_92358322 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_8890498345c87240f3a45d8_92358322',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="login-grid">
        <h1 class="text-center">Sign Up Now!</h1>
        <div class="form-div">
            <form action="index.php" method="post">
                        <form action="login.php" method="post">
            <Label>
                User Name* : 
                <input type="text" name="uname1" id="uname1" >
            </Label><br>
            <label >
                Password* :
                <input type="password" name="psswd1" id = "passwd1" > 
            </label><br>
            <label>
                confirm your password* :
                <input type="password" name="confpsswd" id = "confpasswd" >
            </label>
            <div>
                <input type="submit" value="Send">
            </div>
        </form>
            <div class="account-opt">
            	<a class="opt-acc" id="forgoten" href="#">Mot de passe oublié ?</a>
            	<a class="opt-acc" id="register" href="enregistrer.php">Créer un compte</a>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'body'} */
}
