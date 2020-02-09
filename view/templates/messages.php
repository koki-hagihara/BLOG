<?php foreach(get_errors() as $error){ ?>
  <p><?php print $error; ?></p>
<?php } ?>

<?php foreach(get_messages() as $message){ ?>
  <p><?php print $message; ?></p>
<?php } ?>