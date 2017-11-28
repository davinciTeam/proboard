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
					  		<i class="darkRed fa fa-star important-star" aria-hidden="false"></i>
							<label for="ovnumber">Ov-nummer</label>
								<div class="input-group">
									<input type="number" class="form-control" id="ovnumber" max="99999999" name="ovnumber" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de nummers 0-9 zijn toegestaan">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<i class="darkRed fa fa-star important-star" aria-hidden="false"></i>
							<label for="name">Voornaam</label>
								<div class="input-group">
									<input type="text" class="form-control"  maxlength="100" name="name" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<label for="insertion">Tussenvoegsel</label>
								<div class="input-group">
									<input type="input" class="form-control" maxlength="100" name="insertion">
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<i class="darkRed fa fa-star important-star" aria-hidden="false"></i>
							<label for="lastname">Achternaam</label>
								<div class="input-group">
									<input type="input" class="form-control" maxlength="100" name="lastname" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .!? en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
							<button type="submit" class="btn btn-blue">Studenten Aanmaken</button>
						</form>
						<i class="darkRed fa fa-star" aria-hidden="false"> = verplicht veld</i>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	