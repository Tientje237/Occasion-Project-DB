<?php
/* Smarty version 5.1.0, created on 2024-06-20 07:10:35
  from 'file:Favorites.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6673d5eba2d9b4_62113804',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da03677f1d14391c956a1e4aa62e633249572850' => 
    array (
      0 => 'Favorites.tpl',
      1 => 1718867155,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6673d5eba2d9b4_62113804 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4723234046673d5eba16ac6_89130870', "contentFavorite");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'Layout.tpl', $_smarty_current_dir);
}
/* {block "contentFavorite"} */
class Block_4723234046673d5eba16ac6_89130870 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion\\templates';
?>

    <h1>Favorieten van: <?php echo $_smarty_tpl->getValue('current_user')->getMail();?>
</h1>
    <?php if (!empty($_smarty_tpl->getValue('favorites'))) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('favorites'), 'favorite');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('favorite')->value) {
$foreach0DoElse = false;
?>
            <div>
                <?php echo $_smarty_tpl->getValue('favorite');?>

                <form method="post" action="index.php?action=favorieten">
                    <input type="hidden" name="favorite" value="<?php echo $_smarty_tpl->getValue('favorite');?>
">
                    <button name="removeFavorite" type="submit">Verwijder uit favorieten</button>
                </form>
            </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <?php } else { ?>
        <p>Je hebt nog geen favorieten.</p>
    <?php }
}
}
/* {/block "contentFavorite"} */
}
