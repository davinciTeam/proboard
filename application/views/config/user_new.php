<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header ">
		<div class="col-md-12"><?=RenderBreadCrum()?></div>
		<div class="col-md-12"><?=feedback();?></div>
		<h1>Gebruikers<small>New</small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
		  <div class="box box-success">
		  	<?=form_open('Users/NewUserAction') ?>
		    <div class="box-header">
		      <button type="submit" class="btn btn-success pull-right">Opslaan</button>
		    </div>
		    <div class="box-body">	
		    	
		    	  <div class="row">
		   					
						<div class="form-group col-md-6">
					        <label>Naam</label>
					        <input type="text" class="form-control" placeholder="Naam" name="name">
					    </div>

					    <div class="form-group col-md-6">
					        <label>E-mail</label>
					        <input type="emial" class="form-control" placeholder="E-mail" name="email">
					    </div>
					
					    <div class="form-group col-md-6">
					        <label>Gebruikersnaam</label>
					        <input type="text" class="form-control" placeholder="Gebruikersnaam" name="username">
					    </div>
		    		</div>
				
		    </div>
		    </form>
		   </div>
		  </div>
		</div>
	</section>
</div>