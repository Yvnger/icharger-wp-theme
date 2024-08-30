
const modalTriggers = document.querySelectorAll('.js-modal-trigger');
const modals = document.querySelectorAll('.modal');
const modalActiveClass = 'modal--opened';

modalTriggers.forEach(trigger => {
  const targetModal = trigger.dataset.modal;
  const modal = document.getElementById(targetModal);

  trigger.addEventListener('click', () => {
      openModal(modal);
  })
});

export function openModal(modal) {
    modal.classList.add(modalActiveClass);
}

export function closeModal(modal) {
    modal.classList.remove(modalActiveClass);
}


modals.forEach(modal => {
  const close = modal.querySelector('.modal__close');
  const body = modal.querySelector('.modal__body');

  if (body) {
    body.addEventListener('click', event => {
      event._clickOnBody = true;
    })
  }

  modal.addEventListener('click', event => {
    if (event._clickOnBody) return;

    closeModal(modal);
  });

  close.addEventListener('click', () => {
    closeModal(modal);
  })
});