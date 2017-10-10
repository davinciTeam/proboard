<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
    	<?=feedback();?>
	    <h1>project-naam: <?=$project['0']->name ?></h1>
	    <h2>huidige leden</h2>
	    <pre><?php foreach ($project['0']->members as $member) { echo $member->name." ".$member->insertion." ".$member->lastname ; ?> <form method="post" action="/projects/deleteMembersAction" class="inline"><input type="hidden" name="<?=$name;?>" value="<?=$hash;?>" /><input value="<?=$project['0']->slug?>" type="hidden" name="projectSlug"><input value="<?=$member->slug?>" type="hidden" name="MemberSlug"><button class="btn btn-link" type="submit"><i class="glyphicon glyphicon-remove-circle"></i></button></form><?php  } ?></pre>
	
	 	<?php echo form_open('projects/addMembersAction') ?>
		<label>naam nieuw lid</label>
			<div class="form-group">
				<select name="name">
					<?php foreach($project['0']->none_members as $newMember) { ?>
						<option value="<?=$newMember->slug ?>"><?=$newMember->name." ".$newMember->insertion." ".$newMember->lastname?></option>
					<?php } ?>
				</select>
			</div>
			<input value="<?=$project['0']->slug ?>" type="hidden" name="slug" required/>
			<button type="submit">voeg nieuw lid toe</button>
		</form>
	    
    </section>
</div>


	