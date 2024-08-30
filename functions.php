<?php
// Theme support options
add_theme_support('title-tag');
add_theme_support( 'menus' );

// Styles
add_action('wp_enqueue_scripts', 'icharge_enqueue_styles');
function icharge_enqueue_styles()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/style.min.css');
}

// Scripts
add_action('wp_enqueue_scripts', 'icharge_enqueue_scripts');
function icharge_enqueue_scripts()
{
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/bundle.min.js', '', '', true);
    wp_localize_script('script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('after_setup_theme', 'theme_setup');
function theme_setup()
{
    // Регистрация областей меню
    register_nav_menus(array(
        'primary_menu' => 'Главное меню',
    ));
}

add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

include_once 'includes/walker.php';

function dd($var)
{
    echo '<pre style="font-size:12px;">';
    var_dump($var);
    echo '</pre>';
//    die();
}

// AJAX обработчик для получения данных записи по ID
add_action('wp_ajax_get_post_data', 'get_post_data_callback');
add_action('wp_ajax_nopriv_get_post_data', 'get_post_data_callback');

function get_post_data_callback()
{
// Проверяем nonce для безопасности (необязательно)
    // check_ajax_referer('my_nonce_action', 'nonce');

    // Получаем ID продукта из параметров запроса
    $product_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    // Получаем объект продукта по ID
    $product = wc_get_product($product_id);

    if ($product) {
        $product_id = $product->get_id();
        $product_thumb = get_the_post_thumbnail_url($product_id, 'medium');
        $product_title = $product->get_name();
        $product_details = $product->get_short_description();
        $product_price = $product->get_price_html();

        $response = array(
            'success' => true,
            'id' => $product_id,
            'thumb' => $product_thumb,
            'title' => $product_title,
            'details' => $product_details,
            'price' => $product_price,
        );

        wp_send_json_success($response);
    } else {
        wp_send_json_error('Продукт не найден');
    }

    wp_die();
}

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('~^[^:]+: ~', '', $title);
});

require 'includes/breadcrumbs.php';
require 'includes/hooks.php';