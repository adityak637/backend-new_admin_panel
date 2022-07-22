<?php

namespace App\Utils;

use App\Models\Remarks;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkStatusLog;
use Hashids\Hashids;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Helpers {

    function dateFormat($date, $format = null, $time = null) {
        if ($date) {
            $date = \Carbon\Carbon::parse($date);
            if ($format) return $date->format($format);
            else $format = 'Y-m-d';

            if ($time === true) $format .= ' h:i:s A';
            else $format .= $time;
            return $date->format($format);
        }
    }

    function authUser() {
        if (Auth::check()) {
            return Auth::user();
        }
        return new User();
    }

}
