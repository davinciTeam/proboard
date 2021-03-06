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
    	<div class="edittag">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-md-10">
					  	<?php echo form_open('tags/editTagAction'); ?>
					  		<i class="darkRed fa fa-star important-star" aria-hidden="false"></i>
							<label for="title">Naam</label>
								<div class="input-group">
									<input type="text" class="form-control" name="name" value="<?=$tags['0']->name ?>" required/>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .!?/ en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>
								<i class="darkRed fa fa-star important-star" aria-hidden="false"></i>
								<label for="text">Beschrijving</label>
								<div class="input-group">
									<textarea maxlength="500" name="description" class="form-control" rows="5" required><?=$tags['0']->description ?></textarea>
									<div class="input-group-addon" data-toggle="tooltip" title="Alleen de letters a-z .!?/ en spaties zijn toegestaan(niet hoofdlettergevoelig)">
										<i class="fa fa-info" aria-hidden="true"></i>
									</div>
								</div>

							<div class="form-group">
								<label>Active</label><br>
								<label><input type="radio" id="active" name="active" value="1"
								 <?php if ($tags['0']->active == 1) echo "checked" ?> /> Ja
								</label>
								<label><input type="radio" id="active" name="active" value="0"
								 <?php if ($tags['0']->active == 0) echo "checked" ?> /> Nee
								</label>
							</div>
							<input type="hidden" name="slug" value="<?=$tags['0']->slug ?>">
							<button type="submit" class="btn btn-blue">Tag Aanpassen</button>
						</form>
						<i class="darkRed fa fa-star" aria-hidden="false"> = verplicht veld</i>

					</div>
				</div>
			</div>
		</div>
    </section>
</div>
