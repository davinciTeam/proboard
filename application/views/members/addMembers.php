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
		    		<div class="col-md-12">
					  	<?php echo form_open('members/addMemberAction'); ?>
							<label for="ovnumber">Ov-nummer</label>
								<div class="input-group">
									<input type="number" class="form-control" id="ovnumber" max="99999999" name="ovnumber" required/>
								</div>
							<label for="name">Voornaam</label>
								<div class="input-group">
									<input type="text" class="form-control"  maxlength="100" name="name" required/>
								</div>
							<label for="insertion">Tussenvoegsel</label>
								<div class="input-group">
									<input type="input" class="form-control" maxlength="100" name="insertion">
								</div>
							<label for="lastname">Achternaam</label>
								<div class="input-group">
									<input type="input" class="form-control" maxlength="100" name="lastname" required/>
								</div>
							<button type="submit" class="btn btn-blue">Studenten Aanmaken</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	