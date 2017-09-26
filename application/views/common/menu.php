<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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

          <li class="treeview">
            <a href="#">
              <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/config/users">Config</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <span>Projects</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/projects">Overzicht</a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a href="/projects/add_project">Project toevoegen</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <span>Members</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="/members">Overzicht</a></li>
            </ul>
            <ul class="treeview-menu">
              <li><a href="/projects/addMembers">Members Toevoegen</a></li>
            </ul>
          </li>
          <li>
          <a href="/">
            <span>dashboard</span> 
          </a>

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