<center>
<?php
$fieldId = 'switch_'.$field.'_'.$object->get('id');
echo link_to(
  image_tag(sfConfig::get('sf_admin_web_dir')."/images/".
    ($object->get($field) == 1 ? 'ok.png' : 'cancel.png'),
    array('id' => $fieldId)
  ),
  array(
      'sf_route'  => 'toggler',
      'model'     => $model,
      'field'     => $field,
      'id'        => $object->getId()
  ),
  array(
    'class'   => 'switch_status',
    'rel'     => $fieldId,
    'pic_dir' => sfConfig::get('sf_admin_web_dir')."/images/",
  )
);//link to
?>
</center>
