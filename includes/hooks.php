<?php
add_action('page_heading', 'page_heading_wrap_before', 1);
add_action('page_heading', 'page_heading_title', 10);
add_action('page_heading', 'page_heading_breadcrumbs', 20);
add_action('page_heading', 'page_heading_wrap_after', 99);


function page_heading_wrap_before()
{
    echo '<div class="page__heading">';
    echo '<div class="container">';
}

function page_heading_title()
{
    if (!is_product()) {
        echo '<h1 class="page__title">';

        if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title();
        } elseif (is_author()) {
            the_author();
        } elseif (is_page()) {
            the_title();
        } elseif (is_date()) {
            echo get_the_date('F Y');
        } elseif (is_404()) {
            echo 'Ошибка 404 - Страница не найдена';
        } else {
            echo get_the_archive_title();
        }

        echo '</h1>';
    }
}

function page_heading_breadcrumbs()
{
    if (function_exists('icharge_breadcrumbs')) icharge_breadcrumbs();
}

function page_heading_wrap_after()
{
    echo '</div>';
    echo '</div>';
}

/**
 * WooCommerce hooks
 */

// Remove breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
