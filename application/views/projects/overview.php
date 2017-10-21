<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
    	<?=feedback();?>
    	<div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
	    			<a href="/projects/addProject" class="add"><i class="fa fa-plus-circle" aria-hidden="true"> project aanmaken</i></a>
	    		</div>
	    	</div>
    	</div>
    	<nav class="text-center" aria-label="Page navigation">
  			<ul class="pagination">
    			<?=$this->pagination->create_links() ?>
    		</ul>
    	</nav>
      	<table class="table table-striped table-center">
			<thead>
				<tr>
					<th>Projectnaam</th>
					<th>Klant</th>
					<th>docent</th>
					<th>leden</th>
					<th>Active</th>
                    <th>acties</th>
				</tr>
			</thead>
			<tbody>
			<?php
			    foreach ($projects as $project) { 
			?>
			    <tr>
					<td><?=$project->name;?></td>
					<td><?=$project->client;?></td>
					<td><?=$project->teacher;?></td>
					<td><?php foreach ($project->members as $member) { 
						echo $member->name." ".$member->insertion." ".$member->lastname." "; } ?></td>
					<td><a href="/projects/Members/<?=$project->slug ?>">leden beheren</a></td>
					<td><label>
					
					</label></td>
					<td><a href="/projects/editProject/<?=$project->slug ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				</tr>
			  	
			<?php
			    }
			?>

			</tbody>
		</table>
		<nav class="text-center" aria-label="Page navigation">
  			<ul class="pagination">
    			<?=$this->pagination->create_links() ?>
    		</ul>
    	</nav>
    </section>
</div>