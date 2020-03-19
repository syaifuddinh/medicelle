<?php
namespace App\Helpers;

use App\Setting;
use Carbon\Carbon;

class Mod {
    public static function fullDate($time) {
        if($time == null) {
            return null;
        }
        $d = self::calc('d', $time);
        $m = (int )self::calc('m', $time) - 1;
        $Y = self::calc('Y', $time);
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        return $d . ' ' . $months[$m] . ' ' . $Y;
    }

    public static function calc($format, $time) {
        return date($format, strtotime($time));
    }
    
    public static function now() {
        $now = Carbon::now()->format('Y-m-d');

        return self::fullDate($now) . ' ' . Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i');
    }

    public static function today() {
        $now = Carbon::now()->format('Y-m-d');

        return self::fullDate($now);
    }

    public static function day($time) {
        $N = (int) self::calc('N', $time) - 1;
        $readableDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        return $readableDays[$N];
    }


    public static function company() {
        $company = Setting::whereName('company')->first();
        return $company != null ? $company->content : json_decode('{}');
    }

    public static function laboratory() {
        $laboratory = Setting::whereName('laboratory')->first();
        return $laboratory != null ? $laboratory->content : json_decode('{}');
    }

    public static function finance() {
        $finance = Setting::whereName('finance')->first();
        return $finance != null ? $finance->content : json_decode('{}');
    }

    public static function readMoney($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = self::readMoney($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = self::readMoney($nilai/10)." puluh". self::readMoney($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . self::readMoney($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::readMoney($nilai/100) . " ratus" . self::readMoney($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . self::readMoney($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::readMoney($nilai/1000) . " ribu" . self::readMoney($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::readMoney($nilai/1000000) . " juta" . self::readMoney($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::readMoney($nilai/1000000000) . " milyar" . self::readMoney(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::readMoney($nilai/1000000000000) . " trilyun" . self::readMoney(fmod($nilai,1000000000000));
        }
        return $temp;
    }
}