<html>
<head>
  <title><?php echo $title ?>-I Love Reading</title>
</head>
<body>
<?php if(!$user_name): ?>
<p>Please <a href="<?php echo site_url('users/login') ?>">Log In</a>.</p>
<?php else: ?>
<p>Welcome <?php echo $user_name ?> !&nbsp;&nbsp;Log Out</p>
<?php endif ?>
  <h1><a href="<?php echo site_url('books') ?>">I Love Reading</a></h1>
  <title><?php echo $title ?></title>
</head>
  <title><?php echo $title ?></title>
</head>
