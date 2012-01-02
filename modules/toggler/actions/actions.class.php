<?php
class togglerActions extends sfActions
{

  public function executeToggle(sfWebRequest $request)
  {
    $myObject = Doctrine_Core::getTable($request->getParameter('model', 'none'))  
      ->findOneBy('id', $request->getParameter('id', 0));

    if ($myObject)
    {
      $field = $request->getParameter('field', 'is_published');
      $newStatus = ($myObject->get($field) == 1 ? 0 : 1);
      $myObject->set($field, $newStatus);
      $myObject->save();

      $isAjax = $request->isXmlHttpRequest();
      if ($isAjax){
        return $this->renderText($newStatus);
      } else {
        $this->getUser()->setFlash('notice', 
                '"'.$myObject.'"'.
                ' field: '.$field.','.
                ' toggled to '.($newStatus ? 'true' : 'false'));
        // redirect back if not AJAX
        $backUrl = $request->getReferer();
        $this->redirect(($backUrl == '') ? '@homepage' : $backUrl);
      } // if
    }
    
  }
}