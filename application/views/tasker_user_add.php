
<h2>Add User</h2>
<div class='row'>
	<div class='span10'>
		<?php
			echo form_open('user/add', array('class' => 'form-horizontal'));
		?>
		<fieldset>
			<div class='control-group<?php print $validation_css?>'>
			  <?php
			    echo form_label("First Name", 'firstname', array('class' => 'control-label'));
			    echo "<div class='controls'>";
			    echo form_input('firstname', set_value('firstname', ''));
			    echo form_error('firstname');
			    echo "</div>";
			  ?>
			</div>
			<div class='control-group<?php print $validation_css?>'>
			  <?php
			    echo form_label("Last Name", 'lastname', array('class' => 'control-label'));
			    echo "<div class='controls'>";
			    echo form_input("lastname", set_value('lastname', ''));
			    echo form_error('lastname');
			    echo "</div>";
			   ?>
			</div>
			      <div class='form-actions'>
			      <?php
			        echo form_button( array(
			          'name' => 'user_add_submit',
			          'type' => 'submit',
			          'content' => 'Add User',
			          'class' => 'btn btn-primary'
			        ));
			        echo form_button( array(
			          'name' => 'reset',
			          'type' => 'reset',
			          'content' => "Reset",
			          'class' => 'btn'
			        ));
			        //echo form_reset("reset", "Reset", array('class' => 'btn'));
			      ?>
			    </div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>