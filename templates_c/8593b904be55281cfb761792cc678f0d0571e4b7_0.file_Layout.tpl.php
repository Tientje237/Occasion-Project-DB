<?php
/* Smarty version 5.1.0, created on 2024-06-26 07:37:48
  from 'file:Layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_667bc54c14c2e8_37923864',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8593b904be55281cfb761792cc678f0d0571e4b7' => 
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
function content_667bc54c14c2e8_37923864 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
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
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1639332008667bc54c143bc0_08609548', "contentRegister");
?>

    </div>
</main>

<!-- Page content(Login) -->
<main class="flex-shrink-0">
    <div class="container2">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1855809397667bc54c145a94_01955826', "contentLogin");
?>

    </div>
</main>

<!-- Page content(Search) -->
<main class="flex-shrink-0">
    <div class="container3">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_491444220667bc54c1475b9_17287425', "contentSearch");
?>

    </div>
</main>

<!-- Page content(Show Case) -->
<main class="flex-shrink-0">
    <div class="container3">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1189852614667bc54c149385_40212575', "contentShowCase");
?>

    </div>
</main>

<!-- Page content(Favorite) -->
<main class="flex-shrink-0">
    <div class="container3">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_998138621667bc54c14ade3_79282429', "contentFavorite");
?>

    </div>
</main>



</body>
</html>
<?php }
/* {block "contentRegister"} */
class Block_1639332008667bc54c143bc0_08609548 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
}
}
/* {/block "contentRegister"} */
/* {block "contentLogin"} */
class Block_1855809397667bc54c145a94_01955826 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
}
}
/* {/block "contentLogin"} */
/* {block "contentSearch"} */
class Block_491444220667bc54c1475b9_17287425 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
}
}
/* {/block "contentSearch"} */
/* {block "contentShowCase"} */
class Block_1189852614667bc54c149385_40212575 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
}
}
/* {/block "contentShowCase"} */
/* {block "contentFavorite"} */
class Block_998138621667bc54c14ade3_79282429 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
}
}
/* {/block "contentFavorite"} */
}
