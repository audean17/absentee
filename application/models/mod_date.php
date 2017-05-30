<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_date extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function tanggalIndo($date) {
        if ($date != "0000-00-00 00:00:00") {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl = substr($date, 8, 2);
            $jam = substr($date, 11, 8);

            $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun . " " . $jam;
        } else {
            $result = "-";
        }
        return($result);
    }
}