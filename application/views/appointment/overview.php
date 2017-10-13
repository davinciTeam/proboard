<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
  <section class="content-header">
    <?=feedback();?>
    <div class="row cards white">
      <div class="col-md-12">projecten</div>
    </div>
    <div class="row cards">
      <div class="col-md-12">
        <table class="table table-striped table-center">
          <thead>
            <tr>
              <th>Projectnaam</th>
              <th>Klant</th>
              <th>docent</th>
              <th>leden</th>
              <th>eerst volgende code revieuw</th>
              <th>eerst volgende iteratie bespreking</th>
              <th>opmerking</th>
            </tr>
          </thead>
          <tbody>

          <?php
            foreach ($projects as $project) { 
          ?>
            <tr class="red">
              <td><?=$project->name ?></td>
              <td><?=$project->client ?></td>
              <td><?=$project->teacher ?></td>
              <td>student 1, student 2</td>
              <td><?=$project->iteration_date ." ". $project->iteration_start ?></td>
              <td><?=$project->code_date ." ". $project->code_start ?></td>
              <td><a href="/appointment/addAppointment/<?=$project->slug ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
            </tr>

            <?php
                }
            ?>

            <!--<tr class="orange">
              <td>componenten beheer</td>
              <td>de jong</td>
              <td>de jong</td>
              <td>student 3, student 4</td>
              <td>maandag 11 uur</td>
              <td>vrijdag 13 uur</td>
              <td>erg lange laadtijd</td>
            </tr>
            <tr class="green">
              <td>speur tocht</td>
              <td>ruijter</td>
              <td>ruijter</td>
              <td>student 5, student 6</td>
              <td>25-10-2017 13 uur</td>
              <td>donderdag 11 uur</td>
              <td>security workshop onvoldoende</td>
            </tr>-->
          </tbody>
        </table>

      </div>
    </div>
  </section>
</div>