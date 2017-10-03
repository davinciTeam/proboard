<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
				  	<?php echo form_open('members/addMemberAction'); ?>
							<div class="form-control">
								<label for="ovnumber">Ov-nummer</label>
								<input type="number" id="ovnumber" class="form-control" min="0" name="ovnumber" required/>
							</div>
							<div class="form-control">
								<label for="title">Voornaam</label>
								<input type="input" pattern="[A-Za-z]{20}" name="name" required/>
							</div>
						<label for="text">Tussenvoegsel</label>
							<div class="form-group">
								<input type="input" name="insertion" required/>
							</div>
						<label for="text">Achternaam</label>
							<div class="form-group">
								<input type="input" name="lastname" required/>
							</div>
						<button type="submit">Member Aanmaken</button>
					</form>
				</div>
			</div>
		</div>
    </section>
</div>


	