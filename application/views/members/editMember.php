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
    	<div class="editmember">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-10">
					  	<?php echo form_open('members/editMemberAction'); ?>
							<label for="title">OV-Nummer</label>
								<div class="input-group">
									<input type="number" class="form-control" name="ovnumber" value="<?=$member['0']->ovnumber ?>" required/>
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 toegestaan"></i>
									</div>
								</div>
							<label for="text">Voornaam</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" name="name" class="form-control" value="<?=$member['0']->name ?>" required/>
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)"></i>
									</div>
								</div>
							<label for="text">Tussenvoegsel</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" name="insertion" class="form-control" value="<?=$member['0']->insertion ?>" />
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)"></i>
									</div>
								</div>
							<label for="text">Achternaam</label>
								<div class="input-group">
									<input title="Alleen de letters a-z, en spaties zijn toegestaan(niet hoofdlettergevoelig)" pattern="^[\w öóáäéýúíÄËÿüïöÖÜǧ]*$" type="input" name="lastname" class="form-control" value="<?=$member['0']->lastname ?>" required/>
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)"></i>
									</div>
								</div>

							<div class="form-group">
								<label>Active</label><br>
								<label><input type="radio" id="active" name="active" value="1"
								 <?php if ($member['0']->active == 1) echo "checked" ?> /> Ja
								</label>
								<label><input type="radio" id="active" name="active" value="0"
								 <?php if ($member['0']->active == 0) echo "checked" ?> /> Nee
								</label>
							</div>
							<input type="hidden" name="slug" value="<?=$member['0']->slug ?>">
							<button type="submit" class="btn btn-blue">Student Aanpassen</button>
						</form>

					</div>
				</div>
			</div>
		</div>
    </section>
</div>
