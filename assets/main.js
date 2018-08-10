import './styles/index.scss';

import map from './scripts/map';

// we have to expose the map for the API callback
window.googleMaps = map;
