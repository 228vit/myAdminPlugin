  public function executeEdit(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $this-><?php echo $this->getSingularName() ?> = $object;
    $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
  
    $farr = $this->getFilters();
    $sort = $this->getSort();
    $sortFld = isSet($sort[0]) ? $sort[0] : 'id';
    $sortDir = isSet($sort[1]) ? $sort[1] : 'asc';
    
    // get qry
    $qryPrev = $this->buildQuery();
    $qryNext = clone $qryPrev;
    // get prev
    $this->prev = $qryNext->addWhere('r.'.$sortFld.' < ?', $object->$sortFld)->fetchOne();
    $this->next = $qryPrev->addWhere('r.'.$sortFld.' > ?', $object->$sortFld)->fetchOne();
    
    //if ($this->prev) echo '&laquo;'.$this->prev;
    //if ($this->next) echo $this->next.'&raquo;';
    if (!$this->prev) $this->prev = false;
    if (!$this->next) $this->next = false;
    
  }
