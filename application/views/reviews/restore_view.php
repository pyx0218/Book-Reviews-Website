<h2><?php echo $review_item['RTITLE']; ?></h2>

<?php echo validation_errors(); ?>
<?php echo form_open('reviews/restore/'.$review_item['RID']); ?>

<label for="content">Reason for restoring:</label>
  <textarea name="content"><?php echo set_value('content'); ?></textarea></br>
  <input type="submit" name="submit" value="Submit" /> &nbsp;&nbsp;
  <input type="submit" name="cancel" value="Cancel" /> <br>
  </form>