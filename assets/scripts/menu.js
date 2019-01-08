const menu = () => {
  const burger = document.querySelector('.js-menu-burger');
  const navigation = document.querySelector('.js-navigation');

  burger.addEventListener('click', event => {
    event.preventDefault();

    navigation.classList.toggle('navigation--is-open');
  });
};

export default menu;
