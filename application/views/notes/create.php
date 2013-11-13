<h2><?php echo $BNAME; ?></h2>

<?php echo validation_errors();?>
<?php echo form_open('notes/create','',array('isbn'=>$ISBN)); ?>

  <label for="title">Page</label> 
  <input type="text" name="page" value="<?php echo set_value('page'); ?>"/></br>
  
  <label for="content">Content</label>
  <textarea name="content" value="<?php echo set_value('content'); ?>"></textarea></br>
  
  <input type="submit" name="submit" value="Submit" /> 

</form>