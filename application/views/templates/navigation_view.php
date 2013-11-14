<!-- navigation -->
<div class="navbar navbar-static-top">
  <div class="navbar-inner">
    <div class="container">
    <a class="brand" href="<?php echo site_url('') ?>">I Love Reading</a>
    <ul class="nav pull-right">
      <li><a href="<?php echo site_url('') ?>">Home</a></li>
	  <?php if(empty($logged_in)): ?>
	  <li><a href="<?php echo site_url('users/login') ?>">Log In</a></li>
	  <?php else: ?>
      <li><a href="<?php echo site_url('users/view/'.$user_id) ?>"><?php echo $user_name ?>'s Profile</a></li>
	  <li><a href="<?php echo site_url('users/setting') ?>">Setting</a></li>
	  <li><a href="<?php echo site_url('users/logout') ?>">Log Out</a></li>
	  <?php endif ?>
    </ul>
	</div>
  </div>
</div>

<div class="container">