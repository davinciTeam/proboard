<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <h1>project-naam: <?=$project['0']->name ?></h1>
	    <h2>huidige leden</h2>
	    <pre><?php foreach ($project['0']->members as $member) { echo $member->name ; echo "<form method=\"post\" action=\"/projects/deleteMembersAction\" class=\"inline\">"; 
	    echo "<input value=\"" .$project['0']->slug ."\" type=\"hidden\" name=\"slug\"><input value=\"" .$member->name ."\" type=\"hidden\" name=\"name\"><button class=\"btn btn-link\" type=\"submit\"><i class=\"glyphicon glyphicon-remove-circle\"></i></button></form>"; } ?></pre>
	
	 	<?php echo form_open('projects/addMembersAction') ?>
		<label>naam nieuw lid</label>
			<div class="form-group">
				<select name="name">
					<?php foreach($project['0']->none_members as $newMember) { ?>
						<option value="<?=$newMember->name ?>"><?=$newMember->name?></option>
					<?php } ?>
				</select>
			</div>
			<input value="<?=$project['0']->slug ?>" type="hidden" name="slug" required/>
			<button type="submit">voeg nieuw lid toe</button>
		</form>
	    
    </section>
</div>


	