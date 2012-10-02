<div class='row'>
	<div class='span5'>
		<h2><?php print $user->getName();?></h2>
		<a class='btn btn-primary' href='<?php print base_url("user/$user->uid/addTask")?>'>New Task</a>
	</div>
	<div class='span5'>
		<div class='row'>
			<h4>Today's Tasks</h4>
		</div>
		
	</div>
</div>
<div class='row'>
	<div class='span10'>
		<h4>Upcoming Tasks</h4>
		<?php 
			$tmpl = array ('table_open'  => '<table class="table">' );
			$this->table->set_template($tmpl);
			print $this->table->generate($task_table_data); 
		?>
	</div>
</div>

<pre>
<?php //print_r($users); ?>
</pre>