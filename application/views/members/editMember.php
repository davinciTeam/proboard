<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
				  	<?php echo form_open('members/editMemberAction'); ?>
						<label for="title">OV-Nummer</label>
							<div class="form-group">
								<input type="input" name="ovnumber" value="<?=$member['0']->ovnumber ?>" required/>
							</div>
						<label for="text">Voornaam</label>
							<div class="form-group">
								<input type="input" name="name" value="<?=$member['0']->name ?>" required/>
							</div>
						<label for="text">Tussenvoegsel</label>
							<div class="form-group">
								<input type="input" name="insertion" value="<?=$member['0']->insertion ?>" required/>
							</div>
						<label for="text">Achternaam</label>
							<div class="form-group">
								<input type="input" name="lastname" value="<?=$member['0']->lastname ?>" required/>
							</div>
						<input type="submit" name="submit" value="Student Aanpassen" />
						<input type="hidden" name="slug" value="<?=$member['0']->slug ?>">

					</form>

				</div>
			</div>
		</div>
    </section>
</div>
