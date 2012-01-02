<?php
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
?>


<?php if (count($items)): ?>

<ul id="nav">
	<?php if (sfAdminDash::hasItemsMenu($items)): ?>
		<li><a href="#">Меню</a>
		
			<ul>
        		<?php include_partial('sfAdminDash/menu_list', array('items' => $items, 'items_in_menu' => true)); ?>
      		</ul>
		
		</li>
	<?php endif; ?>
	<?php include_partial('sfAdminDash/menu_list', array('items' => $items, 'items_in_menu' => false)); ?>

</ul>

<?php endif; ?>

<?php if (count($categories)): ?>
  <ul id="mainMenu">
    <?php foreach ($categories as $name => $category): ?>
      <?php if (sfAdminDash::hasPermission($category, $sf_user)): ?>
        <?php if (sfAdminDash::hasItemsMenu($category['items'])): ?>
          <li><a href="#<?php echo SlugifyClass::Slugify($name) ?>">
                  <?php echo isSet($category['name']) ? $category['name'] : $name ?></a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>

  <?php foreach ($categories as $name => $category): ?>
    <ul id="<?php echo SlugifyClass::Slugify($name) ?>" class="subMenu">
      <?php foreach ($category['items'] as $itemName => $item): ?>
        <li><?php echo link_to($itemName, '@'.$item['url']) ?></li>
      <?php endforeach; // ($categories['items'] as $itemName => $item): ?>
    </ul>
      <?php // include_partial('sfAdminDash/menu_list', array('items' => $category['items'], 'items_in_menu' => false)) ?>
  <?php endforeach; ?>

<?php elseif (!count($items)): ?>
  <?php echo __('sfAdminDashPlugin is not configured.  Please see the %documentation_link%.', array('%documentation_link%'=>link_to(__('documentation', null, 'sf_admin_dash'), 'http://www.symfony-project.org/plugins/sfAdminDashPlugin?tab=plugin_readme', array('title' => __('documentation', null, 'sf_admin_dash')))), 'sf_admin_dash'); ?>
<?php endif; ?>