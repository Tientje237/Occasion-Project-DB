<?php
/* Smarty version 5.1.0, created on 2024-06-26 07:37:48
  from 'file:LoginForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_667bc54c051459_66367132',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95c34e79d9708b8393b030962848a0c57534dff3' => 
    array (
      0 => 'LoginForm.tpl',
      1 => 1718357338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_667bc54c051459_66367132 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1916551190667bc54c0471f2_96417303', "contentLogin");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'Layout.tpl', $_smarty_current_dir);
}
/* {block "contentLogin"} */
class Block_1916551190667bc54c0471f2_96417303 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\wamp64\\www\\Occasion-Project-DB\\templates';
?>


    <h1>Login Formulier</h1>
    <form action="index.php?action=login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password1" required>
        </div>

        <?php if ($_smarty_tpl->getValue('error')) {?>
            <div class="error"><?php echo $_smarty_tpl->getValue('error');?>
</div>
        <?php }?>

        <?php if ($_smarty_tpl->getValue('success')) {?>
            <div class="succes"><?php echo $_smarty_tpl->getValue('success');?>
</div>
        <?php }?>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

<?php
}
}
/* {/block "contentLogin"} */
}
