const MAP_DEFAULTS = {
  center: {
    lat: 51.1657,
    lng: 10.4515,
  },
  zoom: 4.5,
};

const addMaker = (marker, map) => {
  const coordinates = marker.coordinates && marker.coordinates.split(',');
  const { title, url } = marker;

  if (coordinates && coordinates[0] && coordinates[1]) {
    const mapsMarker = new window.google.maps.Marker({
      position: {
        lat: parseFloat(coordinates[0]),
        lng: parseFloat(coordinates[1]),
      },
      map,
      title,
    });

    mapsMarker.addListener('click', () => window.location.href = url);
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

  const client = window.google && new window.google.maps.Map(
    container,
    MAP_DEFAULTS,
  );

  data.forEach(marker => addMaker(marker, client));
};

export default map;
