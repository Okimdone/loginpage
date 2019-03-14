<?php
/* Smarty version 3.1.33, created on 2019-03-14 15:52:09
  from 'C:\wamp\www\tests\login\V\templates\signup.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c8a78a957b393_60873028',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f5e3adfd8fb3b92537a1705100dee8542492fc7' => 
    array (
      0 => 'C:\\wamp\\www\\tests\\login\\V\\templates\\signup.tpl',
      1 => 1552482630,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c8a78a957b393_60873028 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20856237785c8a78a953cb87_49581705', 'title');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20012229095c8a78a9550402_44932383', 'body');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layout.tpl");
}
/* {block 'title'} */
class Block_20856237785c8a78a953cb87_49581705 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_20856237785c8a78a953cb87_49581705',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Créer votre compte<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_20012229095c8a78a9550402_44932383 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_20012229095c8a78a9550402_44932383',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="login-grid">
        <h1 class="text-center">Sign Up Now!</h1>
        <div class="form-div">
                
            <form action="enregistrer.php" method="post">
                <Label>
                    Nom d'utilisateur*: 
                    <input type="text" name="uname" id="uname" required>
                    <?php if ($_smarty_tpl->tpl_vars['uname_exists']->value == TRUE) {?>
                        <div id="error-msg">
                            Ce nom d'utilisateur est déjà utilisé. Essayez un autre nom.
                        </div>
                    <?php }?>
                </Label>
                <label>
                    Mot de passe*:
                    <input type="password" name="passwd" id = "passwd" required> 
                </label>
                <label>
                    Confirmer*:
                    <input type="password" name="confpasswd" id="confpasswd" required>
                    <?php if ($_smarty_tpl->tpl_vars['no_conf_pass']->value == TRUE) {?>
                        <div id="error-msg">
                            Confirmez votre mot de passe.
                        </div>
                    <?php }?>
                </label>
                <div>
                    <input type="submit" value="Suivant">
                </div>
                <input type="hidden" name="route" value="signup"/>
            </form>
            <div class="account-opt text-center" >
            	<a class="opt-acc" id="register" href="index.php">Se connecter à un compte existant</a>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'body'} */
}
