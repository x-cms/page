<?php

if (!function_exists('get_templates')) {
    function get_templates($type = null)
    {
        if ($type === null) {
            return config('template');
        }
        $templates = config('template.' . $type, []);
        return $templates ?: [];
    }
}