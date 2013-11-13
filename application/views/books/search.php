<?php echo form_open('books/search') ?>

  <label for="keyword">I want to read</label> 
  <input type="search" name="keyword" placeholder='Book name, author, ISBN, tag' value="<?php echo $keyword ?>"/>
  <input type="submit" name="submit" value="Search" /> 

</form>