<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
				  	<?php echo form_open('members/addMemberAction'); ?>
						<label for="title">Ov-nummer</label>
							<div class="form-group">
								<input type="input" name="ovnumber" required/>
							</div>
						<label for="title">Voornaam</label>
							<div class="form-group">
								<input type="input" name="name" required/>
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


	