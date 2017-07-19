var map, mapoverlay, parsed_map_vars, markers;
var pulseElement = document.createElement('div');
pulseElement.classList.add('element');
var thatMarker;

showIconDetails = function(markerElement, thisMarker) {
  thatMarker = thisMarker;
  // thisMarker.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
  // markerElement.addClass('img-icon-anim');
  // markerElement.append(pulseElement);
};

removeIconDetails = function(markerElement, thisMarker) {
  // thisMarker.setZIndex(thatMarker.getZIndex());
  // markerElement.removeClass('img-icon-anim');
  // markerElement.children('.element').remove();
};


loadMarker = function(_id) {
  // var id = _id ||  _.keys(markers)[0];
  // var marker = markers[id];
  // var elements = document.getElementsByClassName('cc-map-marker '+id);
  // console.dir(elements);
  // var markerElement = elements[0];
  // showIconDetails(markerElement, marker);
};

//kick it

// scrollToDetail = function() {
//   console.dir(this);
//   Waypoint.disableAll();
//   var _id = this.title;
//   // var scrollItem = $('.travel__detail__map__item.'+_id);
//   // var container = $('.travel__detail__map__list');
//   // $('*').removeClass('img-icon-anim');
//   // loadMarker(_id);
//   // container.animate({
//   //   scrollTop: scrollItem.offset().top - container.offset().top + container.scrollTop()
//   // }, 2000, function() {
//   //   Waypoint.enableAll();
//   // });
// };

var styles = [
    {
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#f5f5f5"
        },
        {
          "weight": 0.5
        }
      ]
    },
    {
      "elementType": "geometry.fill",
      "stylers": [
        {
          "color": "#EEEAE6"
        }
      ]
    },
    {
      "elementType": "geometry.stroke",
      "stylers": [
        {
          "color": "#ffffff"
        }
      ]
    },
    {
      "elementType": "labels.icon",
      "stylers": [
        {
          "color": "#2d261f"
        },
        {
          "visibility": "off"
        }
      ]
    },
    {
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#616161"
        }
      ]
    },
    {
      "elementType": "labels.text.stroke",
      "stylers": [
        {
          "color": "#f5f5f5"
        }
      ]
    },
    {
      "featureType": "administrative.land_parcel",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#bdbdbd"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#eeeeee"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#757575"
        }
      ]
    },
    {
      "featureType": "poi.park",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#e5e5e5"
        }
      ]
    },
    {
      "featureType": "poi.park",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#9e9e9e"
        }
      ]
    },
    {
      "featureType": "road",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#ffffff"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#757575"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#dadada"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#616161"
        }
      ]
    },
    {
      "featureType": "road.local",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#9e9e9e"
        }
      ]
    },
    {
      "featureType": "transit.line",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#e5e5e5"
        }
      ]
    },
    {
      "featureType": "transit.station",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#eeeeee"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#c9c9c9"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#9e9e9e"
        }
      ]
    }
  ];

// function initMap() {
//    console.log('loading richmarker');
//    var headID = document.getElementsByTagName("head")[0],
//    newScript = document.createElement('script');
//    newScript.type = 'text/javascript';
//    newScript.src = "/app/themes/culturecollide-theme/dist/scripts/rich_marker.js";
//    headID.appendChild(newScript);
// }
