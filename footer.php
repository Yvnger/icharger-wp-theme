<? // Contacts ?>
<?php
$phones = get_field('phones', 'option');
$socials = get_field('socials', 'option');
$emails = get_field('emails', 'option');
$legal = get_field('legal', 'option');
?>
<section id="contacts" class="contacts section">
    <div class="container">
        <div class="contacts__content">
            <?php if (!empty($socials)): ?>
                <div class="contacts__socials">
                    <ul class="socials">
                        <?php foreach ($socials as $item): ?>
                            <li class="socials__item">
                                <a href="<?= $item['link'] ?>" target="_blank" class="socials__link">
                                    <picture>
                                        <img class="socials__icon"
                                             src="<?= get_template_directory_uri() . "/assets/images/svg/social-" . $item["service"] . ".svg" ?>"
                                             alt="">
                                    </picture>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (!empty($phones)): ?>
                <ul class="contacts__list">
                    <?php foreach ($phones as $phone): ?>
                        <li class="contacts__item">
                            <?= $phone['title'] ?>:
                            <a href="<?= $phone['number_link'] ?>" class="contacts__link"><?= $phone['number'] ?></a>
                        </li>
                    <?php endforeach; ?>

                    <?php foreach ($emails as $email): ?>
                        <li class="contacts__item">
                            <?= $email['title'] ?>:
                            <a href="<?= $email['title'] ?>" class="contacts__link"><?= $email['email'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($legal)): ?>
                <div class="contacts__legal">
                    <p>Реквизиты: <?= $legal['company_name'] ?></p>
                    <p>ИНН: <?= $legal['inn'] ?></p>
                    <p>ОГРНИП: <?= $legal['ogrnip'] ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<footer id="footer" class="footer">
    <div class="container">
        <p class="footer__copyright">2024 &copy; icharger. Все права защищены.</p>
    </div>
</footer>

<div id="modals">
    <? // Получить прайс-лист ?>
    <div id="pricelist" class="modal">
        <button class="modal__close" aria-label="Закрыть окно"></button>

        <div class="modal__body">
            <div class="modal__feedback-wrap">
                <div class="modal__heading">
                    <h2 class="modal__title">Для получения прайс-листа оставьте, пожалуйста, свои контактные данные</h2>
                    <p class="modal__description">После заполнения мы отправим ссылку на документ</p>
                </div>

                <div class="modal__form-wrap">
                    <?= do_shortcode('[contact-form-7 id="d7cf4b0" title="Получить прайс-лист"]') ?>
                </div>
            </div>
        </div>
    </div>

    <? // Нужна помощь ?>
    <div id="needhelp" class="modal">
        <button class="modal__close" aria-label="Закрыть окно"></button>

        <div class="modal__body">
            <div class="modal__feedback-wrap">
                <div class="modal__heading">
                    <h2 class="modal__title">Нужна помощь в подборе зарядной станции?</h2>
                    <p class="modal__description">
                        Оставьте свой номер телефона. Наш менеджер перезвонит через 5 минут и проведет бесплатную
                        консультацию.
                    </p>
                </div>

                <div class="modal__form-wrap">
                    <?= do_shortcode('[contact-form-7 id="5435dc7" title="Бесплатная консультация"]') ?>
                </div>
            </div>
        </div>
    </div>

    <?php // Товар ?>
    <div id="product" class="modal modal-product">
        <button class="modal__close" aria-label="Закрыть окно"></button>
        <button class="modal-product__back" aria-label="Закрыть окно">Все товары</button>

        <div class="modal__body modal-product__body product-detail">
            <div class="product-detail__thumbnail-wrap">
                <picture>
                    <img src="" alt="" class="product-detail__thumbnail js-product-detail-thumb">
                </picture>
            </div>

            <div class="product-detail__info">
                <h2 class="product-detail__title js-product-detail-title"></h2>
                <span class="product-detail__price js-product-detail-price"></span>
                <div class="product-detail__actions">
                    <button class="btn btn--fill js-product-detail-buy">Заказать</button>
                </div>
                <div class="product-detail__description js-product-detail-description"></div>
            </div>
        </div>
    </div>


    <div id="order" class="modal">
        <button class="modal__close" aria-label="Закрыть окно"></button>

        <div class="modal__body">
            <div class="modal__feedback-wrap">
                <div class="modal__heading">
                    <h2 class="modal__title">Сделать заказ</h2>
                    <p class="modal__description">
                        Оставьте свой номер телефона. Наш менеджер перезвонит через 5 минут и проведет бесплатную
                        консультацию.
                    </p>
                </div>

                <div class="modal__form-wrap">
                    <?= do_shortcode('[contact-form-7 id="df3d325" title="Сделать заказ"]') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>
