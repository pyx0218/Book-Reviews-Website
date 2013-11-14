<html>
<?php echo form_open('books/delete_read','',array('isbn'=>$isbn)); ?>
<label>Changing this status will delete all your reviews. Do you want to continue?</label><br>
<input type="submit" name="yes" value="Yes" />&nbsp;&nbsp;
<input type="submit" name="no" value="No" />  
</form>
</html>