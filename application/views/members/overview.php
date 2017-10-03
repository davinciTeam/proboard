<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		
<div class="content-wrapper">
    <section class="content">
    	<div class="bar">
	    	<div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
		    			<!-- <a href="#" class="add-student"><i class="fa fa-plus-circle" aria-hidden="true"> Student aanmaken   </i></a> -->
		    			<a href="#" class="file"><i class="fa fa-file file" aria-hidden="true"> Bestand importeren</i></a>
		    			<a href="/members/addMember" class="add"><i class="fa fa-plus-circle" aria-hidden="true"> Student aanmaken   </i></a>
		    		</div>
		    		
		    	</div>
	    	</div>
    	</div>
    	<div class="import-file">
	    	<div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
		    			<?php echo form_open_multipart('Members/import');?>
							<label>Importeer een csv bestand</label>
							<input type="file" name="userfile" size="20" />
							<button type="submit">importeren</button>
						</form>
		    		</div>
		    		
		    	</div>
	    	</div>
    	</div>
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


	