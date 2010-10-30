<?php $this->layout = "application.views.layouts.email"; ?>
<?php $login = $this->createAbsoluteUrl('/'); ?>
<h2>You account at Chinchilla has been succesfully created!</h2>

<p>You can login to Chinchilla anytime at <a href="<?php echo $login; ?>"><?php echo $login; ?></a>.</p>

Kind regards,<br />
Robot Chilla
