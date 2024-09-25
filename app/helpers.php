<?php

if (!function_exists('categoryChange')) {
    function categoryChange($str)
    {
        $str = preg_replace('/[^a-z0-9- ]/', '', strtolower($str));
        return preg_replace('/[^a-z0-9-]/', '-', $str);
    }

    function subCategoryChange($str)
    {
        $str = preg_replace('/[^a-z0-9- ]/', '-', strtolower($str));
        return preg_replace('/[^a-z0-9-]/', '-', $str);
    }
}
