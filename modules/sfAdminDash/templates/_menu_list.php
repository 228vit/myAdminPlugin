<?php
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
?>

<?php foreach ($items as $key => $item): ?>
  <?php if (sfAdminDash::hasPermission($item, $sf_user)): ?>
    <?php if (($items_in_menu && $item['in_menu']) || (!$items_in_menu && !$item['in_menu'])): ?>
      <li <?php echo $item['in_menu']? 'class="item"':'class="item-menu"'; ?>>
      
      
        <a href="<?php echo url_for("@".$item['url']) ?>" title="<?php echo $item['name']; ?>">
          <?php echo $item['name']; ?>
        </a>
      </li>
    <?php endif; ?>
  <?php endif; ?>
<?php endforeach; ?>