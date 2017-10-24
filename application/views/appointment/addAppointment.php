<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
		<div class="col-md-12">
		  <?=RenderBreadCrum()?>
		</div>
		<div class="col-md-12">
    		<?=feedback();?>
    	</div>
    	<div class="addproject">
		    <div class="container">
		    	<div class="row">
			    	<div class="col-md-12">
			    		<h1> Project: <?php echo $projects['0']->name ;?></h1>
			    	</div>
		    		<div class="col-md-6">
					  	<?php echo form_open('appointment/addAppointmentAction'); ?>
							<div class="input-group">
								<label>Iteratie dag</label><br>
									<input type="text" name="iteration_date"
 									value="<?php if ($projects['0']->iteration_date != null or "") echo $projects['0']->iteration_date  ?>">
							</div>
							<div class="input-group">
								<label>Start Iteratie</label><br>
								<input type="text" name="iteration_start"
 								value="<?php if ($projects['0']->iteration_start != null or "") echo $projects['0']->iteration_start  ?>">
							</div>
							<div class="input-group">
								<label>Iteratie einde</label><br>
								<input type="text" name="iteration_end"
 								value="<?php if ($projects['0']->iteration_end != null or "") echo $projects['0']->iteration_end  ?>">
							</div>
								
							<button type="submit" class="btn btn-blue">Afsrpaak toevoegen</button>
						
					</div>
					<div class="col-md-6">
						<div class="input-group">
							<label>code review dag</label><br>
								<input type="text" name="iteration_date"
								 value="<?php if ($projects['0']->code_date != null or "") echo $projects['0']->code_date  ?>">
							</div>
					
							<label>Starttijd Code review</label>
								<div class="input-group">
									<input type="text" name="code_start"
 									value="<?php if ($projects['0']->code_start != null or "") echo $projects['0']->code_start  ?>" >
								   
								</div>
								<div class="input-group">
									<label>eindtijd code review</label><br>
									<input type="text" name="code_end"
									 value="<?php if ($projects['0']->code_end != null or "") echo $projects['0']->code_end  ?>">
								</div>
								<input type="hidden" name="slug" value="<?=$projects['0']->slug ?>">
							<!-- <button type="submit" class="btn btn-blue">Afsrpaak toevoegen</button> -->
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>