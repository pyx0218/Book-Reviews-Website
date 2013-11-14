<html>
<?php echo form_open('books/delete_reading','',array('isbn'=>$isbn)); ?>
<label>Changing this status will delete all your notes. Do you want to continue?</label><br>
<input type="submit" name="yes" value="Yes" />&nbsp;&nbsp;
<input type="submit" name="no" value="No" />  
</form>
</html>