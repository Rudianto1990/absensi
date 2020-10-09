<section class="content-header">
      <h1>
      LAPORAN MONITORING IN/OUT AKSES DOOR
        <small>SISTEM ABSENSI</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

 <!-- /.box-header -->
<div class="box-body table-responsive">
    <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="form-inline text-center">
                   <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="START" id="from" name="from" value="<?php if($this->input->get("from")){echo $this->input->get("from");}else{echo "";}?>">
                        <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fa fa-calendar"></i></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="time">To</label>
                  </div>
                  <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="END" id="to" name="to" value="<?php if($this->input->get("to")){echo $this->input->get("to");}else{echo "";}?>">  
                        <span class="input-group-addon" style="background-color: #494949;color: #fff;"><i class="fa fa-calendar"></i></span>
                      </div>              
                  </div>

                  <div class="form-group">
                      <button class="btn btn-primary btn-block" id="proses">Proses</button>
                  </div>
              </div>

            </div>
           
          </div>
         
        </div>
        
      </div>

<?php if($this->input->get("from") && $this->input->get("to")):?>
 <div class="row">
        <div class="col-md-12 col-xs-12">
                 <div class="box box-default">
                            <div class="box-body">      
                    <div style="margin-bottom: 20px;">  
                        <button class="btn btn-primary" id="exportExcel"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                    </div>
            <div class="text-center" style="margin-bottom: 20px;">
                  <div style="font-weight: 600;font-size: 20px;">LAPORAN MONITORING IN-OUT AKSES DOOR TEKNIK & SISTEM INFORMASI</div>
                      <div style="font-size: 15px;"></div>
    <div style="font-size: 15px;">Periode : <?php echo $this->input->get("from");?> S/D <?php echo $this->input->get("to");?> </div>
</div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-striped table-hover" width="120%">
          <thead>
          <tr>
            <th>No.</th>
            <th>NIPP</th>
            <th>NAMA PEGAWAI</th>
            <th>TANGGAL TAPPING DOOR</th>
            <th>PERIODE</th>
            <th>IN</th>
            <th>OUT</th>
          
          </tr>
          </thead>
          <tbody>
          <?php
             $no=1;
             foreach($monthreport as $rowColor => $data){ // Lakukan looping pada variabel absensi dari controller
               if ( $rowColor%2 == 0) { // Looping membuat cell colloring
                  $rowColor = 'style="background-color: #aff093;"'; 
               }elseif ( $rowColor%2 == 1) {
                  $rowColor = 'style="background-color: #84cdee;"';
               }
                echo "<tr ".$rowColor++.">";
                echo "<td>".$no++."</td>";
                echo "<td>".$data->personnel_id."</td>";
                echo "<td>".$data->first_name.' '.$data->last_name."</td>";
                echo "<td>".$data->tgl_absen."</td>";
                echo "<td>".$this->input->get("from").' s/d '.$this->input->get("to")."</td>";
                echo "<td>".$data->wk_in."</td>";
                echo "<td>".$data->wk_out."</td>";
                //echo "<td><a class='.$this->uri->segment(1)=='user'><a href='.site_url('user') data-toggle='tooltip' title='Edit User' class='btn btn-effect-ripple btn-md btn-success'><i class='fa fa-pencil'></i></a></td>";
                echo "</tr>";
                
              }
               
            ?>


          </tbody>
        </table>
         
      </div>
    </div>
  </div>
</div>
<?php endif;?>
 </section>

    <style type="text/css">
      
/*     .table-striped th {
  height: 45px;
  background-color: #bfff00 !important;
  color: #191919;
}

.table-striped td {
  padding: 8px;
  border: 2px solid #F6F6F6;
  font-weight: bold;
}

.table-striped>tr:nth-child(n+1)>td {
  background-color: #bababa;
}

.table-striped>tr:nth-child(n+2)>td {
  background-color: #e8e7e6;
}*/
    </style>




<script type="text/javascript">

    var dns = "<?php echo base_url();?>";
   
    $(document).ready(function() {

        // date picker
        $('#from, #to').datepicker({
            todayBtn: "linked",
            format: 'dd-mm-yyyy',
            // default: true,
            autoclose: true
        });

    });

   $( "#proses" ).click(function() {
        var from = $("#from").val();
        var to = $("#to").val();
       
        location.href= dns+ "monitoring_inout/index?from="+from+"&to="+to;
    });

   $("#exportExcel").on("click",function(){
        var from = $("#from").val();
        var to = $("#to").val();
       
        location.href= dns+ "monitoring_inout/export_excel?from="+from+"&to="+to;
  });

    $("#cetakPDF").on("click",function(){
        var from = $("#from").val();
        var to = $("#to").val();
        
        window.open(dns+ "monitoring_inout/cetak_pdf?from="+from+"&to="+to);
    });

</script>

     