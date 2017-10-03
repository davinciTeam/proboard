<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
    	<div class="addproject">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
					  	<?php echo form_open('projects/addProjectAction'); ?>
							<label for="title">Projectnaam</label>
								<div class="input-group">
									<input type="input" class="form-control" name="name" required/>
								</div>
							<label for="text">klant</label>
								<div class="input-group">
									<input type="input" class="form-control" name="client" required/>
								</div>
							<label for="text">Docent</label>
								<div class="input-group">
									<input type="input" class="form-control" name="teacher" required/>
								</div>
							<label for="text">Beschrijving</label>
								<div class="input-group">
									<textarea style="width:450px!important;" name="description" class="form-control" required></textarea>
								</div>
							<button type="submit" class="btn btn-blue">Project toevoegen</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	