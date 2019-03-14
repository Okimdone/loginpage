<?php
/* Smarty version 3.1.33, created on 2019-03-14 16:11:54
  from 'C:\wamp\www\tests\login\V\templates\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c8a7d4ac5c2d4_20574405',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3475be20dd355f98fe9f86e9ed20a91988e988e' => 
    array (
      0 => 'C:\\wamp\\www\\tests\\login\\V\\templates\\home.tpl',
      1 => 1552579914,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c8a7d4ac5c2d4_20574405 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5164711625c8a7d4ac15dc7_55721960', 'title');
?>

<?php ob_start();
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4178660685c8a7d4ac21946_13005472', 'body');
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "layout.tpl");
}
/* {block 'title'} */
class Block_5164711625c8a7d4ac15dc7_55721960 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_5164711625c8a7d4ac15dc7_55721960',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Home<?php
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_4178660685c8a7d4ac21946_13005472 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_4178660685c8a7d4ac21946_13005472',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
   
    <a href="logout.php">Log Out!!</a>

    <table>
        <thead>
            <tr>
                <th> Id </th>
                <th> Nom </th>
                <th> Prenom</th>
                <th> Note 1 </th>
                <th> Note 2 </th>
                <th> Moyenne </th>
            </tr>
        </thead>
        <tbody>
            <?php
$__section_row_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['etudiants']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_row_0_total = $__section_row_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_row'] = new Smarty_Variable(array());
if ($__section_row_0_total !== 0) {
for ($__section_row_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index'] = 0; $__section_row_0_iteration <= $__section_row_0_total; $__section_row_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index']++){
?>
                <tr>
                    <td>  <?php echo $_smarty_tpl->tpl_vars['etudiants']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_row']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_row']->value['index'] : null)]['id'];?>
 </td>

                </tr>
            <?php
}
}
?>
        </tbody>
    </table>             

<?php
}
}
/* {/block 'body'} */
}
