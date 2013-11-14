<div class="container">
<h2>Log In</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/login') ?>

  <label for="text">Username:</label> 
  <input type="text" name="username" value="<?php echo set_value('username'); ?>" /><br>

  <label for="text">Password:</label>
  <input type="password" name="password"><br>
  
  <input type="submit" class="btn" name="submit"/> 
</form>
<a href = "/index.php/users/registration">Press here for registration!</a><br>
