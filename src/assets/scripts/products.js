import {openModal, closeModal} from "./modals";

const productCards = document.querySelectorAll('.js-product-card');

productCards.forEach(card => {
    card.addEventListener('click', () => {
        const productId = card.dataset.productId;

        getPostData(productId);
    })
});

const productModal = document.getElementById('product');
const orderModal = document.getElementById('order');
const orderProductField = document.getElementById('ord-product');

// Собираем элементы
const productThumb = productModal.querySelector('.js-product-detail-thumb');
const productTitle = productModal.querySelector('.js-product-detail-title');
const productPrice = productModal.querySelector('.js-product-detail-price');
const productDescription = productModal.querySelector('.js-product-detail-description');
const productBuyButton = productModal.querySelector('.js-product-detail-buy');

productBuyButton.addEventListener('click', () => {
    const productId = productBuyButton.dataset.productId;
    orderProductField.value = `${productTitle.textContent} (${productPrice.textContent})`;

    closeModal(productModal);

    openModal(orderModal);
});

// Функция для отправки AJAX запроса и получения данных записи по ID
function getPostData(postId) {
    const data = {
        action: 'get_post_data', // Название вашего AJAX обработчика без префикса 'wp_ajax_' и 'wp_ajax_nopriv_'
        post_id: postId
    };

    // Отправляем AJAX запрос
    jQuery.post(ajax_object.ajax_url, data, function(response) {
        if (response.success) {
            // Обработка успешного ответа
            setProductModalData(response.data);
        } else {
            // Обработка ошибки
            console.error('Ошибка при получении данных:', response.data);
        }
    });
}

function setProductModalData(data) {
    // Присваиваем значения
    productThumb.src = data.thumb;
    productTitle.innerHTML = data.title;
    productPrice.innerHTML = data.price;
    productDescription.innerHTML = data.details;
    productBuyButton.dataset.productId = data.id;

    // Открываем модальное окно после загрузки данных
    openModal(productModal);
}