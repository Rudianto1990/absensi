<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Times {
    
    function selisih($time1,$time2){
        $awal  = date_create($time1); //waktu awal
        $akhir = date_create($time2); //waktu akhir
        $diff  = date_diff($awal,$akhir);
        return $diff->format('%H:%I:%S');
    }

    function timeToSec($jam) {
        //konvert jam ke detik
        $jamkonvert = explode(":", $jam);
        $detik = $jamkonvert[0]*3600 + $jamkonvert[1] * 60 + $jamkonvert[2];
        return $detik;
    }

    function secToTime($detik) {
       //konvert detik ke jam menit detik
        $jam = floor($detik/3600);
        //Untuk menghitung jumlah dalam satuan menit:
        $sisa = $detik% 3600;
        $menit = floor($sisa/60);
        //Untuk menghitung jumlah dalam satuan detik:
        $sisa = $sisa % 60;
        $detik = floor($sisa/1);
        return $jam.':'.$menit.':'.$detik;
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}