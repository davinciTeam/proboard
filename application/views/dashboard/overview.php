<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="col-md-12">
      <?=RenderBreadCrum()?>
    </div>
    <div class="col-md-12">
      <?=feedback();?>
    </div>

 
    <?php if ($admin) { ?>
      <div class="col-md-12"> <div class="input-group input-group-lg"><input name="search" type="text" class="form-control" aria-describedby="search_icon"><span class="input-group-addon" id="search_icon"><i class="fa fa-search" aria-hidden="true"></span></div></i></div>
    <?php } ?>


    <div class="container">
      	<div class="row">
	   		<div class="col-md-11 blue-text">
	      		<h1>Afspraken van Vandaag</h1>
	    	</div>
	    </div>
	</div>
    <div class="container">
      <div class="row">
        <div class="col-md-<?php if ($admin) { ?>10<?php } else { ?>12<?php } ?>">

				<?php if (empty(!$project_items)){?>
          <div class="table-responsive">
  		      <table class="table table-striped table-center">
  						<thead>
  							<tr>
  								<th>Projectnaam</th>
  								<th>Klant</th>
  								<th>Docent</th>
  								<th>Leden</th>
  								<th>Datum code review</th>
  								<th>Datum iteratie</th>
  								<th>Opmerking</th>
  							</tr>
  						</thead>
  						<tbody>
  		    			<?php foreach($project_items as $project_item) { ?>
  				          	<tr>
  				          		<td><?=$project_item->name ?> <span data-toggle="tooltip" title="<?=$project_item->description ?>" class="glyphicon glyphicon-comment"></span></td>
  				          		<td><?=$project_item->teacher ?></td>
  		              			<td><?=$project_item->client ?></td>
  				          		<td><?php foreach ($project_item->members as $member) { 
              						echo $member->name." ".$member->insertion." ".$member->lastname." "; } ?></td>
  				          		<td><?=displayTime($project_item->iteration_start) ?></td>
  				          		<td><?=displayTime($project_item->code_review_start) ?></td>
  				          		<td><span class="glyphicon glyphicon-comment"></span></td>
  				          	</tr>
  		    			<?php } ;?>
    				</tbody>
    			</table>
        </div>
		        <?php } else { ?>
		        	<div class="col-md-12">
			        	<div class="panel panel-default">
			            	<div class="panel-body">
			               	Er zijn nog geen Afspraken vandaag
			            	</div>
			          	</div>
			        </div>

		      	<?php } //end if else ?>

      </div>
    </div>
  	<div class="row">
   		<div class="col-md-<?php if ($admin) { ?>10<?php } else { ?>12<?php } ?> blue-text">
      		<h1 class="db-space">Alle Afspraken</h1>
    	</div>
	</div>
    <div class="legenda">
        <div class="row">
            <div class="col-md-11">
                <i class="fa fa-stop red-text" aria-hidden="true"></i> = Is al geweest.
                <i class="fa fa-stop orange-text" aria-hidden="true"></i> = Is Vandaag.
                <i class="fa fa-stop green-text" aria-hidden="true"></i> = Moet nog komen.
            </div>
        </div>
    </div>


  <?php if (empty(!$projects)) { ?>
    <nav class="text-center" aria-label="Page navigation">
      <ul id="pagination" class="pagination">
        <?=$this->pagination->create_links() ?>
      </ul>
    </nav>
    <div class="row cards">
      <div class="col-md-<?php if ($admin) { ?>10<?php } else { ?>12<?php } ?>">
        <div class="table-responsive">
          <table class="table table-striped table-center">
            <thead>
              <tr>
                <th>Projectnaam</th>
                <th>Klant</th>
                <th>Docent</th>
                <th>Leden</th>
                <th>tags</th>
                <th>Datum iteratie</th>
                <th>Datum code review</th>
                <th>Opmerking</th>
              </tr>
            </thead>
            <tbody id="projects">
            <?php foreach($projects as $project) { ?>
              <tr class="<?=compareTime(array($project->iteration_start, $project->code_review_start)) ?>">
                <td><?=$project->name ?> <span data-toggle="tooltip" title="<?=$project->description ?>" class="glyphicon glyphicon-comment"></span></td>
                <td><?=$project->teacher ?></td>
                <td><?=$project->client ?></td>
                <td><?php foreach ($project->members as $member) { echo $member->name." ".$member->insertion." ".$member->lastname." "; } ?></td>
                <td><?php foreach ($project->tags as $tag) { ?><span data-toggle="tooltip" title="<?=$tag->description ?>" class="label label-info"><?=$tag->name ?> </span> <?php } ?></td>
                <td>

                  <?php if ($admin) { ?>
                  <div class="input-group">
                    <span class="edit glyphicon glyphicon-edit">
                      <input data-slug="<?=$project->slug ?>" data-type="iteration" class="hidden form-control dateRange" type="text" name="daterange" 
                      <?php if ($project->iteration_start !== '0000-00-00 00:00:00') { ?>
                        value="<?=$project->iteration_start ?> - <?=$project->iteration_end ?>">
                      <?php } else { ?>
                        value="<?=$today ?> 00:00:00 - <?=$today ?> 00:00:00 ">
                      <?php } ?>
                      <?=displayTime($project->iteration_start) ?>
                    </span>
                  </div>
                  <?php } else { ?>
                    <?=displayTime($project->iteration_start) ?>
                  <?php } ?>
                </td>
                <td>

                  <?php if ($admin) { ?>
                  <div class="input-group">
                    <span class="edit glyphicon glyphicon-edit">
                      <input data-slug="<?=$project->slug ?>" data-type="code_review" class="hidden form-control dateRange" type="text" name="daterange" 
                      <?php if ($project->code_review_start !== '0000-00-00 00:00:00') { ?>
                        value="<?=$project->code_review_start ?> - <?=$project->code_review_end ?>">
                      <?php } else { ?>
                        value="<?=$today ?> 00:00:00 - <?=$today ?> 00:00:00">
                      <?php } ?>
                    <?=displayTime($project->code_review_start) ?>
                    </span>
                  </div>
                  <?php } else { ?>
                    <?=displayTime($project->code_review_start) ?>
                  <?php } ?>
                </td>
                <td><span class="glyphicon glyphicon-comment"></span></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php } else { ?>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
               <p>Er zijn nog geen projecten</p>
            </div>
          </div>
        </div>
    
    <?php }  ?>

   <?php if (!$admin) { ?> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
    		        <a href="/login" class="btn btn-blue">Inloggen</a> 
                </div>
            </div>
        </div>
   
    <?php } ?>
  </section>
</div>
<script src="/custom/scripts/iterations_code_review.js" type="text/javascript"></script>