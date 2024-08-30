<?php include("header.php"); ?>

<? // Hero ?>
<?php
$hero_active = get_field("active_hero");
$hero = get_field("hero");
$hero_title = $hero['title'];
$hero_description = $hero['description'];

if ($hero_active): ?>
    <section class="hero">
        <div class="container">
            <div class="hero__content">
                <?php if (!empty($hero_title)): ?>
                    <h1 class="hero__title">
                        <?= $hero_title ?>
                    </h1>
                <?php endif; ?>

                <?php if (!empty($hero_description)): ?>
                    <p class="hero__description">
                        <?= $hero_description ?>
                    </p>
                <?php endif; ?>

                <div class="hero__actions">
                    <a href="javascript:void(0)" class="btn btn--fill hero__actions-first js-modal-trigger"
                       data-modal="pricelist">
                        Получить прайс-лист
                        <span class="btn__flash"></span>
                    </a>
                    <a href="javascript:void(0)" class="btn btn--outline hero__actions-second js-modal-trigger"
                       data-modal="needhelp">
                        Бесплатная консультация
                        <span class="btn__flash"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<? // Target ?>
<?php
$target_active = get_field('active_target');
$target = get_field('target');
$target_section_title = $target['section_title'];
$target_items = $target['items'];

if ($target_active): ?>
    <section id="target" class="target section">
        <div class="container">
            <?php if (!empty($target_section_title)): ?>
                <h2 class="section__title target__title"><?= $target_section_title ?></h2>
            <?php endif; ?>

            <div class="target__wrap">
                <?php if (!empty($target_items)): ?>
                    <ul class="target__list">
                        <?php foreach ($target_items as $item): ?>
                            <li class="target__item">

                                <img class="target__item-icon"
                                     src="<?= get_template_directory_uri() ?>/assets/images/svg/icon-<?= $item['icon']['value'] ?>.svg"
                                     alt="<?= $item['title'] ?>">

                                <?php if ($item['title']): ?>
                                    <h3 class="target__item-title"><?= $item['title'] ?></h3>
                                <?php endif; ?>

                                <?php if ($item['description']): ?>
                                    <p class="target__item-description">
                                        <?= $item['description'] ?>
                                    </p>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<? // Products ?>
<?php
$products_active = get_field('active_products');
$products = get_field('products');
$products_section_title = $products['section_title'];

if ($products_active): ?>
    <section id="products" class="products section">
        <div class="container">
            <?php if (!empty($products_section_title)): ?>
                <h2 class="section__title products__title"><?= $products_section_title ?></h2>
            <?php endif; ?>

            <?php
            // Создаем новый запрос
            $args = array(
                'post_type' => 'product', // Тип записей "Товары"
                'posts_per_page' => 3,   // Выводить все записи
                'orderby' => 'id',        // Сортировка по заголовку
                'order' => 'ASC',         // Порядок сортировки (ASC или DESC)
            );

            $query = new WP_Query($args);
            ?>

            <?php if ($query->have_posts()): ?>
                <ul id="products-list" class="products__list">

                    <?php while ($query->have_posts()): ?>
                        <?php
                        $query->the_post();
                        $terms = get_the_terms(get_the_ID(), 'product_label');
                        $price = number_format(get_field('price', $post->ID), 0, ',', ' ');
                        $price_from = get_field('price_from', $post->ID);
                        ?>

                        <article
                                id="post-<?php the_ID(); ?>" <?php post_class('products__item product js-product-card'); ?>
                                data-product-id="<?php the_ID(); ?>" data-modal="product">
                            <div class="product__thumbnail-wrap">
                                <?php if ($terms && !is_wp_error($terms)): ?>
                                    <div class="product__labels">
                                        <?php foreach ($terms as $term): ?>
                                            <span class="product__label"><?= $term->name ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('medium');
                                } ?>
                            </div>
                            <h3 class="product__title"><?php the_title(); ?></h3>
                            <p class="product__description"><?= get_the_content(); ?></p>

                            <span class="product__price">
                                <?= ($price_from) ? "от $price р." : "$price р." ?>
                            </span>
                        </article>

                    <?php endwhile; ?>

                </ul>

                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                echo 'Нет товаров.';
            <?php endif; ?>

            <div class="products__action-wrap">
                <a href="/shop/" class="btn btn--fill products__action">
                    Смотреть весь каталог
                    <span class="btn__flash"></span>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<? // Feedback 1 ?>
<?php
$feedback_1_active = get_field('active_feedback_1');
$feedback_1 = get_field('feedback_1');
$feedback_1_section_title = $feedback_1['section_title'];
$feedback_1_section_description = $feedback_1['section_description'];

if ($feedback_1_active): ?>
    <section id="help" class="help section">
        <div class="container">
            <div class="help__content">
                <?php if (!empty($feedback_1_section_title)): ?>
                    <h2 class="section__title help__title"><?= $feedback_1_section_title ?></h2>
                <?php endif; ?>

                <?php if (!empty($feedback_1_section_description)): ?>
                    <p class="section__description help__description">
                        <?= $feedback_1_section_description ?>
                    </p>
                <?php endif; ?>

                <div class="form help__form">
                    <?= do_shortcode('[contact-form-7 id="2ae05bd" title="Помощь в подборе зарядной станции"]') ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<? // How we works ?>
<?php
$hww_active = get_field('active_hww');
$hww = get_field('hww');
$hww_section_title = $hww['section_title'];
$hww_items = $hww['items'];

if ($hww_active): ?>
    <section id="hww" class="hww section">
        <div class="container">
            <?php if ($hww_section_title): ?>
                <h2 class="section__title hww__title"><?= $hww_section_title ?></h2>
            <?php endif; ?>

            <?php if (!empty($hww_items)): ?>
                <ul class="hww__list">
                    <?php foreach ($hww_items as $item): ?>
                        <li class="hww__item">
                            <img class="hww__item-icon"
                                 src="<?= get_template_directory_uri() ?>/assets/images/svg/icon-<?= $item['icon']['value'] ?>.svg"
                                 alt="">

                            <?php if ($item['title']): ?>
                                <h3 class="hww__item-title"><?= $item['title'] ?></h3>
                            <?php endif; ?>

                            <?php if ($item['description']): ?>
                                <p class="hww__item-description"><?= $item['description'] ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<? // Brands ?>
<?php
$brands_active = get_field('active_brands');
$brands = get_field('brands');
$brands_section_title = $brands['section_title'];
$brands_items = $brands['items'];

if ($brands_active): ?>
    <section id="brands" class="brands section">
        <div class="container">
            <?php if ($brands_section_title): ?>
                <h2 class="section__title brands__title"><?= $brands_section_title ?></h2>
            <?php endif; ?>

            <?php if (!empty($brands_items)): ?>
                <ul class="brands__list">
                    <?php foreach ($brands_items as $item): ?>
                        <li class="brands__item">
                            <picture>
                                <img class="brands__item-logo" src="<?= $item['logo']['url'] ?>"
                                     alt="<?= $item['title'] ?>">
                            </picture>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<? // About ?>
<?php
$about_active = get_field('active_about');
$about = get_field('about');
$about_section_title = $about['section_title'];
$about_text = $about['text'];

if ($about_active): ?>
    <section id="about" class="about section">
        <div class="container">
            <div class="about__content">
                <?php if (!empty($about_section_title)): ?>
                    <h2 class="section__title about__title"><?= $about_section_title ?></h2>
                <?php endif; ?>

                <?php if ($about_text): ?>
                    <span class="about__hr"></span>

                    <div class="about__text"><?= $about_text ?></div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php include('footer.php'); ?>
