<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
  <div class="col-md-12">
    <?=RenderBreadCrum()?>
  </div>
  <section class="content-header">
    <div class="col-md-12">
        <?=feedback();?>
      </div>
    
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
            <tr class="red">
              <td>project beheer</td>
              <td>slemmer</td>
              <td>slemmer</td>
              <td>student 1, student 2</td>
              <td>woensdag 11 uur</td>
              <td>10-10-2017 13 uur</td>
              <td></td>
            </tr>
            <tr class="orange">
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
            </tr>
          </tbody>
        </table>

      </div>
    </div>
    <?php if (!$admin) { ?> <a href="/login" class="btn btn-blue">Inloggen</a> <?php } ?>
  </section>
</div>