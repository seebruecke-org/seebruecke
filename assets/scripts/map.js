import mapIcon from '../images/map-marker.svg';
import mapIconCircle from '../images/map-circle.svg';

const MAP_DEFAULTS = {
  center: {
    lat: 51.1657,
    lng: 10.4515,
  },
  styles: [
    {
      elementType: 'geometry.fill',
      stylers: [
        {
          color: '#242830'
        }
      ]
    },

    {
      elementType: 'geometry.stroke',
      stylers: [
        {
          color: '#414141'
        }
      ]
    },

    {
      featureType: 'water',
      elementType: 'geometry',
      stylers: [
        {
          color: '#414141'
        }
      ]
    },


    {
      elementType: 'labels.text.fill',
      stylers: [
        {
          color: '#989898'
        }
      ]
    },

    {
      elementType: 'labels.text.stroke',
      stylers: [
        {
          color: '#242830'
        }
      ]
    },

    {
      featureType: 'road',
      stylers: [
        {
          visibility: 'off'
        }
      ]
    }
  ],
  mapTypeControl: false,
  rotateControl: false,
  fullscreenControl: false,
  streetViewControl: false,
  zoom: 5.5,
};

const addMaker = (marker, map, options = {}) => {
  const coordinates = marker.coordinates && marker.coordinates.split(',');
  const { title, url } = marker;
  const icon = {
    url: 'https://seebruecke.org/wp-content/themes/seebruecke/dist/images/map-circle.svg',
    anchor: new google.maps.Point(8.5, 8.5),
    scaledSize: new google.maps.Size(17, 17),
    labelOrigin: new google.maps.Point(0, 25),
  };

  if (coordinates && coordinates[0] && coordinates[1]) {
    const mapsMarker = new window.google.maps.Marker({
      icon,
      position: {
        lat: parseFloat(coordinates[0]),
        lng: parseFloat(coordinates[1]),
      },
      map,
      title,
      label: options.showLabel && {
        text: title,
        color: 'white',
        fontFamily: '"Work Sans", sans-serif',
        fontSize: '11px',
        fontWeight: 'normal',
      },
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

  if (container.dataset && container.dataset.showLabel && container.dataset.showLabel === "true") {
    MAP_DEFAULTS.styles.push({
      featureType: "administrative.country",
      elementType: "labels",
      stylers: [
          { visibility: "off" }
      ]
    });

    MAP_DEFAULTS.styles.push({
      featureType: "administrative.country",
      elementType: "labels",
      stylers: [
          { visibility: "off" }
      ]
    });

    MAP_DEFAULTS.styles.push({
      "featureType": "administrative.neighborhood",
      "elementType": "labels",
      "stylers": [
        { "visibility": "off" }
      ]
    });

    MAP_DEFAULTS.styles.push({
      "featureType": "administrative.land_parcel",
      "elementType": "labels",
      "stylers": [
        { "visibility": "off" }
      ]
    });

    MAP_DEFAULTS.styles.push({
      "featureType": "administrative.locality",
      "elementType": "labels",
      "stylers": [
        { "visibility": "off" }
      ]
    });

    MAP_DEFAULTS.zoom = 11;
  }

  const markerOptions = {
    icon: container.dataset &&
          container.dataset.icon,
    showLabel: container.dataset &&
               container.dataset.showLabel &&
               container.dataset.showLabel === "true"
  };

  data.forEach(marker => addMaker(marker, client, markerOptions));
};

export default map;
