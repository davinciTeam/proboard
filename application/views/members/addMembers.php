<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
    	<div class="addmember">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
					  	<?php echo form_open('members/addMemberAction'); ?>
									<label for="ovnumber">Ov-nummer</label>
								<div class="input-group">
									<input type="number" id="ovnumber" class="form-control" min="0" name="ovnumber" required/>
								</div>
									<label for="name">Voornaam</label>
								<div class="input-group">
									<input type="input" class="form-control" pattern="[A-Za-z]{20}" name="name" required/>
								</div>
							<label for="insertion">Tussenvoegsel</label>
								<div class="input-group">
									<input type="input" class="form-control" name="insertion" required/>
								</div>
							<label for="lastname">Achternaam</label>
								<div class="input-group">
									<input type="input" class="form-control" name="lastname" required/>
								</div>
							<button type="submit">Member Aanmaken</button>
						</form>
					</div>
				</div>
			</div>
		</div>
    </section>
</div>


	