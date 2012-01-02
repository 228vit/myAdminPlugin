<?php

/**
 * ping actions.
 *
 * @package    sftree
 * @subpackage ping
 * @author     228vit@gmail.com
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pingActions extends sfActions
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
  public function executeIndex(sfWebRequest $request)
  {
//    $this->getUser()->
    $this->res = array('result' => true);
    return $this->outJson();
//    $this->forward('default', 'module');
  }
}
