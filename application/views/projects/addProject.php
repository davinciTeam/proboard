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
					  	<?php echo form_open('projects/addProjectAction'); ?>
							<label for="title">Projectnaam</label>
								<div class="input-group">
									<input title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w !?.]*$" type="input" class="form-control" name="name" required/>
								</div>
							<label for="text">klant</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="client" required/>
								</div>
							<label for="text">Docent</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="teacher" required/>
								</div>
							<label for="text">Github Url</label>
								<div class="input-group">
									<input title= type="input" class="form-control" name="git_url" required/>
								</div>
							<label for="text">Trello Url</label>
								<div class="input-group">
									<input title= type="input" class="form-control" name="trello_url" required/>
								</div>
							<label for="text">Beschrijving</label>
								<div class="input-group">
									<textarea maxlength="500" style="width:450px!important;" name="description" class="form-control" required></textarea>
								</div>
							<button type="submit" class="btn btn-blue">Project toevoegen</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	