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
<<<<<<< HEAD
    <?php if (empty(!$projects)) { ?>
  
    <?php if ($admin) { ?>
      <div class="col-md-12 row cards white">projecten</div>
      <div class="col-md-12"> <div class="input-group input-group-lg"><input name="search" type="text" class="form-control" aria-describedby="search_icon"><span class="input-group-addon" id="search_icon"><i class="fa fa-search" aria-hidden="true"></span></div></i></div>
    <?php } ?>

=======
    <div class="container">
      	<div class="row">
	   		<div class="col-md-11 blue-text">
	      		<h1>Afspraken van Vandaag</h1>
	    	</div>
	    </div>
	</div>
    <div class="container">
      <div class="row">
        <div class="col-md-11">
					<?php if (empty(!$project_items)){?>
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
		         <?php  }else{ ?>
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
    <?php if (empty(!$projects)) { ?>
    <div class="row cards">
      <div class="col-md-11">
        <table class="table table-striped table-center">
          <thead>
            <tr>
              <th>Projectnaam</th>
              <th>Klant</th>
              <th>Docent</th>
              <th>Leden</th>
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
              <td><?php foreach ($project->members as $member) { 
            echo $member->name." ".$member->insertion." ".$member->lastname." "; } ?></td>
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
    <?php } else { ?>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-body">
               Er zijn nog geen projecten
            </div>
          </div>
        </div>
    <?php } ?>
    <?php if (!$admin) { ?> <a href="/login" class="btn btn-blue">Inloggen</a> <?php } ?>
  </section>
</div>
<script src="/custom/scripts/iterations_code_review.js"></script>