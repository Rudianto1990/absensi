<!DOCTYPE html>
<html>
<!-- TAG HEAD -->
<?php $this->load->view('template_item/head_css') ?> 

  <body class="hold-transition skin-purple sidebar-mini" style="background: #222d32;">
<div class="wrapper">

<!-- Header Menu -->
<?php $this->load->view('template_item/header_menu') ?> 
  
  <!-- Left side bar -->
<?php $this->load->view('template_item/sidebar_menu') ?> 


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php echo $contents; ?>
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.2.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#"_blank">DIVISI SISTEM INFORMASI CABANG TANJUNG PRIOK</a>.</strong> All rights
    reserved.
  </footer>

<!-- ./wrapper -->

<?php $this->load->view('template_item/foot_javascript') ?> 
</body>
</html>
