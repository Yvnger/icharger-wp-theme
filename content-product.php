<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

$product = wc_get_product(get_the_ID());
$purpose = explode(', ', $product->get_attribute('purpose'));
$product_url = get_permalink( $product->get_id() );
?>

<li id="post-<?php the_ID(); ?>"
    <?php wc_product_class('products__item product', $product); ?>
    data-product-id="<?php the_ID(); ?>"
    >
    <div class="product__thumbnail-wrap">
        <?php if ($purpose) : ?>
            <div class="product__labels">
                <?php foreach ($purpose as $purpose_item): ?>
                    <?php if (strlen($purpose_item) !== 0) : ?>
                        <span class="product__label"><?= $purpose_item ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (has_post_thumbnail()) : ?>
            <picture>
                <?php the_post_thumbnail('medium', array('class' => 'product__thumbnail')); ?>
            </picture>
        <?php endif; ?>
    </div>

    <div class="product__description">
        <h3 class="product__title"><?php the_title(); ?></h3>
        <p class="product__description"><?= get_the_content(); ?></p>
        <span class="product__price"><?= $product->get_price_html() ?></span>
    </div>
    <a class="product__link" href="<?= $product_url ?>" aria-label="Перейти на страницу товара"></a>
</li>