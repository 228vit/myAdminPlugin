<?php
class sorterActions extends sfActions
{

  public function executeSort(sfWebRequest $request)
  {
    $object = Doctrine_Core::getTable($request->getParameter('model', 'none'))
      ->findOneBy('id', $request->getParameter('id', 0));
    
    $start  = $request->getParameter('start', null);
    $end    = $request->getParameter('end', null);
    $method = $request->getParameter('method', null);
    $model  = $request->getParameter('model', null);
    $rel_id = $request->getParameter('rel_id', null);
    $last_id= $request->getParameter('last_id', null);

    $startRec   = Doctrine::getTable($model)->findOneBy('id', $rel_id);
    $endRec     = Doctrine::getTable($model)->findOneBy('id', $last_id);
    $this->forward404Unless($startRec);
    $this->forward404Unless($endRec);
    

// try
    switch ($method){
      case 'moveFirst': {
        $object->moveToPosition((int)$startRec->position);
      }

      case 'moveBefore': {
        $object->moveToPosition((int)$startRec->position);
      }

      case 'moveAfter': {
        $object->moveToPosition((int)$startRec->position);
      }

      case 'moveLast': {
        $object->moveToPosition((int)$startRec->position+1);
      }
      
      case 'fake': {
        $object->moveToPosition((int)$startRec->position);

//        $q = Doctrine_Query::create()
//          ->update($model)
//          ->set('position', 'position + 1')
//          ->where('position < ?', $startRec->position)
//          ->andWhere('position >= ?', $endRec->position)
//          ->andWhere('position <> ?', $object->position)
//          ->orderBy('position DESC')
//        ;
////        die($q->getSqlQuery().' '.$startRec->position.' '.$endRec->position.' '.$object->position);
//        $q->execute();
//
//        $object->set('position', $startRec->position)->save();
//        $res['move'] = 'first';
      }
    }
    
    $res = array();
    $res['obj'] = $object->__toString();
    /*
    if ($start && $end)
    {
      $res['data'] = 'ok';
      if ($start < $end)
      {
        $res['move'] = 'down';
        for ($i = $start; $i <= $end; $i++)
          $object->demote();
      }

      if ($start > $end)
      {
        $res['move'] = 'up';
        for ($i = $start; $i >= $end; $i--)
          $object->promote();
      }
      
    }
     * 
     */

    $isAjax = $request->isXmlHttpRequest();
    if ($isAjax){
      $this->setTemplate('');
      $this->setLayout('');
      $this->getResponse()->setHttpHeader('Content-type', 'application/json');
      return $this->renderText(json_encode($res));
    } else {
      //do something if not AJAX
    }//if
    
  }
}