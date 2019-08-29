<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
  .user-panel>.info {
    padding: 5px 5px 5px 15px;
    line-height: 1;
    position: absolute;
     left: 0px !important; 
}


</style>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel" style="height:65px !important">
    <div class="pull-left info">
      <p><?php echo $session_data['first_name'] . ' ' . $session_data['last_name']; ?></p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>


  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <!-- Optionally, you can add icons to the links -->
    <?php 
      foreach($template_data['nav_menu'] as $nav)
      {
        if(empty($nav['nav_child']))
        {
          if($this->ion_auth->is_admin()) {
            if($nav['nav_menu_module'] == 'departures' || $nav['nav_menu_module'] == 'arrivals' || $nav['nav_menu_module'] == 'delay_check' || $nav['nav_menu_module'] == 'dashboard'  || $nav['nav_menu_module'] == 'data' || $nav['nav_menu_module'] == 'laporan_terbanyak' ) {
              echo '<li class="'.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>' .PHP_EOL;
            } 
          } else if($this->ion_auth->in_group('5')){
            if($nav['nav_menu_module'] == 'dashboard' || $nav['nav_menu_module'] == 'delay_check') {
              echo '<li class="'.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>' .PHP_EOL;
            }
          } else if($this->ion_auth->in_group('4')){
            if($nav['nav_menu_module'] == 'dashboard' || $nav['nav_menu_module'] == 'laporan'|| $nav['nav_menu_module'] == 'data'  || $nav['nav_menu_module'] == 'laporan_terbanyak' ) {
              echo '<li class="'.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>' .PHP_EOL;
            }
          } else if($this->ion_auth->in_group('3')){
            if($nav['nav_menu_module'] == 'dashboard' || $nav['nav_menu_module'] == 'arrivals' || $nav['nav_menu_module'] == 'delay_check' || $nav['nav_menu_module'] == 'data' ) {
              echo '<li class="'.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>' .PHP_EOL;
            }
          } else if($this->ion_auth->in_group('2')){
            if($nav['nav_menu_module'] == 'dashboard' || $nav['nav_menu_module'] == 'departures'  || $nav['nav_menu_module'] == 'arrivals' || $nav['nav_menu_module'] == 'delay_check'  || $nav['nav_menu_module'] == 'data' ) {
              echo '<li class="'.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span></a></li>' .PHP_EOL;
            }
          }    

        }
        else
        {
          if($this->ion_auth->is_admin()) {
            echo '<li class="treeview '.$nav['active_link'].'"><a href="'.(($nav['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nav['nav_menu_link'])).'"><i class="'.$nav['nav_menu_icon'].'"></i> <span>'.$nav['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>' .PHP_EOL;
            echo '<ul class="treeview-menu">'.PHP_EOL;
            foreach($nav['nav_child'] as $nc1)
            {
              if(empty($nc1['nav_child']))
              {
                echo '<li class="'.$nc1['active_link'].'"><a href="'.(($nc1['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc1['nav_menu_link'])).'"><i class="'.$nc1['nav_menu_icon'].'"></i> <span>'.$nc1['nav_menu_name'].'</span></a></li>'.PHP_EOL;
              }
              else
              {
                echo '<li class="treeview '.$nc1['active_link'].'"><a href="'.(($nc1['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc1['nav_menu_link'])).'"><i class="'.$nc1['nav_menu_icon'].'"></i> <span>'.$nc1['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>'.PHP_EOL;
                echo '<ul class="treeview-menu">'.PHP_EOL;
                foreach($nc1['nav_child'] as $nc2)
                {
                  if(empty($nc2['nav_child']))
                  {
                    echo '<li class="'.$nc2['active_link'].'"><a href="'.(($nc2['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc2['nav_menu_link'])).'"><i class="'.$nc2['nav_menu_icon'].'"></i> <span>'.$nc2['nav_menu_name'].'</span></a></li>'.PHP_EOL;
                  }
                  else
                  {
                    echo '<li class="treeview '.$nc2['active_link'].'"><a href="'.(($nc2['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc2['nav_menu_link'])).'"><i class="'.$nc2['nav_menu_icon'].'"></i> <span>'.$nc2['nav_menu_name'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>'.PHP_EOL;
                    echo '<ul class="treeview-menu">'.PHP_EOL;
                    foreach($nc2['nav_child'] as $nc3)
                    {
                      echo '<li class="'.$nc3['active_link'].'"><a href="'.(($nc3['nav_menu_link'] == '#') ? '#' : site_url('admin/'.$nc3['nav_menu_link'])).'"><i class="'.$nc3['nav_menu_icon'].'"></i> <span>'.$nc3['nav_menu_name'].'</span></a></li>'.PHP_EOL;
                    }
                    echo '</ul>';
                    echo '</li>';                            
                  }
                }   
                echo '</ul>';
                echo '</li>';             
              }       
            } 



          }
          echo '</ul>';
          echo '</li>';
        }
      } 
    ?>
    
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>