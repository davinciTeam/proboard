<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
				  	<?php echo form_open('projects/add_project'); ?>
						<label for="title">Projectnaam</label>
							<div class="form-group">
								<input type="input" name="name" required/>
							</div>
						<label for="text">klant</label>
							<div class="form-group">
								<input type="input" name="client" required/>
							</div>
						<label for="text">docent</label>
							<div class="form-group">
								<input type="input" name="teacher" required/>
							</div>
						<label for="text">leden</label>
							<div class="form-group">
								<input type="input" name="members" required/>
							</div>
						<label for="text">Beschrijving</label>
							<div class="form-group">
								<textarea name="description" required></textarea>
							</div>
						<input type="hidden" name="posted" value="1">
						<input type="submit" name="submit" value="Project toevoegen" />

					</form>

				</div>
			</div>
		</div>
    </section>
</div>


	