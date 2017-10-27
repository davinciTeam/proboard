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
					  	<?php echo form_open('projects/addProjectAction'); ?>
					  	
							<label for="title">Projectnaam</label>
								<div class="input-group">
									<input title="Voer hier de projectnaam in" pattern="^[\w !?.]*$" type="input" class="form-control" name="name" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								
								</div>


							<label for="text">klant</label>
								<div class="input-group">
									<input title="Voer hier de naam van de klant in" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="client" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Docent</label>
								<div class="input-group">
									<input title="Voer hier de naam van de docent in" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" class="form-control" name="teacher" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Github Url</label>
								<div class="input-group">
									<input title="Voer hier de repository url in" type="url" class="form-control" name="git_url" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Trello Url</label>
								<div class="input-group">
									<input title="Voer hier de Trello url in" type="url" class="form-control" name="trello_url" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Test omgeving Url</label>
								<div class="input-group">
									<input title="Voer hier de url in van de test omgeving" type="url" class="form-control" name="project_url" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Bug tracking Url</label>
								<div class="input-group">
									<input title="Voer hier de url in van de bug tracking" type="url" class="form-control" name="bug_url" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="text">Beschrijving</label>
								<div class="input-group">
									<textarea maxlength="500" rows="5" name="description" class="form-control" required></textarea>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .0-9 en / - _ zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info"  aria-hidden="true"></i>
									</div>
								</div>
							<button type="submit" class="btn btn-blue">Project toevoegen</button>
							
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	