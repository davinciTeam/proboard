<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
   		<div class="editproject">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
					  	<?php echo form_open('projects/editProjectAction'); ?>
							<label for="title">Projectnaam</label>
								<div class="input-group">
									<input type="input" name="name" class="form-control" value="<?=$project['0']->name ?>" required/>
								</div>
							<label for="text">klant</label>
								<div class="input-group">
									<input type="input" class="form-control" name="client" value="<?=$project['0']->client ?>" required/>
								</div>
							<label for="text">Docent</label>
								<div class="input-group">
									<input type="input" class="form-control" name="teacher" value="<?=$project['0']->teacher ?>" required/>
								</div>
							<label for="text">Beschrijving</label>
								<div class="input-group">
									<textarea name="description" class="form-control" style="width:450px!important;" required><?=$project['0']->description ?></textarea>
								</div>
							<input type="hidden" name="slug" value="<?=$project['0']->slug ?>">
							<input type="submit" name="submit" class="btn btn-blue" value="Project Aanpassen" />

						</form>

					</div>
				</div>
			</div>
		</div>
    </section>
</div>
