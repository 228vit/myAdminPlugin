  public function executeIndex(sfWebRequest $request)
  {
    if ($request->getParameter('max_per_page'))
    {
      $filters = $this->getUser()->getAttribute('user.filters', $this->configuration->getFilterDefaults(), 'admin_module');
      $this->getUser()->setAttribute('max_per_page', $request->getParameter('max_per_page', null));

      $this->redirect(array('sf_route' => '<?php echo $this->getUrlForAction('list') ?>'));
    }

    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }
