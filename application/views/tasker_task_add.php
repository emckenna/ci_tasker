
<h2>Adding Task for <?php print $display_name?></h2>
<div class='row'>
	<div class='span10'>
		<?php
			echo form_open("task/add/$uid", array('class' => 'form-horizontal'));
			echo form_hidden('creator_uid', $uid);
		?>
		<fieldset>
		    <div class='control-group<?php print $validation_css?>'>
		      <?php
		        echo form_label("Start Date", 'start_date', array('class' => 'control-label'));
		        echo "<div class='controls'>";
		        echo form_input('start_date', set_value('start_date', ''));
		        echo '<span class="help-block">dd/mm/yyyy ex: 05/12/2012</span>';
		        echo form_error('start_date');
		        echo "</div>";
		      ?>
		    </div>
		    <div class='control-group<?php print $validation_css?>'>
		      <?php
		        echo form_label("Start Time", 'start_time', array('class' => 'control-label'));
		        echo "<div class='controls'>";
		        echo form_input('start_time', set_value('start_time', ''));
		        echo '<span class="help-block">hh:MM meridian i.e 04:15 PM</span>';
		        echo form_error('start_time');
		        echo "</div>";
		      ?>
		    </div>
		    <div class='control-group<?php print $validation_css?>'>
		      <?php
		        echo form_label("End Date", 'end_date', array('class' => 'control-label'));
		        echo "<div class='controls'>";
		        echo form_input("end_date", set_value('end_date', ''));
		        echo form_error('end_date');
		        echo "</div>";
		       ?>
		    </div>
		    <div class='control-group<?php print $validation_css?>'>
		      <?php
		        echo form_label("End Time", 'end_time', array('class' => 'control-label'));
		        echo "<div class='controls'>";
		        echo form_input("end_time", set_value('end_time', ''));
		        echo form_error('end_time');
		        echo "</div>";
		       ?>
		    </div>
		    <div class='control-group<?php print $validation_css?>'>
		      <?php
		        echo form_label("Description", 'description', array('class' => 'control-label'));
		        echo "<div class='controls'>";
		        echo form_textarea("description", set_value('description', ''));
		        echo form_error('description');
		        echo "</div>";
		       ?>
		    </div>
		    <div class='control-group<?php print $validation_css?>'>
		      <?php
		        echo form_label("Recurrence", 'recurrence', array('class' => 'control-label'));
		        echo "<div class='controls'>";
		        echo form_dropdown("recurrence", $recurrence_opts, set_value('recurrence', ''));
		        echo form_error('recurrence');
		        echo "</div>";
		       ?>
		    </div>

		    <div class='form-actions'>
			<?php
				echo form_button( array(
				  'name' => 'task_add_submit',
				  'type' => 'submit',
				  'content' => 'Add Task',
				  'class' => 'btn btn-primary'
				));
				echo form_button( array(
				  'name' => 'reset',
				  'type' => 'reset',
				  'content' => "Reset",
				  'class' => 'btn'
				));
			?>
			</div>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>