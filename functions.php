<?php
require_once __DIR__ . '/models/CategoryModel.php';

/**
 * Loads all categories into the current session.
 *
 * Assumes CategoryModel has a method get_all() that returns an array of categories.
 */
function load_category_to_session()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $category = new CategoryModel();

    // Fetch all categories
    $categories = $category->convert_array();

    // Optional: validate the return type
    if (is_array($categories)) {
        $_SESSION["categories"] = $categories;
    } else {
        // Handle error or fallback
        $_SESSION["categories"] = [];
        error_log("Failed to load categories: Expected array, got " . gettype($categories));
    }
}

function load_view($views)
{
    $view = get_view_path();
    if (array_key_exists($view, $views)) {
        require_once __DIR__ . $views[$view];
    } else {
        require_once __DIR__ . '/views/errors/404.php';
    }
}

function get_view_path()
{
    // get the uri path 
    $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return $request_uri;
}

function get_extra_params()
{

}

function translate_route_names($route)
{
    $eng_burmese = [
        "" => "အဖွင့်စာမျက်နှာ",
        "about" => "ဦးစီးဌာနအကြောင်း",
        "activities" => "လုပ်ငန်းဆောင်ရွက်ချက်များ",
        "policies_laws" => "မူဝါဒနှင့်ဥပဒေများ",
        "media" => "သတင်းနှင့်မီဒီယာ",
        "daily_activities" => "နေ့စဥ်လှုပ်ရှားဆောင်ရွက်မှုများ",
        "education" => "အသိပညာပေးကဏ္ဍ",
        "related" => "ဆက်စပ်လုပ်ငန်းများ",
        "contact" => "ဆက်သွယ်ရန်",
        "eia" => "EIA Portal-Site"
    ];

    return $eng_burmese[$route] ?? $route; // fallback if not found
}



