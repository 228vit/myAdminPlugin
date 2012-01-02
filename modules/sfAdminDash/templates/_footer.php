<?php if ($sf_user->isAuthenticated()): ?>
<div id="footer">
  <a href="/">&copy;<?php echo date('Y').' '.sfConfig::get('app_site_name') ?></a></p>
</div>
</div><!--div id="adminWrap"-->

<?php endif; // auth check if ?>
