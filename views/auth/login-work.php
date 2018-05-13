<!DOCTYPE HTML>
<html lang="en-US">
<?= link_tag('css/login.css'); ?>

<body>
<div id="login-wrapper" class="clearfix mainInfo">
	<div class="main-col">
		<!--<img src="img/beoro.png" alt="" class="logo_img" />-->
		<div class="panel">

			<div id="infoMessage"><?php echo $message; ?></div>

			<?php echo form_open("auth/login"); ?>

			<p>
				<label for="email">Email:</label>
				<?php echo form_input($email); ?>
			</p>

			<p>
				<label for="password">Password:</label>
				<?php echo form_input($password); ?>
			</p>

			<p>
				<label for="remember">Remember Me:</label>
				<?php echo form_checkbox('remember', '1', FALSE); ?>
			</p>


			<p><?php echo form_submit('submit', 'Login'); ?></p>


			<?php echo form_close(); ?>


		</div>


	</div>
</div>
</body>
</html>

<!--<div class='mainInfo'>

	<div class="pageTitle">Login</div>
    <div class="pageTitleBorder"></div>
	<p>Please login with your email address and password below.</p>
	
	<div id="infoMessage"><?php echo $message; ?></div>
	
    <?php echo form_open("auth/login"); ?>
    	
      <p>
      	<label for="email">Email:</label>
      	<?php echo form_input($email); ?>
      </p>
      
      <p>
      	<label for="password">Password:</label>
      	<?php echo form_input($password); ?>
      </p>
      
      <p>
	      <label for="remember">Remember Me:</label>
	      <?php echo form_checkbox('remember', '1', FALSE); ?>
	  </p>
      
      
      <p><?php echo form_submit('submit', 'Login'); ?></p>

      
    <?php echo form_close(); ?>

</div>
-->