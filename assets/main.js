import domReady from 'when-dom-ready';

import './styles/index.scss';
import './images/favicon.png';

import map from './scripts/map';

// we have to expose the map for the API callback
window.googleMaps = map;

domReady().then(() => {
  map();
});
