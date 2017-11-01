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
              <th>eerst volgende code review</th>
              <th>eerst volgende iteratie bespreking</th>
              <th>opmerking</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($projects as $project) { ?>
            <tr class="<?=compareTime(array($project->iteration_start, $project->code_review_start)) ?>">
              <td><?=$project->name ?></td>
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
              <td></td>
            </tr>
        <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
    <?php if (!$admin) { ?> <a href="/login" class="btn btn-blue">Inloggen</a> <?php } ?>
  </section>
</div>
<script src="/custom/scripts/iterations_code_review.js"></script>