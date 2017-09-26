<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
				  	<?php echo form_open('projects/editProjectAction'); ?>
						<label for="title">Projectnaam</label>
							<div class="form-group">
								<input type="input" name="name" value="<?=$project['0']->name ?>" required/>
							</div>
						<label for="text">klant</label>
							<div class="form-group">
								<input type="input" name="client" value="<?=$project['0']->client ?>" required/>
							</div>
						<label for="text">Docent</label>
							<div class="form-group">
								<input type="input" name="teacher" value="<?=$project['0']->teacher ?>" required/>
							</div>
						<label for="text">Leden</label>
							<div class="form-group">
								<!-- <input type="input" name="members" value="<?=$project['0']->description ?>" required/> -->
							</div>
						<label for="text">Beschrijving</label>
							<div class="form-group">
								<input type="text" name="description" required value="<?=$project['0']->description ?>"></textarea>
							</div>
						<input type="hidden" name="posted" value="1">
						<input type="hidden" name="slug" value="<?=$project['0']->slug ?>">
						<input type="submit" name="submit" value="Project Aanpassen" />

					</form>

				</div>
			</div>
		</div>
    </section>
</div>
