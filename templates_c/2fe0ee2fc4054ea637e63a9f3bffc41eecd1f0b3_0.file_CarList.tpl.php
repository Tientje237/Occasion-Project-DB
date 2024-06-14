<?php
/* Smarty version 5.1.0, created on 2024-06-14 10:04:35
  from 'file:CarList.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666c15b3f21388_52974722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2fe0ee2fc4054ea637e63a9f3bffc41eecd1f0b3' => 
    array (
      0 => 'CarList.tpl',
      1 => 1718359247,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666c15b3f21388_52974722 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Occasion Aanbod</title>
</head>
<body>
<h1>Aanbod</h1>
<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cars'), 'car');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('car')->value) {
$foreach0DoElse = false;
?>
    <div>
        <h2><?php echo $_smarty_tpl->getValue('car')['brand'];?>
 <?php echo $_smarty_tpl->getValue('car')['model'];?>
</h2>
        <p>€<?php echo $_smarty_tpl->getValue('car')['price'];?>
 | <?php echo $_smarty_tpl->getValue('car')['year'];?>
 | <?php echo $_smarty_tpl->getValue('car')['mileage'];?>
km</p>
        <a href="index.php?action=detailpagina&id=<?php echo $_smarty_tpl->getValue('car')['ID'];?>
">Bekijk details</a>
    </div>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

</body>
</html>
<?php }
}
