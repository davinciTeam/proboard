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
  <div class="row">
    <div class="legenda">
        <div class="row">
            <div class="col-md-11">
                <i class="fa fa-stop red-text" aria-hidden="true"></i> = Is al geweest.
                <i class="fa fa-stop orange-text" aria-hidden="true"></i> = Is Vandaag.
                <i class="fa fa-stop green-text" aria-hidden="true"></i> = Moet nog komen.
            </div>
        </div>
    </div>
  </div>


  <?php if (empty(!$projects)) { ?>
    <nav class="text-center" aria-label="Page navigation">
      <ul id="pagination" class="pagination">
        
      </ul>
    </nav>

    <div style="display:none" id="spinner"></div>

    <div class="row cards">
      <div class="col-md-<?php if ($admin) { ?>10<?php } else { ?>12<?php } ?>">
        <div class="table-responsive">
          <table class="table table-striped table-center">
            <thead>
              <tr>
                <th>Projectnaam</th>
                <th>Klant</th>
                <th>Docent</th>
                <th>links</th>
                <th>Leden</th>
                <th>tags</th>
                <th>Datum iteratie</th>
                <th>Datum code review</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody id="projects">
            
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