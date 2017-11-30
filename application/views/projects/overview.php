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


    	<div id="spinner"></div>

    	<?php if (!empty($projects)) { ?>
    	<nav class="text-center" aria-label="Page navigation">
  			<ul id="pagination" class="pagination">

    		</ul>
    	</nav>
      	<table class="table table-striped table-center">
			<thead>
				<tr>
					<th>Projectnaam</th>
					<th>Klant</th>
					<th>Docent</th>
					<th>Links</th>
					<th>Leden</th>
					<th>tags</th>
                    <th>Acties</th>
					<th>Actief</th>
				</tr>
			</thead>
			<tbody id="projects">

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
<script src="/custom/scripts/projects.js"></script>