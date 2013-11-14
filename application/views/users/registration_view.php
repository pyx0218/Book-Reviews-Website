 <div class="container">
  <h2>Registration</h2>
  <?php echo validation_errors('<p class="error">'); ?>
  <?php echo form_open("users/registration"); ?>
  <p>
  <label for="user_name">Username:</label>
  <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
  </p>
  <p>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
  </p>
  <p>
  <label for="con_password">Confirm Password:</label>
  <input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
  </p>
  <p>
  <input type="submit" class="btn" value="Submit" />
  </p>
 <?php echo form_close(); ?>
 <a href = "/index.php/users/login/">Return back to Login!</a><br>
