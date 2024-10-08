<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
<header id="header" class="header">
    <nav class="header__nav nav js-nav">
        <?php
        wp_nav_menu([
            'theme_location' => '',
            'menu' => 'primary_menu',
            'container' => '',
            'container_class' => '',
            'container_id' => '',
            'menu_class' => 'nav__list',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth' => 0,
            'walker' => new Main_Nav_Menu(),
        ]);
        ?>

        <div class="header__contacts">
            <a href="tel:89999999999" class="header__phone">+7 922 529 29 20</a>

            <ul class="header__socials socials">
                <li class="socials__item">
                    <a href="https://t.me/AlMaxi" class="socials__link">
                        <svg class="social__icon" role="presentation" width="30px" height="30px" viewBox="0 0 100 100"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm21.977-68.056c.386-4.38-4.24-2.576-4.24-2.576-3.415 1.414-6.937 2.85-10.497 4.302-11.04 4.503-22.444 9.155-32.159 13.734-5.268 1.932-2.184 3.864-2.184 3.864l8.351 2.577c3.855 1.16 5.91-.129 5.91-.129l17.988-12.238c6.424-4.38 4.882-.773 3.34.773l-13.49 12.882c-2.056 1.804-1.028 3.35-.129 4.123 2.55 2.249 8.82 6.364 11.557 8.16.712.467 1.185.778 1.292.858.642.515 4.111 2.834 6.424 2.319 2.313-.516 2.57-3.479 2.57-3.479l3.083-20.226c.462-3.511.993-6.886 1.417-9.582.4-2.546.705-4.485.767-5.362Z"
                                  fill="#000000"></path>
                        </svg>
                    </a>
                </li>

                <li class="socials__item">
                    <a href="https://api.whatsapp.com/send/?phone=79225292920" class="socials__link">
                        <svg class="social__icon" role="presentation" width="30px" height="30px" viewBox="0 0 100 100"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M50 100C77.6142 100 100 77.6142 100 50C100 22.3858 77.6142 0 50 0C22.3858 0 0 22.3858 0 50C0 77.6142 22.3858 100 50 100ZM69.7626 28.9928C64.6172 23.841 57.7739 21.0027 50.4832 21C35.4616 21 23.2346 33.2252 23.2292 48.2522C23.2274 53.0557 24.4823 57.7446 26.8668 61.8769L23 76L37.4477 72.2105C41.4282 74.3822 45.9107 75.5262 50.4714 75.528H50.4823C65.5029 75.528 77.7299 63.301 77.7363 48.2749C77.7408 40.9915 74.9089 34.1446 69.7626 28.9928ZM62.9086 53.9588C62.2274 53.6178 58.8799 51.9708 58.2551 51.7435C57.6313 51.5161 57.1766 51.4024 56.7228 52.0845C56.269 52.7666 54.964 54.2998 54.5666 54.7545C54.1692 55.2092 53.7718 55.2656 53.0915 54.9246C52.9802 54.8688 52.8283 54.803 52.6409 54.7217C51.6819 54.3057 49.7905 53.4855 47.6151 51.5443C45.5907 49.7382 44.2239 47.5084 43.8265 46.8272C43.4291 46.1452 43.7837 45.7769 44.1248 45.4376C44.3292 45.2338 44.564 44.9478 44.7987 44.662C44.9157 44.5194 45.0328 44.3768 45.146 44.2445C45.4345 43.9075 45.56 43.6516 45.7302 43.3049C45.7607 43.2427 45.7926 43.1776 45.8272 43.1087C46.0545 42.654 45.9409 42.2565 45.7708 41.9155C45.6572 41.6877 45.0118 40.1167 44.4265 38.6923C44.1355 37.984 43.8594 37.3119 43.671 36.8592C43.1828 35.687 42.6883 35.69 42.2913 35.6924C42.2386 35.6928 42.1876 35.6931 42.1386 35.6906C41.7421 35.6706 41.2874 35.667 40.8336 35.667C40.3798 35.667 39.6423 35.837 39.0175 36.5191C38.9773 36.5631 38.9323 36.6111 38.8834 36.6633C38.1738 37.4209 36.634 39.0648 36.634 42.2002C36.634 45.544 39.062 48.7748 39.4124 49.2411L39.415 49.2444C39.4371 49.274 39.4767 49.3309 39.5333 49.4121C40.3462 50.5782 44.6615 56.7691 51.0481 59.5271C52.6732 60.2291 53.9409 60.6475 54.9303 60.9612C56.5618 61.4796 58.046 61.4068 59.22 61.2313C60.5286 61.0358 63.2487 59.5844 63.8161 57.9938C64.3836 56.4033 64.3836 55.0392 64.2136 54.7554C64.0764 54.5258 63.7545 54.3701 63.2776 54.1395C63.1633 54.0843 63.0401 54.0247 62.9086 53.9588Z"
                                  fill="#000000"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="header__logo-wrap">
        <a href="<?= get_home_url() ?>" class="header__logo-link">
            <picture>
                <source type="image/webp" srcset="<?= get_template_directory_uri() ?>/assets/images/logo.webp, <?= get_template_directory_uri() ?>/assets/images/logo@2x.webp 2x">
                <img src="<?= get_template_directory_uri() ?>/assets/images/logo.jpg"
                     srcset="<?= get_template_directory_uri() ?>/assets/images/logo@2x.jpg 2x" alt="iCharger"
                     class="header__logo">
            </picture>

        </a>
    </div>

    <div class="header__contacts">
        <?php $phones = get_field('phones', 'option');

        // Phones
        if (!empty($phones)): ?>

            <div class="header__phones">

                <?php
                foreach ($phones as $phone):
                    if ($phone["header"]):
                        ?>

                        <a href="tel:<?= $phone['number_link'] ?>" class="header__phone"><?= $phone['number'] ?></a>

                    <?php
                    endif;
                endforeach;
                ?>

            </div>

        <?php endif; ?>



        <? // Socials ?>
        <?php $socials = get_field('socials', 'option');

        if (!empty($socials)): ?>

            <ul class="header__socials socials">

                <?php
                foreach ($socials as $social):
                    if ($social['header']):
                        ?>

                        <li class="socials__item">
                            <a href="<?= $social['link'] ?>" class="socials__link">
                                <picture>
                                    <img
                                            src="<?= get_template_directory_uri() . '/assets/images/svg/social-' . $social['service'] . '.svg' ?>"
                                            alt="" class="social__icon">
                                </picture>
                            </a>
                        </li>

                    <?php
                    endif;
                endforeach;
                ?>
            </ul>

        <?php endif; ?>
    </div>

    <div class="header__hamburger-wrap">
        <button class="header__hamburger js-nav-toggle">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
