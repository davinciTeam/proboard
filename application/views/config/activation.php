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
		<?=form_open('dashboard/activationAction') ?>
			<label>Wachtwoord</label> <i class="darkRed fa fa-star" aria-hidden="false"></i>
			<div class="input-group">
				<input class="form-control" type="password" name="password">
			</div>
			<label>Wachtwoord bevestigen</label> <i class="darkRed fa fa-star" aria-hidden="false"></i>
			<div class="input-group">
				<input class="form-control" type="password" name="password_repeat">
			</div>
			<input value="<?=$user->activation_hash ?>" type="hidden" name="activation_hash" required/>
			<button class="btn btn-blue" type="submit">Activeer acount</button>
		</form>
		<i class="darkRed fa fa-star" aria-hidden="false"> = verplicht veld</i>
    </section>
</div>