<?php
/* Smarty version 3.1.33, created on 2019-03-14 15:52:09
  from 'C:\wamp\www\tests\login\V\templates\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c8a78a95b5d21_54238510',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98bc28b2b8d12e51648c35b8ce7ad276baeb5c69' => 
    array (
      0 => 'C:\\wamp\\www\\tests\\login\\V\\templates\\layout.tpl',
      1 => 1552577664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c8a78a95b5d21_54238510 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16394001025c8a78a95a2496_99729973', 'title');
?>
 
    </title>
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     
    <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    
    <link rel="stylesheet" href="assets\css\css.css">
    <?php echo '<script'; ?>
 src="assets/js/jscript.js"><?php echo '</script'; ?>
>
</head>
<body>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13243643815c8a78a95ae015_58518243', 'body');
?>


    <!--JavaScript at end of body for optimized loading-->
    <?php echo '<script'; ?>
 type="text/javascript" src="js/materialize.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
/* {block 'title'} */
class Block_16394001025c8a78a95a2496_99729973 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_16394001025c8a78a95a2496_99729973',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_13243643815c8a78a95ae015_58518243 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_13243643815c8a78a95ae015_58518243',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
