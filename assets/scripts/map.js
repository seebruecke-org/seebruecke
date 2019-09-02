import mapboxgl from 'mapbox-gl';

const { Marker, Map } = mapboxgl;

mapboxgl.accessToken = 'pk.eyJ1Ijoic2VlYnJ1ZWNrZSIsImEiOiJjanp4eGN2c3QwdzNlM29xOTFuNmxxcHF0In0.i7iVogDa5KoEOxKBiZ_l1Q';

const MAP_DEFAULTS = {

};

const addMaker = (marker, map) => {
  const coordinates = marker.coordinates && marker.coordinates.split(',');

  if (coordinates && coordinates[0] && coordinates[1]) {
    const mapsMarker = new Marker();

    console.log(coordinates);

    mapsMarker
      .setLngLat([parseFloat(coordinates[1]), parseFloat(coordinates[0])])
      .addTo(map);
  }
};

const map = () => {
  const container = document.querySelector('.js-map');
  const data = container &&
               container.dataset &&
               JSON.parse(container.dataset.data);

  if (!container || !data) {
    return;
  }

  const client = new Map({
    container,
    style: 'mapbox://styles/mapbox/light-v9',
    center: [10.4515, 51.1657],
    zoom: 4.5,
  });

  client.scrollZoom.disable();

  data.forEach(marker => addMaker(marker, client));
};

export default map;
