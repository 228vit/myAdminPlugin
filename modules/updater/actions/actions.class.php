<?php

/**
 * ping actions.
 *
 * @package    sftree
 * @subpackage ping
 * @author     228vit@gmail.com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class updaterActions extends sfActions
{
  private function outJson()
  {
    $this->setTemplate('');
    $this->setLayout('');
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText(json_encode($this->res));
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUpdate(sfWebRequest $request)
  {
    $id     = $request->getParameter('id', array());
    $value  = $request->getParameter('value', null);
    $arr = explode('__', $id);
    if (count($arr) == 3)
    {
      $model  = $arr[0];
      $id     = $arr[1];
      $field  = $arr[2];
      //now try update
      $row = Doctrine::getTable($model)->findOneById($id);
      
      $row->set($field, $value)->save();
      sfView::NONE;
      return $this->renderText($row->get($field));
    } else {
      return false;
    }

//    $this->getUser()->
    $this->res = array('result' => true, 'arr' => $arr);
    return $this->outJson();
//    $this->forward('default', 'module');
  }
}
