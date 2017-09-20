<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content">
      	<table class="table table-striped table-center">
			<thead>
				<tr>
					<th>Projectnaam</th>
					<th>Klant</th>
					<th>docent</th>
					<th>leden</th>
				</tr>
			</thead>
			<tbody>


<?php
    foreach ($test as $project_item){ 
?>
    <tr>
	<td><?php echo $project_item['name'];?></td>
	<td><?php echo $project_item['klant'];?></td>
	<td><?php echo $project_item['docent'];?></td>
	<td>student 1 , student 2</td>
	</tr>
  	
    <?php
       }
    ?>

			</tbody>
		</table>
    </section>
</div>


	