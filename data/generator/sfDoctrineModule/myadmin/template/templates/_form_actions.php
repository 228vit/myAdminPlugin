<div class="sf_admin_actions_wrap">
  <ul class="sf_admin_actions">
    <?php foreach (array('new', 'edit') as $action): ?>
    <?php if ('new' == $action): ?>
    [?php if ($form->isNew()): ?]
    <?php else: ?>
    [?php else: // isNew ?]
    <?php endif; ?>
    <?php foreach ($this->configuration->getValue($action.'.actions') as $name => $params): ?>
    <?php if ('_delete' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>

    <?php elseif ('_list' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($params).') ?]', $params) ?>

    <?php elseif ('_save' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSave($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>

    <?php elseif ('_save_and_add' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSaveAndAdd($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>

    <?php elseif ('_save_and_list' == $name): ?>
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSaveAndList($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>

    <?php else: ?>
      <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
    [?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::camelize($name)) ?>')): ?]
      <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>

    [?php else: // custom action doesnt exists ?]
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>

    [?php endif; // method exists ?]
      </li>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endforeach; ?>
    [?php endif; ?]
    [?php if (!$form->isNew()): ?]
      [?php if (isSet($prev) && $prev): ?]
        <li><?php echo $this->addCredentialCondition('[?php echo link_to("&larr; ".$prev, $helper->getUrlForAction("edit"), $prev) ?]', $params=array()) ?>
        </li>
        <?php // echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($prev, array("label"=>"&laquo;".$prev)) ?]', $params=array()) ?>
        <?php // echo link_to('&laquo;'.$prev, '') ?>
      [?php endif;  ?]

      [?php if ((isSet($prev) && $prev) && (isSet($next) && ($next))): ?]
      <li><span> :: </span></li>
      [?php endif;  ?]

      [?php if (isSet($next) && $next): ?]
      <li>
        <?php echo $this->addCredentialCondition('[?php echo link_to($next." &rarr;", $helper->getUrlForAction("edit"), $next) ?]', $params=array()) ?>
      </li>
      [?php endif;  ?]
    [?php endif; ?]
  </ul>
  <div class="sf_admin_actions_nav">
  </div>
</div>
<br clear="all" />
