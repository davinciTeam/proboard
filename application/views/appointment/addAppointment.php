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
			    	<div class="col-md-10">
			    		<h1> Project: <?php echo $projects['0']->name ;?></h1>
			    	</div>
		    		<div class="col-md-5">
					  	<?php echo form_open('appointment/addAppointmentAction'); ?>
							<label>Iteratie dag</label>
								<div class="input-group">
									<input type="text" class="form-control" name="iteration_date"
 									value="<?php if ($projects['0']->iteration_date != null or "") echo $projects['0']->iteration_date  ?>">
 									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 en - zijn toegestaan"></i>
									</div>
								</div>
							<label>Start Iteratie</label>
								<div class="input-group">
									<input type="text" class="form-control" name="iteration_start"
 									value="<?php if ($projects['0']->iteration_start != null or "") echo $projects['0']->iteration_start  ?>">
 									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 en : zijn toegestaan"></i>
									</div>
								</div>
							<label>Iteratie einde</label>
								<div class="input-group">
									<input type="text" class="form-control" name="iteration_end"
	 								value="<?php if ($projects['0']->iteration_end != null or "") echo $projects['0']->iteration_end  ?>">
	 								<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 en : zijn toegestaan"></i>
									</div>
								</div>
								
							<button type="submit" class="btn btn-blue">Afsrpaak toevoegen</button>
						
					</div>
					<div class="col-md-5">
							<label>code review dag</label>
								<div class="input-group">
									<input type="text" class="form-control" name="iteration_date"
									 value="<?php if ($projects['0']->code_date != null or "") echo $projects['0']->code_date  ?>">
									 <div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 en - zijn toegestaan"></i>
									</div>
								</div>
							<label>Starttijd Code review</label>
								<div class="input-group">
									<input type="text" class="form-control" name="code_start"
 									value="<?php if ($projects['0']->code_start != null or "") echo $projects['0']->code_start  ?>" >
 									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 en : zijn toegestaan"></i>
									</div>
								</div>
								<label>eindtijd code review</label><br>
									<div class="input-group">
										<input type="text" class="form-control" name="code_end"
										 value="<?php if ($projects['0']->code_end != null or "") echo $projects['0']->code_end  ?>">
										 <div class="input-group-addon">
											<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 en : zijn toegestaan"></i>
										</div>
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