<?php
echo anchor('admin/index','Back') . "<br />";


//And if the $site variable is not empty we echo it's content by using the generate method of the table class / library
if(!empty($salestable)) echo $this->table->generate($salestable); 

?>
