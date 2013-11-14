<h2><?php echo $BNAME; ?></h2>

<?php echo validation_errors();?>
<?php echo form_open('notes/update','',array('nid'=>$NID)); ?>

  <label for="title">Page</label> 
  <input type="text" name="page" class="span4" value="<?php echo $PAGE; ?>"/><br>
  
  <label for="content">Content</label>
  <textarea name="content" class="span6" rows="10"><?php echo $NCONTENT; ?></textarea><br>
  
  <label for="visibility">Visibility</label>
  <input type="radio" name="visibility" value="1" <?php if($VISIBILITY==1) echo 'checked'?>/>Only my friends can see it &nbsp;&nbsp;
  <input type="radio" name="visibility" value="2" <?php if($VISIBILITY==2) echo 'checked'?>/>Everybody can see it <br><br>
  
    <input type="submit" name="submit" class="btn"  value="Save" />&nbsp;&nbsp;
  <input type="submit" name="cancel" class="btn"  value="Cancel" />  

</form>