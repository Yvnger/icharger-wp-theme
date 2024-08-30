export function createEl(tag = 'div', ...classes) {
  const element = document.createElement(tag);

  if (classes) {
    element.classList.add(...classes);
  }

  return element;
}
