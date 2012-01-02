<div class="sf_admin_pagination">
  [?php if ($pager->haveToPaginate()): ?]
  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/first.png', array('alt' => __('First page', array(), 'sf_admin'), 'title' => __('First page', array(), 'sf_admin'))) ?]
  </a>

  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getPreviousPage() ?]">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/previous.png', array('alt' => __('Previous page', array(), 'sf_admin'), 'title' => __('Previous page', array(), 'sf_admin'))) ?]
  </a>

  [?php foreach ($pager->getLinks(sfConfig::get('app_pages_in_pager', 10)) as $page): ?]
    [?php if ($page == $pager->getPage()): ?]
      [?php echo $page ?]
    [?php else: ?]
      <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $page ?]">[?php echo $page ?]</a>
    [?php endif; ?]
  [?php endforeach; ?]

  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getNextPage() ?]">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Next page', array(), 'sf_admin'))) ?]
  </a>

  <a href="[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=[?php echo $pager->getLastPage() ?]">
    [?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?]
  </a>
  [?php endif; // if have to paginate ?]
  
  &nbsp;&nbsp;&nbsp;кол-во на стр.:
  <select name="max_per_page" id="selectMaxPerPage" onchange="changeFnc()">
    <option value="10" [?php echo $sf_user->getAttribute('max_per_page', 50) == '10' ? 'selected' : '' ?]>10</option>
    <option value="20" [?php echo $sf_user->getAttribute('max_per_page', 50) == '20' ? 'selected' : '' ?]>20</option>
    <option value="50" [?php echo $sf_user->getAttribute('max_per_page', 50) == '50' ? 'selected' : '' ?]>50</option>
    <option value="100" [?php echo $sf_user->getAttribute('max_per_page', 50) == '100' ? 'selected' : '' ?]>100</option>
    <option value="200" [?php echo $sf_user->getAttribute('max_per_page', 50) == '200' ? 'selected' : '' ?]>200</option>
  </select>

  &nbsp;&nbsp;&nbsp;перейти к стр.: <input class="target" type="text" name="page" size="2" id="goToPageNum" /><input type="button" value="ок" onclick="goToPage()" />

</div>
<script>

  function changeFnc(){
    var e = document.getElementById("selectMaxPerPage");
    var mpp = e.options[e.selectedIndex].value;
    document.location = "[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page=1&max_per_page="+mpp;
  }

  function goToPage(){
//    alert(document.getElementById("goToPageNum").value);
    document.location = "[?php echo url_for('@<?php echo $this->getUrlForAction('list') ?>') ?]?page="+document.getElementById("goToPageNum").value;
  }
</script>