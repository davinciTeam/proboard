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
    	<div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
	    			<a href="/projects/addProject" class="add"><i class="fa fa-plus-circle" aria-hidden="true"> project aanmaken</i></a>
	    		</div>
	    	</div>
    	</div>
    	<?php if (!empty($projects)) { ?>
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
					<th>Docent</th>
					<th>Leden</th>
                    <th>Acties</th>
					<th>Actief</th>
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
						echo $member->name." ".$member->insertion." ".$member->lastname.",  "; } ?></td>
					<td class="actions"><a title="Leden beheren" href="/projects/Members/<?=$project->slug ?>"><i class="fa fa-users" aria-hidden="true"></i></a>
					<a title="Tags beheren" href="/projects/tags/<?=$project->slug ?>"><i class="fa fa-tag" aria-hidden="true"></i></a>
					<a title="Project Bewerken" href="/projects/editProject/<?=$project->slug ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><label><?php if($project->active == 1){
						echo "<i class='fa fa-circle green-text' aria-hidden='true'></i>";
					}else{
						echo "<i class='fa fa-circle red-text' aria-hidden='true'></i>";
					}?>
					
					</label></td>
				</tr>
			  	
			<?php
			    }
			?>

			</tbody>
		</table>
		<?php } else { ?>
	        <div class="col-md-12">
	          <div class="panel panel-default">
	            <div class="panel-body">
	               Er zijn nog geen projecten
	            </div>
	          </div>
	        </div>
	    <?php } ?>	
		
    </section>
</div>