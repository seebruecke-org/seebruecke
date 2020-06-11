import domReady from 'when-dom-ready';

import './styles/index.scss';
import './images/favicon.png';

import map from './scripts/map';
import menu from './scripts/menu';

domReady().then(() => {
  map();
  menu();
});
