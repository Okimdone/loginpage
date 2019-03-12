<?php
/* Smarty version 3.1.33, created on 2019-03-12 03:14:21
  from '/var/www/html/loginpage/V/templates/layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c87240d2c8127_54705122',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b5294d6b883a480acae88f17bba2c898807ade6' => 
    array (
      0 => '/var/www/html/loginpage/V/templates/layout.tpl',
      1 => 1552359118,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c87240d2c8127_54705122 (Smarty_Internal_Template $_smarty_tpl) {
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4455401455c87240d2c6144_83194265', 'title');
?>
 
    </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets\css\css.css">
    <?php echo '<script'; ?>
 src="assets/js/jscript.js"><?php echo '</script'; ?>
>
</head>
<body>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2440302395c87240d2c7811_82783129', 'body');
?>

</body>
</html><?php }
/* {block 'title'} */
class Block_4455401455c87240d2c6144_83194265 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_4455401455c87240d2c6144_83194265',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'title'} */
/* {block 'body'} */
class Block_2440302395c87240d2c7811_82783129 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_2440302395c87240d2c7811_82783129',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'body'} */
}
