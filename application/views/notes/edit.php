<h2><?php echo $BNAME; ?></h2>

<?php echo validation_errors();?>
<?php echo form_open('notes/update','',array('nid'=>$NID)); ?>

  <label for="title">Page</label> 
  <input type="text" name="page" value="<?php echo $PAGE; ?>"/></br>
  
  <label for="content">Content</label>
  <textarea name="content" ><?php echo $NCONTENT; ?></textarea></br>
  
    <input type="submit" name="submit" value="Save" />&nbsp;&nbsp;
  <input type="submit" name="cancel" value="Cancel" />  

</form>