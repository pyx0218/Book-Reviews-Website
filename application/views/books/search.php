<br>
<br>
<div class="row">
	<?php echo form_open('books/search',array('class'=>'form-search')) ?>

	  <label for="keyword">I want to read </label> &nbsp;&nbsp;
	  <input type="search" name="keyword" class="span4 input-large" id="appendedInputButton" placeholder='Book name, author, ISBN, tag' value="<?php echo $keyword ?>"/>&nbsp;&nbsp;
	  <input type="submit" name="submit" class="btn" value="Search" /> 

	</form>
</div>