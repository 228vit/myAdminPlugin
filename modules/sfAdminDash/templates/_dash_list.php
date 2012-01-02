<?php
  use_helper('I18N');
  /** @var Array of menu items */ $items = $sf_data->getRaw('items');
?>
<div class="dash_row">
  <?php foreach ($items as $key => $item): ?>
    <?php if (sfAdminDash::hasPermission($item, $sf_user)):?>
      <div class="dash_item">
     
          <a href="<?php echo url_for("@".$item['url']) ?>" title="<?php echo __($item['name']); ?>" <?php if(isset($item['onclick'])): ?>onclick="<?php echo $item['onclick']?>" <?php endif?>>
            <?php echo __($item['name']); ?>
          </a>
        </div>        
    <?php endif; ?>
  <?php endforeach; ?>
</div>