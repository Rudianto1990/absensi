<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitoring_InOut extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('status')<>'login') {
			redirect(site_url('login'));
			{
            redirect(base_url()."dashboard", 'refresh');
        	}
		}
		 $this->load->model('AbsensiModel');
	}

public function index(){

		if($this->input->get("from") != null)
        {
        	$from = date("Y-m-d", strtotime($this->input->get("from")));
        }
        else
        {
        	$from = null;
        }

        if($this->input->get("to") != null)
        {
        	$to = date("Y-m-d", strtotime($this->input->get("to")));
        }
        else
        {
        	$to = null;
        }

        // $data['view'] = $this->AbsensiModel->view();

        $data['monthreport'] = $this->AbsensiModel->report_bulanan($from, $to);
  		
		// $data['absensi'] = $this->AbsensiModel->view();
		// $data['bulanan'] = $this->AbsensiModel->data_bulanan($start_date,$end_date);
		$this->template->load('template','laporan/index', $data);
		// $this->template->load('template','v_bulanan', $data);
			// echo '<pre>';
			// var_dump($data);die();
			// echo '</pre>';
    //     echo '<pre>';
    // print_r($data);exit();
    // echo '</pre>';
		
	}
function export_excel(){

        if($this->input->get("from") != null)
        {
            $from = date("Y-m-d", strtotime($this->input->get("from")));
            $judulfrom = date("d-m-Y", strtotime($this->input->get("from")));
        }
        else
        {
            $from = null;
            $judulfrom = null;
        }

        if($this->input->get("to") != null)
        {
            $to = date("Y-m-d", strtotime($this->input->get("to")));
            $judulto = date("d-m-Y", strtotime($this->input->get("to")));
        }
        else
        {
            $to = null;
            $judulto = null;
        }

        // if($this->input->get("type") != null)
        // {
        //     $type = $this->input->get("type");
        // }
        // else
        // {
        //     $type = null;
        // }    <tr>
                      //  <?php
                        // $rs = $db->query($sql . $filter);
                        // if ($rs && $rs->RecordCount() == 1) {
                        //     $row = $rs->FetchRow();
                        //     if ($row['VERIF'] == 0) {
                        //         echo '
                        //             <td colspan="4">
                        //                 Kapal yang bersangkutan Entri Bukti 2A1 / 2A2 belum Komplit .... <br>
                        //                 Mohon periksa di <u><a style="color:#AA0000" href="wasop/search/?use_date=0&NO_UKK=' . $row['NO_UKK'] . '"> menu pengawasan operasional</a></u>
                        //             </td>           
                        //         ';
                           // } else if ($row['BENTUK_3A'] == "" && $row['VERIF'] == 1) {
                              //  echo '
                                ///    <td colspan="4">
                                    //    Bukti 2A1 / 2A2 sudah komplit. Silahkan cetak DKK.
                                  ///  </td>           
                               // ';
                           // }
                       // } else {
                         //   echo '<td colspan="4">Data tidak ditemukan</td>';
                      ///  }

      $this->load->library("excel");

      $object = new PHPExcel();

      $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'PT. PELABUHAN INDONESIA II - KANTOR CABANG TANJUNG PRIOK');
        $object->getActiveSheet()->mergeCells('A1:I1');

        $object->getActiveSheet()->setCellValue('A2', 'LAPORAN MONITORING IN-OUT AKSES DOOR TEKNIK & SISTEM INFORMASI');
        $object->getActiveSheet()->mergeCells('A2:I2');

        $object->getActiveSheet()->setCellValue('A3', "Periode : $judulfrom s/d $judulto");
        $object->getActiveSheet()->mergeCells('A3:I3');

        // set center
        $style = array(
        'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $object->getDefaultStyle("A1")->applyFromArray($style);
        // end set center untuk judul

      $table_columns = array("NO", "NIPP", "FIRST NAME", "LAST NAME", "TANGGAL TAPPING", "START","END", "IN ROOM", "OUT ROOM");

      $column = 0;

      foreach($table_columns as $field){

        $object->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field); // column, row, data

        $column++;

      }

        // set color and bold for column
        $colFrom = "A4"; 
        $colTo = "I4"; 
        $object->getActiveSheet()->getStyle("$colFrom:$colTo")->getFont()->setBold( true );
        $object->getActiveSheet()->getStyle("$colFrom:$colTo")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('02d9ef');

        // set data
      $result_data = $this->AbsensiModel->report_bulanan($from, $to);
      $excel_row = 5; // data dimulai dari row 5
      $num=1;
      foreach($result_data as $row){

        

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $num);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->personnel_id);

        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->first_name);

        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->last_name);

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, date("d-m-Y", strtotime($row->tgl_absen)));

        $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $judulfrom);

        $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $judulto);

        $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->wk_in);

        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->wk_out);

       

        $excel_row++;
        $num++;
      }

        // set width auto
        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
        $object->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
               // ->setAutoSize(false);
        }

      $judul = "REPORT_MONITORING_AKSES_DOOR_from-".$judulfrom."_to-".$judulto.".xls";

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

      header('Content-Type: application/vnd.ms-excel');

      header('Content-Disposition: attachment;filename="'.$judul.'"');

      // header('Content-Disposition: attachment;filename="Employee Data.xls"');

      $object_writer->save('php://output');

    }


}