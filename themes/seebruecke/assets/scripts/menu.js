const init = () => {
  const burger = document.querySelector('.js-burger');

  if (burger) {
    burger.addEventListener('click', event => {
      event.preventDefault();

      const header = document.querySelector('.v2-header');

      header.classList.toggle('v2-header--is-open');
    });
  }
};

export default init;
