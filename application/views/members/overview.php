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
    	<div class="bar">
	    	<div class="container">
		    	<div class="row">
		    		<div class="col-md-12">
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
							<label>Importeer een csv bestand</label><br>
							<label class="btn btn-blue">
							    Selecteer een bestand<input type="file" name="userfile" size="20" class="hidden">
							</label><br>
							<!-- <input type="file" class="btn btn-blue" name="userfile" size="20"/> -->
							<button type="submit" class="btn btn-blue">importeren</button>
						</form>
		    		</div>
		    	</div>
	    	</div>
    	</div>
		<nav class="text-center" aria-label="Page navigation">
  			<ul id="pagination" class="pagination">
    			<?=$this->pagination->create_links() ?>
    		</ul>
    	</nav>
      	<table class="disabled table table-striped table-center">
  		
			<thead>
				<tr>
					<th>Ov-Nummer<i id="ovnumber" class="sorting glyphicon glyphicon-arrow-up"></i></th>
					<th>Voornaam<span id="name" class="sorting glyphicon glyphicon-arrow-up"></span></th>
					<th>Tussenvoegsel<span id="insertion" class="sorting glyphicon glyphicon-arrow-up"></span></th>
					<th>Achternaam<span id="lastname" class="sorting glyphicon glyphicon-arrow-up"></span></th>
                    <th>Acties</th>
                    <th>Actief</th>
				</tr>
			</thead>
			<tbody id="members">

			<?php
			    foreach ($members as $member) { 
			?>
			    <tr>
					<td><?=$member->ovnumber;?></td>
					<td><?=$member->name;?></td>
					<td><?=$member->insertion;?></td>
					<td><?=$member->lastname;?></td>
					<td><a href="/members/editMember/<?=$member->slug; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td>
					<?php if ($member->active == 1) {
						echo "<i class='fa fa-circle green-text' aria-hidden='true'></i>";
					} else {
						echo "<i class='fa fa-circle red-text' aria-hidden='true'></i>";
					} ?>
					</td>	
				</tr>
			  	
			<?php
			    }
			?>
			</tbody>
		</table>
		
    </section>
</div>
<script src="/custom/scripts/members.js"></script>
	