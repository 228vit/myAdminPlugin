  public function executeEdit(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $this-><?php echo $this->getSingularName() ?> = $object;
    $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
  
    $farr = $this->getFilters();
    $sort = $this->getSort();
    $sortFld = isSet($sort[0]) ? $sort[0] : 'id';
    $sortPrev = isSet($sort[1]) ? $sort[1] : 'asc';
    if ($sortPrev == 'asc')
    {
      $sortPrevSign = '<';
      $sortNextSign = '>';
      $sortNext = 'asc';
      $sortPrev = 'desc';
    } else {
      $sortPrevSign = '>';
      $sortNextSign = '<';
      $sortNext = 'desc';
      $sortPrev = 'asc';
    }
    
    // get qry
    $qryPrev = $this->buildQuery();
    $qryNext = $this->buildQuery();
    
    // get prev
    $this->prev = $qryPrev->addWhere('r.'.$sortFld.' '.$sortPrevSign.' ?', $object->$sortFld)
      ->orderBy('r.'.$sortFld.' '.$sortPrev)->fetchOne();
      
    $this->next = $qryNext->addWhere('r.'.$sortFld.' '.$sortNextSign.' ?', $object->$sortFld)
      ->orderBy('r.'.$sortFld.' '.$sortNext)->fetchOne();
    //$this->next = $qryNext->addWhere('r.'.$sortFld.' < ?', $object->$sortFld)->orderBy('r.'.$sortFld.' '.$sortNext)->fetchOne();
    
    //if ($this->prev) echo '&laquo;'.$this->prev;
    //if ($this->next) echo $this->next.'&raquo;';
    if (!$this->prev) $this->prev = false;
    if (!$this->next) $this->next = false;
    
  }
