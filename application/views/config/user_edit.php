<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header ">
		<div class="col-md-12"><?=RenderBreadCrum()?></div>
		<div class="col-md-12"><?=feedback();?></div>
		<h1>Gebruikers<small>Edit</small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
		  <div class="box box-success">
		  	<?=form_open('Users/editUserAction') ?>
		    <div class="box-header">
		      <h3 class="box-title">Gebruiker &quot;<?=$user_data['0']->name?>&quot;</h3>
		      <button type="submit" class="btn btn-success pull-right">Opslaan</button>
		    </div>
			<input type="hidden" name="id" value="<?=$user_data['0']->id?>">
		    <div class="box-body">	
		    	
		    	  <div class="row">
		   					
						<div class="form-group col-md-6">
					        <label>Naam</label>
					        <input type="text" class="form-control" placeholder="Naam" value="<?=$user_data['0']->name?>" name="name" required>
					    </div>

					    <div class="form-group col-md-6">
					        <label>E-mail</label>
					        <input type="email" class="form-control" placeholder="E-mail" value="<?=$user_data['0']->email?>" name="email" required>
					    </div>
					
					    <div class="form-group col-md-6">
					        <label>Gebruikersnaam</label>
					        <input type="text" class="form-control" placeholder="Gebruikersnaam" value="<?=$user_data['0']->username?>" name="username" required>
					    </div>
		    		</div>
				
		    </div>
		    </form>
		   </div>
		  </div>
		</div>
	</section>
</div>