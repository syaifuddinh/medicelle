<?php
namespace App\Helpers;

use App\Setting;

class Mod {
    public static function fullDate($time) {
        $d = self::calc('d', $time);
        $m = (int )self::calc('m', $time) - 1;
        $Y = self::calc('Y', $time);
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        return $d . ' ' . $months[$m] . ' ' . $Y;
    }

    public static function day($time) {
        $N = (int) self::calc('N', $time) - 1;
        $readableDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        return $readableDays[$N];
    }

    public static function calc($format, $time) {
        return date($format, strtotime($time));
    }

    public static function company() {
        $company = Setting::whereName('company')->first();
        return $company != null ? $company->content : json_decode('{}');
    }
}