<?php
/* Smarty version 3.1.33, created on 2019-03-12 02:50:11
  from '/var/www/html/loginpage/V/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c871e6310f590_19877171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f6aea6f03aa979026ef54de934feda0892b23d6' => 
    array (
      0 => '/var/www/html/loginpage/V/templates/login.tpl',
      1 => 1552359006,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c871e6310f590_19877171 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18568628655c871e6310a238_15146887', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5995464905c871e6310afa2_18727670', 'body');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layout.tpl");
}
/* {block 'title'} */
class Block_18568628655c871e6310a238_15146887 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_18568628655c871e6310a238_15146887',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Login page<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_5995464905c871e6310afa2_18727670 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_5995464905c871e6310afa2_18727670',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="login-grid">
        <h1 class="text-center">Welcome</h1>
        <div class="form-div">
            <form action="index.php" method="post">
                <div class="form-group">
                	<input class="form-control margin-bottom" name="uname" id="uname"  type="text" placeholder="Username" required > 
                	<input class="form-control" name= "psswd" id="passwd"   type="password" placeholder="Password"required>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['badlogin']->value == TRUE) {?>
                    <div id="error-msg">
                        Nom d'utilisateur ou mot de passe incorrect. 
                        Réessayez ou cliquez sur "Mot de passe oublié" pour le réinitialiser.
                    </div>
                <?php }?>
                <div class="form-group-btns">
                	<button class="btn btn-primary" type="button" onclick="annuler();">Annuller</button>
                	<input class="btn btn-primary btn-ok" type="submit" value="Ok">
                </div>
                <input type="hidden" name="route" value="login"/>
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
