<?php
/* Smarty version 5.1.0, created on 2024-06-20 07:10:35
  from 'file:Layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6673d5eba510a3_15477647',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '111e74b2b22156930b41f187e28cea87f297e766' => 
    array (
      0 => 'Layout.tpl',
      1 => 1718867155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6673d5eba510a3_15477647 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <style>
       .container {
           margin-top: 20px;
       }

       .error{
           color: red;
       }

       .success{
           color: green;
       }
    </style>
</head>
<body>

<!-- Page content(Register) -->
<main class="flex-shrink-0">
    <div class="container">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14623011566673d5eba483a8_63197401', "contentRegister");
?>

    </div>
</main>

<!-- Page content(Login) -->
<main class="flex-shrink-0">
    <div class="container2">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18654265836673d5eba4a2d3_75436501', "contentLogin");
?>

    </div>
</main>

<!-- Page content(Search) -->
<main class="flex-shrink-0">
    <div class="container3">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16214260206673d5eba4c0d5_01875856', "contentSearch");
?>

    </div>
</main>

<!-- Page content(Show Case) -->
<main class="flex-shrink-0">
    <div class="container3">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1969049046673d5eba4db69_50703815', "contentShowCase");
?>

    </div>
</main>

<!-- Page content(Favorite) -->
<main class="flex-shrink-0">
    <div class="container3">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18672150596673d5eba4fcc5_03538827', "contentFavorite");
?>

    </div>
</main>



</body>
</html>
<?php }
/* {block "contentRegister"} */
class Block_14623011566673d5eba483a8_63197401 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
}
}
/* {/block "contentRegister"} */
/* {block "contentLogin"} */
class Block_18654265836673d5eba4a2d3_75436501 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
}
}
/* {/block "contentLogin"} */
/* {block "contentSearch"} */
class Block_16214260206673d5eba4c0d5_01875856 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
}
}
/* {/block "contentSearch"} */
/* {block "contentShowCase"} */
class Block_1969049046673d5eba4db69_50703815 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
}
}
/* {/block "contentShowCase"} */
/* {block "contentFavorite"} */
class Block_18672150596673d5eba4fcc5_03538827 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
}
}
/* {/block "contentFavorite"} */
}
