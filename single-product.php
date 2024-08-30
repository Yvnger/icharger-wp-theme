<?php
global $product;
if ( ! is_a( $product, 'WC_Product' ) ) {
    $product_id = get_the_ID();
    $product = wc_get_product( $product_id );
}

// Теперь вы можете использовать объект продукта
if ( $product ) {
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
	$image_id = $product->get_image_id();
    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
	$description = $product->get_short_description();
}

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop'); ?>

<main class="main page">
	<?php do_action('page_heading'); ?>

	<div class="page__single">
		<div class="container">

			<div class="product-detail">
				<div class="product-detail__thumbnail-wrap">
					<picture>
						<img src="<?= $image_url ?>" alt="" class="product-detail__thumbnail js-product-detail-thumb">
					</picture>
				</div>

				<div class="product-detail__info">
					<h1 class="product-detail__title js-product-detail-title"><?= the_title() ?></h1>
					<span class="product-detail__price js-product-detail-price"><?= wc_price($regular_price) ?></span>
					<div class="product-detail__actions">
						<button class="btn btn--fill js-modal-trigger" data-modal="order">Заказать</button>
					</div>
					<div class="product-detail__description js-product-detail-description"><?= wp_kses_post($description) ?></div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
