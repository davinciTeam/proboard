<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<div class="col-md-12">
      <?=RenderBreadCrum()?>
    </div>
    <section class="content">
    	<div class="col-md-12">
    		<?=feedback();?>
    	</div>
    	<div class="addmember">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-10">
					  	<?php echo form_open('members/addMemberAction'); ?>
							<label for="ovnumber">Ov-nummer</label>
								<div class="input-group">
									<input type="number" class="form-control" id="ovnumber" max="99999999" name="ovnumber" required/>
									<div class="input-group-addon">
										<i class="fa fa-info" data-toggle="tooltip"  aria-hidden="true" title="Alleen de nummers 0-9 toegestaan"></i>
									</div>
								</div>
							<label for="name">Voornaam</label>
								<div class="input-group">
									<input type="text" class="form-control"  maxlength="100" name="name" required/>
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)"></i>
									</div>
								</div>
							<label for="insertion">Tussenvoegsel</label>
								<div class="input-group">
									<input type="input" class="form-control" maxlength="100" name="insertion">
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)"></i>
									</div>
								</div>
							<label for="lastname">Achternaam</label>
								<div class="input-group">
									<input type="input" class="form-control" maxlength="100" name="lastname" required/>
									<div class="input-group-addon">
										<i class="fa fa-question" data-toggle="tooltip"  aria-hidden="true" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)"></i>
									</div>
								</div>
							<button type="submit" class="btn btn-blue">Studenten Aanmaken</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	