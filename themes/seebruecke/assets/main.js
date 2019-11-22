import domReady from 'when-dom-ready';

import './styles/index.scss';
import './images/favicon.png';

import map from './scripts/map';

domReady().then(() => {
  map();
});
