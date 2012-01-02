<?php
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
  /** @var Array of categories, each containing an array of menu items and settings */ $categories = $sf_data->getRaw('categories');
?>    

<div class="block">
			
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2><?php echo __('Dashboard', null, 'sf_admin_dash'); ?></h2>
					
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<?php if (count($items)): ?>
    <?php include_partial('dash_list', array('items' => $items)); ?>
  <?php endif; ?>
  <?php if (count($categories)): ?>
    <?php foreach ($categories as $name => $category): ?>
      <?php if (sfAdminDash::hasPermission($category, $sf_user)): ?>
        <h2><?php echo __(isset($category['name']) ? $category['name'] : $name, null, 'sf_admin_dash'); ?></h2>
        <?php include_partial('dash_list', array('items' => $category['items'])); ?>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php elseif (!count($items)): ?>
    <?php echo __('sfAdminDashPlugin is not configured.  Please see the %documentation_link%.', array('%documentation_link%'=>link_to(__('documentation', null, 'sf_admin_dash'), 'http://www.symfony-project.org/plugins/sfAdminDashPlugin?tab=plugin_readme', array('title' => __('documentation', null, 'sf_admin_dash')))), 'sf_admin_dash'); ?>
  <?php endif; ?>
						

				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
			</div>		<!-- .block ends -->