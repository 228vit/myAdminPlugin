<style>
  body {
    font-size: 10px;
  }
  ul.error_list {
    color: red;
  }
</style>

<div id="loginFormDiv" title="Login required">
<form id="loginForm" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table cellspacing="0" cellpadding="0" width="300">
    <tr id="loginFormBody">
      <td><img hspace="4" src="/sf/sf_default/images/icons/lock48.png" /></td>
      <td>
        <table cellpadding="4">
          <?php echo $form ?>
          </table>
      </td>
    </tr>
  </table>
  <div id="submitRow"><input type="submit" value="ok" /></div>
</form>
</div>
<script>
$(document).ready(function() {
  // hide submit button
  $('#submitRow').hide(); 
  $('#loginFormDiv').dialog({
      width: 'auto',
      height: 'auto',
      closeOnEscape: false,
			modal: true,
      buttons: [{
        text: "Ok",
        click: function() {
          $('#loginForm').submit(); 
        }
      }]
  });
  $("#signin_username").focus();
});
</script>
