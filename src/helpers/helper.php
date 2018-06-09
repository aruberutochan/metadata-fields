<?php
if (!function_exists('aru_fields_asset')) {
    function aru_fields_asset($path) {
        return asset('vendor/aruberuto/metadata-fields'.'/'.$path);
    }
}
