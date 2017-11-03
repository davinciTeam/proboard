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
		<nav class="text-center" aria-label="Page navigation">
  			<ul id="pagination" class="pagination">
    			<?=$this->pagination->create_links() ?>
    		</ul>
    	</nav>
      	<table class="disabled table table-striped table-center">
  		
			<thead>
				<tr>
					<th id="Tagname" class="sorting">Tag naam<span class="glyphicon glyphicon-arrow-up"></span></th>
					<th id="Description" class="currentSorting sorting">Bescrhijving<span class="sorting glyphicon glyphicon-arrow-up"></span></th>
                    <th>Acties</th>
                    <th>Actief</th>
				</tr>
			</thead>
			<tbody id="tags">

			<?php
			    foreach ($tags as $tag) { 
			?>
			    <tr>
					<td><?=$tag->name;?></td>
					<td><?=$tag->description;?></td>
					<td><a href="/tags/editTag/<?=$tag->slug; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td>
					<?php if ($tag->active == 1) { ?>
						<i class='fa fa-circle green-text' aria-hidden='true'></i>
					<?php } else { ?>
						<i class='fa fa-circle red-text' aria-hidden='true'></i>
					<?php } ?>
					</td>	
				</tr>
			  	
			<?php
			    }
			?>
			</tbody>
		</table>
		
    </section>
</div>
<!-- <script src="/custom/scripts/members.js"></script> -->
	