<?php

abstract class myAdminModelGeneratorHelper extends sfModelGeneratorHelper
{

  public function linkToSaveAndList($object, $params)
  {
    return '<li class="sf_admin_action_save_and_list"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_list" /></li>';
  }

  public function linkToSaveAndNext($object, $params)
  {
    if($this->module->getSecurityManager()->userHasCredentials('edit', $object))
    return '<li class="sf_admin_action_save_and_next"><input class="green" type="submit" value="'.__($params['label'], array(), 'dm').'" name="_save_and_next" /></li>';
  }

  public function linkToHistory($object, $params)
  {
    if (!$object->getTable()->isVersionable() || ! $this->module->getSecurityManager()->userHasCredentials('history', $object))
    {
      return '';
    }

    return '<li class="sf_admin_action_history">'.
    link_to1(
    __($params['label'], array(), 'dm'), $this->getRouteArrayForAction('history', $object),
    array(
        'class' => 'sf_admin_action s16 s16_clock_history',
        'title' => __($params['title'], array('%1%' => dmString::strtolower(__($this->getModule()->getName()))), 'dm')
    )
    ).
    '</li>';
  }
}