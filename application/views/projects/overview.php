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
					<td><?php foreach ($project->members as $member) { echo $member->name." "; } ?></td>
					<td><a href="/projects/Members/<?=$project->slug ?>">leden beheren</a></td>
				</tr>
			  	
			<?php
			    }
			?>

			</tbody>
		</table>
    </section>
</div>


	