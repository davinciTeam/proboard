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
   		<div class="editproject">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-10">
					  	<?php echo form_open('projects/editProjectAction'); ?>
							<label for="title">Projectnaam</label>
								<div class="input-group">
									<input title="Voer hier de naam van het project in" pattern="^[\w !?.]*$" type="input" name="name" class="form-control" value="<?=$project['0']->name ?>" required/>
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true" ></i>
										<i class="darkRed fa fa-star" aria-hidden="false"></i>
									</div>
								</div>
							<label for="text">klant</label>
								<div class="input-group">
									<input title="Voer hier de naam van de klant in" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="client" value="<?=$project['0']->client ?>" required/>
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info"  aria-hidden="true"></i>
										<i class="darkRed fa fa-star" aria-hidden="false"></i>
									</div>
								</div>
							<label for="text">Docent</label>
								<div class="input-group">
									<input title="Voer hier de naam van de docent in" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="teacher" value="<?=$project['0']->teacher ?>" required/>
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
										<i class="darkRed fa fa-star" aria-hidden="false"></i>
									</div>
								</div>
							<label for="text">Github Url</label>
								<div class="input-group">
									<input title="Voer hier de repository url in" type="url" value="<?=$project['0']->git_url ?>" class="form-control" name="git_url">
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Trello Url</label>
								<div class="input-group">
									<input title="Voer hier de Trello url in" type="url" value="<?=$project['0']->trello_url ?>" class="form-control" name="trello_url">
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Test omgeving Url</label>
								<div class="input-group">
									<input title="Voer hier de url in van de test omgeving" type="url" class="form-control" value="<?=$project['0']->project_url ?>" name="project_url">
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Bug tracking Url</label>
								<div class="input-group">
									<input title="Voer hier de url in van de bug tracking" type="url" value="<?=$project['0']->bug_url ?>" class="form-control" name="bug_url">
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
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
									<textarea maxlength="500" name="description" class="form-control" rows="5" required><?=$project['0']->description ?></textarea>
									<div class="input-group-addon" data-toggle="tooltip"   title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
										<i class="darkRed fa fa-star" aria-hidden="false"></i>
									</div>
								</div>
							<input type="hidden" name="slug" value="<?=$project['0']->slug ?>">
							<input type="submit" name="submit" class="btn btn-blue" value="Project Aanpassen" />

						</form>
						<i class="darkRed fa fa-star" aria-hidden="false"> = verplicht veld</i>

					</div>
				</div>
			</div>
		</div>
    </section>
</div>
