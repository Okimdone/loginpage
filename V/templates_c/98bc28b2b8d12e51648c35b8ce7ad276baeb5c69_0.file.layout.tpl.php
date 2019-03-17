<?php
/* Smarty version 3.1.33, created on 2019-03-15 13:09:58
  from 'C:\wamp\www\tests\login\V\templates\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c8ba4266cd3f4_06847526',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98bc28b2b8d12e51648c35b8ce7ad276baeb5c69' => 
    array (
      0 => 'C:\\wamp\\www\\tests\\login\\V\\templates\\layout.tpl',
      1 => 1552580280,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c8ba4266cd3f4_06847526 (Smarty_Internal_Template $_smarty_tpl) {
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18102581935c8ba4266bd9f7_82325892', 'title');
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17361285175c8ba4266c56f3_63449656', 'body');
?>


    <!--JavaScript at end of body for optimized loading-->
    <?php echo '<script'; ?>
 type="text/javascript" src="js/materialize.min.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
/* {block 'title'} */
class Block_18102581935c8ba4266bd9f7_82325892 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_18102581935c8ba4266bd9f7_82325892',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_17361285175c8ba4266c56f3_63449656 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_17361285175c8ba4266c56f3_63449656',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
