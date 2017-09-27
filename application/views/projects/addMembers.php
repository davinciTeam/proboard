<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
	    <h1>project-naam: <?=$project['0']->name ?></h1>
	    <h2>huidige leden</h2>
	    <pre><?php foreach ($project['0']->members as $member) { echo $member->name."<br/>"; } ?></pre>
	
		<?php if (!empty($project['0']->members)) { ?>
			<?php echo form_open('projects/deleteMembersAction') ?>
			<label>Verwijderen project lid</label>
				<div class="form-group">
					<select name="name">
						<?php foreach ($project['0']->members as $member) { ?> 
							<option value="<?=$member->name?>"><?=$member->name?></option>
						<?php } ?>
					</select>
				</div>
				<input value="<?=$project['0']->slug ?>" type="hidden" name="slug" required/>
				<button type="submit">Verwijder dit lid</button>
			</form>
			<?php echo form_open('projects/editMembersAction') ?>
			<label>Wijzig dit project lid</label>
				<div class="form-group">
					<label>lid te vervangen</label>
					<select name="old_member">
						<?php foreach ($project['0']->members as $member) { ?> 
							<option value="<?=$member->name?>"><?=$member->name?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Nieuw lid</label>
					<select name="new_member">
						<?php foreach ($project['0']->none_members as $member) { ?> 
							<option value="<?=$member->name?>"><?=$member->name?></option>
						<?php } ?>
					</select>
				</div>
				<input value="<?=$project['0']->slug ?>" type="hidden" name="slug" required/>
				<button type="submit">Wijzig dit lid</button>
			</form>
		<?php } ?>
		<?php echo form_open('projects/addMembersAction') ?>
		<label>naam nieuw lid</label>
			<div class="form-group">
				<input type="input" name="name" required/>
			</div>
			<input value="<?=$project['0']->slug ?>" type="hidden" name="slug" required/>
			<button type="submit">voeg nieuw lid toe</button>
		</form>
	    
    </section>
</div>


	