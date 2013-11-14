<h2><?php echo $BNAME; ?></h2>

<?php echo validation_errors();?>
<?php echo form_open('notes/update','',array('nid'=>$NID)); ?>

  <label for="title">Page</label> 
  <input type="text" name="page" value="<?php echo $PAGE; ?>"/></br>
  
  <label for="content">Content</label>
  <textarea name="content"><?php echo $NCONTENT; ?></textarea></br>
  
  <label for="visibility">visibility</label>
  <input type="radio" name="visibility" value="1" <?php if($VISIBILITY==1) echo 'checked'?>/>Shown to my friends and me! 
  <input type="radio" name="visibility" value="2" <?php if($VISIBILITY==2) echo 'checked'?>/>Shown to all! </br>
  
    <input type="submit" name="submit" value="Save" />&nbsp;&nbsp;
  <input type="submit" name="cancel" value="Cancel" />  

</form>