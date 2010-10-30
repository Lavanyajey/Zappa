<?php $this->layout = "application.views.layouts.email"; ?>
<?php $login = $this->createAbsoluteUrl('/') ?>
<h2>You have requested a password recovery</h2>

<p>To reset your password, please go to <a href="<?php echo $activation_url; ?>"><?php echo $activation_url; ?></a>.</p>

Kind regards,<br />
Robot Chilla
