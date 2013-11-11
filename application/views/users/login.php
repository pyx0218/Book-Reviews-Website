<h2>Log In</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/login') ?>

  <label for="text">Username:</label> 
  <input type="input" name="username" /><br />

  <label for="text">Password:</label>
  <input type="password" name="password"><br />
  
  <input type="submit" name="submit"/> 

</form>