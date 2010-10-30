<?php $this->layout = "application.views.layouts.email"; ?>
<?php $login = $this->createAbsoluteUrl('/') ?>
<h2>You account at Chinchilla has succesfully been created!</h2>

<h3>You still have to activate your account by clicking the link below.</h3>

<p>Activation link:<br /> <a href="<?php echo $activation_url; ?>"><?php echo $activation_url; ?></a></p>

<p>After activating your account you will be automatically logged in.</p>
<p>However, you can login to Chinchilla anytime later at <a href="<?php echo $login; ?>"><?php echo $login; ?></a>.</p>

Kind regards,<br />
Robot Chilla
