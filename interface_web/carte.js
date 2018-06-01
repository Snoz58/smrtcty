var container = document.getElementById('popup');
var content = document.getElementById('popup-content');

// Transformation du GeoJson en Vector
var vectorSource = new ol.source.Vector({
    format: new ol.format.GeoJSON(),
    url: './cartejson.php'
});

// icône des points d'intérêt
var iconStyle = new ol.style.Style({
  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
    anchor: [0.5, 46],
    anchorXUnits: 'fraction',
    anchorYUnits: 'pixels',
    opacity: 0.75,
    src: 'icon.png'
  }))
});

// vectorLayer + icones = layer
var vectorLayer = new ol.layer.Vector({
    source: vectorSource,
    style: iconStyle
});


// Initialisation de la popup
var overlay = new ol.Overlay({
  element: container,
  autoPan: true,
  autoPanAnimation: {
    duration: 250
  }
});


  var map = new ol.Map({
    interactions: ol.interaction.defaults({mouseWheelZoom:false}),
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      }),
      vectorLayer,
    ],
    target: 'map',
    overlays: [overlay],
    controls: ol.control.defaults({
      attributionOptions: {
        collapsible: false
      }
    }),
    view: new ol.View({ // Initialisation de la carte
      center: ol.proj.transform([3.1534730919589, 46.99032446763], 'EPSG:4326', 'EPSG:3857'),
      zoom: 14
    })
  });


   map.on('click', function(e) {
      let markup = '';
      var coordonnes;
      map.forEachFeatureAtPixel(e.pixel, function(feature) {
        const properties = feature.getProperties();
        markup += `${markup && '<hr>'}<table>`;
        for (const property in properties) {
            if (property != "geometry"){
              markup += `<tr><th>${property}</th><td>${properties[property]}</td></tr>`;
            }
        }
        markup += '</table>';
        coordonnes = feature.getGeometry().getCoordinates();
      }, {hitTolerance: 1});
      if (markup) {
        document.getElementById('popup-content').innerHTML = markup;
        overlay.setPosition(coordonnes);
      }
      else {
        overlay.setPosition();
      }
    });
