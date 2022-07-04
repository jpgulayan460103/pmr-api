<?php


/*
 * dd() with headers
 */
if (!function_exists('ddh')) {
    function ddh($var){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dd($var);
    }
}

/*
 * dump() with headers
 */
if (!function_exists('dumph')) {
    function dumph($var){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dump($var);
    }
}

if (!function_exists('ppmpValue')) {
    function ppmpValue(){
        return "PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)";
    }
}

if (!function_exists('supplementalPpmpValue')) {
    function supplementalPpmpValue(){
        return "SUPPLEMENTAL PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)";
    }
}
if (!function_exists('ppmpCse')) {
    function ppmpCse(){
        return "AVAILABLE AT PROCUREMENT SERVICE STORES";
    }
}
if (!function_exists('ppmpNonCse')) {
    function ppmpNonCse(){
        return "OTHER ITEMS NOT AVALABLE AT PS BUT REGULARLY PURCHASED FROM OTHER SOURCES";
    }
}
if (!function_exists('getModelType')) {
    function getModelType($form){
        $model_name_exploded =  explode("\\", $form);
        return Illuminate\Support\Str::snake(last($model_name_exploded));
    }
}