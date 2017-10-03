<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		
<div class="content-wrapper">
    <section class="content">
      	<table class="table table-striped table-center">
  		
			<thead>
				<tr>
					<th>Ov-Nummer</th>
					<th>Voornaam</th>
					<th>Tussenvoegsel</th>
					<th>Achternaam</th>
                    <th>acties</th>
				</tr>
			</thead>
			<tbody>


			<?php
			    foreach ($members as $member) { 
			?>
			    <tr>
					<td><?=$member->ovnumber;?></td>
					<td><?=$member->name;?></td>
					<td><?=$member->insertion;?></td>
					<td><?=$member->lastname;?></td>
					<td><a href="/members/editMember/<?=$member->slug; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				</tr>
			  	
			<?php
			    }
			?>
				<?php echo form_open_multipart('Members/import');?>
					
					<input type="file" name="userfile">

					<button type="submit">importeren</button>
				</form>	
			</tbody>
		</table>
    </section>
</div>


	