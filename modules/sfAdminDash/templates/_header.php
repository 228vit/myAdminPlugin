<?php
/**
* We need to make sure this plugin is backward compatible. 
* The in the original, this template was invoked by "include_partial",
* which means that now it won't work. Therefore, we set a variable in the 
* component code, and if it is not present - we call the component
*/

if (!isset($called_from_component)):
  include_component('sfAdminDash', 'header');
else:
?>


<?php 
use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
  /** @var string|null Link to the module (for breadcrumbs) */ $module_link = $sf_data->getRaw('module_link');
  /** @var string|null Link to the action (for breadcrumbs) */ $action_link = $sf_data->getRaw('action_link');
?> 

<?php if ($sf_user->isAuthenticated()): ?>
<?php if ($sf_user->hasPermission('admin') || $sf_user->hasPermission('manager') || $sf_user->isSuperAdmin()): ?>
	
<div id="adminWrap">
  <div>
    <table width="100%" style="border: 0px; padding: 0px; margin: 0px;">
      <tr>
        <td  style="border: 0px;" align="left">
          <div style="padding: 10px 0 0 20px; color: red; font-family: 'serif'; font-style: italic; font-size: 32px;">
            панель
          </div>
          
          <div style="padding: 0px 0 10px 120px; color: black; font-family: 'serif'; font-size: 32px;">
            администратора
          </div>
        </td>
        <td  style="border: 0px;" align="right">
          <?php echo __('Logged as') ?>: <b><?php echo $sf_user->getGuardUser()->getUsername()?></b>
          <br />
          <?php echo link_to(__('logout'), '@sf_guard_signout', array('id' => 'logoutLink'))?>
          <br />
          <?php
          $url = sfProjectConfiguration::getActive()->generateFrontendUrl('homepage');
          if (sfConfig::get('sf_environment') == 'dev') {
            $url = '/frontend_dev.php'.$url;
          }
            
          ?>
          <?php echo link_to(__('go to site'), $url, array('id' => 'gotoSiteLink'))?>
          
        </td>
      </tr>
    </table>
  </div>
  
				
  <?php include_partial('sfAdminDash/tabs', array('items' => $items, 'categories' => $categories)); ?>
				
  <?php if (sfAdminDash::getProperty('logout') && $sf_user->isAuthenticated()): ?>
    <p class="user">Привет, <?php echo $sf_user; ?> | <?php echo link_to(__('Выход', null, 'sf_admin_dash'), sfAdminDash::getProperty('logout_route', '@sf_guard_signout ')); ?></p>
  <?php endif; ?>



  <?php if (sfAdminDash::getProperty('include_path')): ?>
    <p class="breadcrumb">
      <a href='<?php echo url_for('homepage'); ?>'><?php echo sfAdminDash::getProperty('site'); ?></a> 
      <?php if ($sf_context->getModuleName() != 'sfAdminDash' && $sf_context->getActionName() != 'dashboard'): ?>
        / <?php echo null !== $module_link ? link_to($module_link_name, $module_link) : $module_link_name; ?>
        <?php if (null != $action_link): ?>
          / <?php echo link_to(__(ucfirst($action_link_name), null, 'sf_admin'), $action_link); ?>
        <?php endif ?>
      <?php endif; ?>
    </p>
  <?php endif; ?>

<?php endif; // $sf_user->hasAnyPermission ?>


<?php endif; // $sf_user->isAuthenticated?>
<?php endif; // BC check if ?>