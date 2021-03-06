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
							<button type="submit" class="btn btn-blue">importeren</button>
						</form>
		    		</div>
		    	</div>
	    	</div>
    	</div>
    	<?php if (!empty($members)) { ?>
		<nav class="text-center" aria-label="Page navigation">
  			<ul id="pagination" class="pagination">
  				
    		</ul>
    	</nav>

    	<div style="display:none" id="spinner"></div>

      	<table class="disabled table table-striped table-center">
  		
			<thead>
				<tr>
					<th id="ovnumber" class="sorting">Ov-Nummer<span class="glyphicon glyphicon-arrow-up"></span></th>
					<th id="name" class="currentSorting sorting">Voornaam<span class="sorting glyphicon glyphicon-arrow-up"></span></th>
					<th id="insertion" class="sorting">Tussenvoegsel<span id="insertion" class="sorting glyphicon glyphicon-arrow-up"></span></th>
					<th id="lastname" class="sorting">Achternaam<span id="lastname" class="sorting glyphicon glyphicon-arrow-up"></span></th>
                    <th>Acties</th>
                    <th>Actief</th>
				</tr>
			</thead>
			<tbody id="members">

			</tbody>
		</table>
		<?php } else { ?>
	        <div class="col-md-12">
	          <div class="panel panel-default">
	            <div class="panel-body">
	               Er zijn nog geen studenten
	            </div>
	          </div>
	        </div>
	    <?php } ?>		
		
    </section>
</div>
<script src="/custom/scripts/members.js"></script>
	