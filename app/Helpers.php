<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

function setting($key)
{
    $setting = Cache::rememberForever('setting', function () {
        return Setting::first();
    });
    if ($setting) {
        return $setting->$key;
    }
}
