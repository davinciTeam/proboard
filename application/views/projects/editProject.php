<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
    	<?=feedback();?>
   		<div class="editproject">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
					  	<?php echo form_open('projects/editProjectAction'); ?>
							<label for="title">Projectnaam</label>
								<div class="input-group">
									<input title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w !?.]*$" type="input" name="name" class="form-control" value="<?=$project['0']->name ?>" required/>
								</div>
							<label for="text">klant</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="client" value="<?=$project['0']->client ?>" required/>
								</div>
							<label for="text">Docent</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="teacher" value="<?=$project['0']->teacher ?>" required/>
								</div>
							<label for="text">Github Url</label>
								<div class="input-group">
									<input title= type="input" value="<?=$project['0']->git_url ?>" class="form-control" name="git_url" required/>
								</div>
							<label for="text">Trello Url</label>
								<div class="input-group">
									<input title= type="input" value="<?=$project['0']->trello_url ?>" class="form-control" name="trello_url" required/>
								</div>
							<div class="form-group">
								<label>Active</label><br>
								<label><input type="radio" id="active" name="active" value="1"
								 <?php if ($project['0']->active == 1) echo "checked" ?> /> Ja
								</label>
								<label><input type="radio" id="active" name="active" value="0"
								 <?php if ($project['0']->active == 0) echo "checked" ?> /> Nee
								</label>
							</div>
							<label for="text">Beschrijving</label>
								<div class="input-group">
									<textarea maxlength="500" name="description" class="form-control" style="width:450px!important;" required><?=$project['0']->description ?></textarea>
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
