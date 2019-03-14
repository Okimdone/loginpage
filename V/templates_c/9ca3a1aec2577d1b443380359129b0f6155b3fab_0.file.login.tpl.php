<?php
/* Smarty version 3.1.33, created on 2019-03-14 15:52:23
  from 'C:\wamp\www\tests\login\V\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c8a78b7616b47_13397122',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ca3a1aec2577d1b443380359129b0f6155b3fab' => 
    array (
      0 => 'C:\\wamp\\www\\tests\\login\\V\\templates\\login.tpl',
      1 => 1552577664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c8a78b7616b47_13397122 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12191844145c8a78b75e3eb1_63912062', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21074555835c8a78b75f38b6_81311808', 'body');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layout.tpl");
}
/* {block 'title'} */
class Block_12191844145c8a78b75e3eb1_63912062 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_12191844145c8a78b75e3eb1_63912062',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Login page<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_21074555835c8a78b75f38b6_81311808 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_21074555835c8a78b75f38b6_81311808',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="login-grid">
        <div class="nav-title header-login">
            <h1 class="text-center">Login</h1>
        </div>
        <div class="form-div">
            <form action="index.php" method="post">
                <div class="form-group">
                	<input class="form-control margin-bottom" name="uname" id="uname"  type="text" placeholder="" required > 
                	<input class="form-control" name= "passwd" id="passwd"   type="password" placeholder="Password"required>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['badlogin']->value == TRUE) {?>
                    <div id="error-msg">
                        Nom d'utilisateur ou mot de passe incorrect. 
                        Réessayez ou cliquez sur "Mot de passe oublié" pour le réinitialiser.
                    </div>
                <?php }?>
                <div class="form-group-btns">
                	<button class="btn btn-primary" type="button" onclick="annuler();">Annuller</button>
                	<input class="btn btn-primary btn-ok" type="submit" value="Login">
                </div>
                <input type="hidden" name="route" value="login"/>
            </form>
            <div class="account-opt">
            	<a class="opt-acc" id="forgoten" href="recover.php">Mot de passe oublié ?</a>
            	<a class="opt-acc" id="register" href="enregistrer.php">Créer un compte</a>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'body'} */
}
