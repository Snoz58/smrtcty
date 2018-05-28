<!DOCTYPE html>
<html>
  <head>
    <title>GeoJSON</title>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>


    <link rel="stylesheet" href="carte.css">
    <style>
          .ol-popup {
            position: absolute;
            background-color: white;
            -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
            filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 55px;
            left: -50px;
            min-width: 280px;
          }

          .ol-popup:after, .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
          }
          .ol-popup:after { /* Flèche en bas */
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
          }
          .ol-popup:before { /* Flèche en bas */
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
          }
          .ol-popup-closer { /* Croix fermer */
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
          }
          .ol-popup-closer:after {
            content: "✖";
          }
        </style>

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

    // var iconFeature = new ol.Feature({
    //   geometry: new ol.geom.Point(ol.proj.transform([3.1507, 46.9889], 'EPSG:4326',
    //   'EPSG:3857')),
    //   population: 4000,
    //   rainfall: 500,
    //   id: "67",
    //   name: "LabFab MDA",
    //   organisation: "",
    //   structure: "fablab",
    //   adresse: "Maison des Associations<br />6, cours des Alliés",
    //   cp: "35000",
    //   ville: "Rennes",
    //   web: "<a href='http://www.labfab.fr'>www.labfab.fr</a>",
    //   twitter: "@labfabfr",
    //   facebook: "labfabfr",
    //   email: "mda@labfab.fr",
    //   tel: "",
    //   rss: "http://www.labfab.fr/feed/"
    // });
    //
    // var iconFeature1 = new ol.Feature({
    //   geometry: new ol.geom.Point(ol.proj.transform([-73.1234, 45.678], 'EPSG:4326',
    //   'EPSG:3857')),
    //   name: 'Null Island Two',
    //   population: 4001,
    //   rainfall: 501
    // });
    //
    // iconFeatures.push(iconFeature);
    // iconFeatures.push(iconFeature1);
    //
    // var vectorSource = new ol.source.Vector({
    //   features: iconFeatures //add an array of features
    // });










var geojsonObject = {

"type": "FeatureCollection",
"features": [{
  "type": "Feature",
  "properties": {
    "id": "id1",
    "name": "Point 1",
    "property_a": "propA1",
    "property_d": "propD1",
    "property_c": "propC1",
    "property_d": "propAutreD1",
  },
  "geometry": {
        	"type": "Point",
        	"coordinates": ol.proj.transform([3.1507, 46.9889], 'EPSG:4326', 'EPSG:3857')
      }
},{
  "type": "Feature",
  "properties": {
    "id": "id2",
    "name": "Point 2",
    "property_a": "propA2",
    "property_d": "propD2",
    "property_c": "propC2",
    "property_d": "propAutreD2"
  },
  "geometry": {
        "type": "Point",
        "coordinates": ol.proj.transform([4.1507, 45.9889], 'EPSG:4326', 'EPSG:3857')
    }
}]

};

      var vectorSource = new ol.source.Vector({
        features: (new ol.format.GeoJSON()).readFeatures(geojsonObject)
      });












    var iconStyle = new ol.style.Style({
      image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
        anchor: [0.5, 46],
        anchorXUnits: 'fraction',
        anchorYUnits: 'pixels',
        opacity: 0.75,
        src: 'icon.png'
      }))
    });


    var vectorLayer = new ol.layer.Vector({
      source: vectorSource,
      style: iconStyle
    });

    var overlay = new ol.Overlay({
           element: container,
           autoPan: true,
           autoPanAnimation: {
             duration: 250
           }
         });


    closer.onclick = function() {
       overlay.setPosition(undefined);
       closer.blur();
       return false;
     };

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
        view: new ol.View({
          center: ol.proj.transform([3.1534730919589, 46.99032446763], 'EPSG:4326', 'EPSG:3857'),
          zoom: 6
        })
      });


       // map.on('singleclick', function(evt) {
       //   var coordinate = evt.coordinate;
       //   var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(
       //       coordinate, 'EPSG:3857', 'EPSG:4326'));
       //
       //   content.innerHTML = '<p>You clicked here:</p><code>' + hdms +
       //       '</code>';
       //   overlay.setPosition(coordinate);
       // });

       // map.on("click", function(e) {
       //     map.forEachFeatureAtPixel(e.pixel, function (feature, layer) {
       //       var coordinate = e.coordinate;
       //       var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(
       //           coordinate, 'EPSG:3857', 'EPSG:4326'));
       //
       //       content.innerHTML = '<p>You clicked here:</p><code>' + hdms +
       //           '</code>';
       //       overlay.setPosition(coordinate);
       //
       //     })
       // });

       // map.on('click', function(e) {
       //    overlay.setPosition();
       //    var features = map.getFeaturesAtPixel(e.pixel);
       //    if (features) {
       //      var coords = features[0].getGeometry().getCoordinates();
       //
       //      var hdms = ol.coordinate.toStringHDMS(ol.proj.toLonLat(coords))+" - "features[2].get;
       //      overlay.getElement().innerHTML = hdms;
       //      overlay.setPosition(coords);
       //    }
       //  });


       map.on('click', function(e) {
          let markup = '';
          var coordonnes;
          map.forEachFeatureAtPixel(e.pixel, function(feature) {
            markup += `${markup && '<hr>'}<table>`;
            const properties = feature.getProperties();
            for (const property in properties) {
                markup += `<tr><th>${property}</th><td>${properties[property]}</td></tr>`;
            }
            console.log(properties);
            coordonnes = feature.getGeometry().getCoordinates();
            //console.log(feature.getGeometry().getCoordinates());
            markup += '</table>';
          }, {hitTolerance: 1});
          if (markup) {
            document.getElementById('popup-content').innerHTML = markup;
            overlay.setPosition([coordonnes[0], coordonnes[1]]);
            console.log("event");
            console.log(e.coordinate);
            console.log("getCoordinates");
            console.log(coordonnes);
          } else {
            overlay.setPosition();
          }
        });


    </script>
  </body>
</html>
