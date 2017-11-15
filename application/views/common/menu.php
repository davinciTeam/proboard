<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if ($admin) { ?>
<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=$this->session->userdata('profile_image');?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=$this->session->userdata('name');?></p>
        <a href="/"><i class="fa fa-circle text-success"></i>Online</a>
      </div>
    </div>

    <ul class="sidebar-menu">
        <li class="header">Navigatie</li>
          <li>
            <a href="/">
              <span>dashboard</span> 
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <span>Gebruikers</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/Users/users">Gebruikers overzicht</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <span>Projecten</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/projects">Overzicht</a></li>
              <li><a href="/projects/addProject">Project toevoegen</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <span>Studenten</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/members">Overzicht</a></li>
              <li><a href="/members/addMember">Studenten Aanmaken</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <span>Tags</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/tags">Overzicht</a></li>
              <li><a href="/tags/addTag">Tag Aanmaken</a></li>
            </ul>
          </li>
    </ul>
  </section>
</aside>

<div class="modal" id="modalBox">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn repairBtn btn-default closeModal cancelBtn pull-left" data-dismiss="modal"></button>
        <button type="button" class="btn repairBtn btn-default closeModal noBtn" data-dismiss="modal"></button>
        <button type="button" class="btn repairBtn btn-success closeModal okBtn" data-dismiss="modal"></button>
        <button type="button" class="btn repairBtn btn-danger yesBtn"></button>
      </div>
    </div>
  </div>
</div>
<?php } ?>