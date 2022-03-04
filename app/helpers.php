<?php

if (!function_exists('collect_ids')) {
    function collect_ids(array $array)
    {
        $return = [];
        foreach ($array as $item) {
            $return[] = $item['id'];
        }
        return $return;
    }
}

if (!function_exists('day_of_week')) {
    function day_of_week(int $number)
    {
        if ($number == 0)
            return 7;
        return $number;
    }
}

if (!function_exists('get_config')) {
    function get_config(string $key)
    {
        $setting = \App\Models\Setting::where('key', $key)->first();
        return $setting ? $setting->value : '';
    }
}
