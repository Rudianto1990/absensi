<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li class="<?php echo ($this->uri->segment(1)=='dashboard')? 'active': ''; ?>"><a href="<?php echo site_url('dashboard')?>"><i class="fa fa-home"></i><span> Dashboard</span></a></li>
        <li class="<?php echo ($this->uri->segment(1)=='absensi')? 'active': ''; ?>"><a href="<?php echo site_url('absensi')?>"><i class="fa fa-calendar"></i><span> Absensi</span></a></li>
        <li class="<?php echo ($this->uri->segment(1)=='monitoring_inout')? 'active': ''; ?>"><a href="<?php echo site_url('monitoring_inout')?>"><i class="fa fa-book"></i><span> Monitoring In Out</span></a></li>
        <li class="<?php echo ($this->uri->segment(1)=='user')? 'active': ''; ?>"><a href="<?php echo site_url('user')?>"><i class="fa fa-user"></i><span> User</span></a></li>
    </section>
    <!-- /.sidebar -->
  </aside>

  