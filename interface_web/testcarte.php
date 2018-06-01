<!DOCTYPE html>
<html>
  <head>
    <title>GeoJSON</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
    <link rel="stylesheet" href="carte.css">


  </head>

  <body>
    <div id="map" class="map"></div>
    <div id="popup" class="ol-popup">
      <a href="#" id="popup-closer" class="ol-popup-closer"></a>
      <div id="popup-content"></div>
    </div>
    <script>

    var iconFeatures=[];
    var container = document.getElementById('popup');
    var content = document.getElementById('popup-content');
    var closer = document.getElementById('popup-closer');

    // Transformation du GeoJson en Vector
    var vectorSource = new ol.source.Vector({
        format: new ol.format.GeoJSON(),
        url: './carte.json'
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
          zoom: 9
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

    </script>
  </body>
</html>