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
	    <h1>Project naam:  <?=$project['0']->name ?></h1>
	    <h2>Huidige Tags</h2>
	    <pre><?php foreach ($project['0']->tags as $tag) { echo $tag->name; ?> <form method="post" action="/projects/deleteTagsAction" class="inline"><input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" /><input value="<?=$project['0']->slug?>" type="hidden" name="projectSlug"><input value="<?=$tag->slug?>" type="hidden" name="tagSlug"><button class="btn btn-link" type="submit"><i class="glyphicon glyphicon-remove-circle"></i></button></form><?php  } ?></pre>
	
	 	<?php echo form_open('projects/addTagsAction') ?>
		<label>naam nieuw lid</label>
			<div class="form-group">
				<select name="name">
					<?php foreach($project['0']->none_tags as $newTags) { ?>
						<option value="<?=$newTags->slug ?>"><?=$newTags->name?></option>
					<?php } ?>
				</select>
			</div>
			<input value="<?=$project['0']->slug ?>" type="hidden" name="slug" required/>
			<button class="btn btn-blue" type="submit">Voeg nieuwe Tag toe</button>
		</form>
	    
    </section>
</div>


	