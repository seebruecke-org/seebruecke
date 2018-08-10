const map = () => {
  const container = document.querySelector('.js-map');
  const data = JSON.parse(container.dataset.data);
  const mapClient = window.google && new window.google.maps.Map(
    container,
    {
      center: {
        lat: 51.1657,
        lng: 10.4515,
      },
      zoom: 4.5,
    }
  );

  // add markers
  data.forEach(marker => {
    const coordinates = marker.coordinates && marker.coordinates.split(',');
    const title = marker.title || false;
    const url = marker.url;

    if (coordinates && coordinates[0] && coordinates[1]) {
      const mapsMarker = new google.maps.Marker({
        position: {
          lat: parseInt(coordinates[0], 10),
          lng: parseInt(coordinates[1], 10),
        },
        map: mapClient,
        title,
      });

      mapsMarker.addListener('click', () => {
        window.location.href = url;
      });
    }
  });
};

export default map;
