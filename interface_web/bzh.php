<html>

<head>

       <!--

       =============================================================================
       	CARTE DES FABLABS DE BRETAGNE
       =============================================================================
       	Auteur : Guillaume ROUAN | http://guillaume-rouan.net | @grouan
       -----------------------------------------------------------------------------
       	Licence : CC BY
              Création : Octobre 2015
              Technos : OpenStreetMap + Mapbox + Leaflet
              Thématiques : FabLab, MakerSpace, HackerSpace, FrenchTech,
              		Cantine numérique, Tiers Lieux, Usages numériques
       -----------------------------------------------------------------------------

       -->
	<title>Carte des FabLabs de Bretagne</title>

       <!-- Feuille de style Leaflet + zone de carte -->
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
       <style type="text/css">
		#map {
			margin:0px;
			height:100%;
		}
	</style>

       <!-- Bibliothèques Javascript Leaflet + OpenLayers -->
       <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
       <script src="http://www.openlayers.org/api/OpenLayers.js"></script>

       <!-- Paramétrages de la couche Mapbox + légende de la carte -->
       <script>
		ACCESS_TOKEN = 'XXX'; /* Voir http://www.mapbox.com pour en créer un */

		CM_ATTR = 'Donn&eacute;es carte &copy; contributeurs <a href="http://openstreetmap.org">OpenStreetMap</a>, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://cloudmade.com">CloudMade</a>';

		CM_URL = 'http://{s}.tile.cloudmade.com/d4fc77ea4a63471cab2423e66626cbb6/{styleId}/256/{z}/{x}/{y}.png';

		MB_ATTR = '<a href="http://openstreetmap.org" target="_blank">OpenStreetMap</a> + ' +
			'<a href="http://mapbox.com" target="_blank">Mapbox</a> | ' +
			'<a href="http://guillaume-rouan.net" target="_blank">Guillaume Rouan</a> <a href="http://creativecommons.fr/licences/" target="_blank">CC BY</a>';

		MB_URL = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=' + ACCESS_TOKEN;

		OSM_URL = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

		OSM_ATTRIB = '&copy; contributeurs <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> ';
	</script>

</head>

<body style="margin:0px;padding:0px;">

  <!-- LA CARTE -->
  <div id="map"></div>

  <!-- LES PARAMETRES DE LA CARTE -->
  <script>

/* === CENTRAGE DE LA CARTE SUR LA BRETAGNE === */
var map = new L.Map({
  layers: [
    new L.layer.Tile({
      source: new L.source.OSM()
    })
  ],
  view: new L.View({
    center: L.proj.transform([3.1534730919589, 46.99032446763], 'EPSG:4326', 'EPSG:3857'),
    zoom: 6
  })
});
/* === ID MAPBOX === */
	L.tileLayer(MB_URL, {attribution: MB_ATTR, id: 'YYY'}).addTo(map);

/* === PARAMETRAGE DES MARKERS === */
	var 	LeafIcon = L.Icon.extend({ options: { iconSize: [35, 35]} });
	var 	hackerspace_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_hakerspace.png'}), /* HackerSpace */
		makerspace_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_makerspace.png'}), /* MakerSpace */
		tierslieu_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_tierslieu.png'}); /* TiersLieu */
		usages_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_usages.png'}); /* Usages */
		frenchtech_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_frenchtech.png'}); /* FrenchTech */
		fablabmit_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_fablabMIT.png'}); /* FabLab MIT */
		fablab_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_fablab.png'}); /* FabLab */
		cantine_Icon = new LeafIcon({iconUrl: 'http://guillaume-rouan.net/blog/wp-content/uploads/2015/10/osm_marker_cantine.png'}); /* Cantine */


/* === GEOLOCALISATION === */

	/* --- FabLab --- */
	L.marker([48.3584389,-4.5675242], {icon: fablab_Icon}).bindPopup("<b>T&eacute;l&eacute;Fab Brest</b><br />T&eacute;l&eacute;com Bretagne<br />Technop&ocirc;le Brest-Iroise<br />29200 BREST<br /><a href='http://telefab.fr' target='_blank'>telefab.fr</a>").addTo(map);
	L.marker([48.1202251,-1.6290429], {icon: fablab_Icon}).bindPopup("<b>T&eacute;l&eacute;Fab Rennes</b><br />T&eacute;l&eacute;com Bretagne<br />2, Rue de la Ch&acirc;taigneraie<br />35510 CESSON<br /><a href='http://telefab.fr' target='_blank'>telefab.fr</a>").addTo(map);
	L.marker([48.111270965232336,-1.6792774200439453], {icon: fablab_Icon}).bindPopup("<b>Le Biome</b><br />35000 RENNES<br /><a href='http://lebiomefablab.wix.com/lebiome' target='_blank'>lebiomefablab.wix.com/lebiome</a> | <a href='http://twitter.com/Le_biome' target='_blank'>@Le_biome</a>").addTo(map);
	L.marker([48.06847276507187,-2.9683685302734375], {icon: fablab_Icon}).bindPopup("<b>Lab Bro Pondi</b><br />56300 PONTIVY<br /><a href='http://labbropondi.fr' target='_blank'>labbropondi.fr</a> | <a href='http://twitter.com/LabBroPondi' target='_blank'>@LabBroPondi</a>").addTo(map);
	L.marker([48.5232504,-2.7490835], {icon: fablab_Icon}).bindPopup("<b>Saint-Brieuc Factory</b><br />Carr&eacute; Rosengart Quai Armez<br />22000 SAINT-BRIEUC<br /><a href='http://www.saint-brieuc-factory.fr' target='_blank'>saint-brieuc-factory.fr</a>").addTo(map);
	L.marker([48.64887382705131,-2.0260655879974365], {icon: fablab_Icon}).bindPopup("<b>Atelier de la Flibuste</b><br />35280 SAINT-MALO<br /><a href='http://atelierdelaflibuste.fr' target='_blank'>atelierdelaflibuste.fr</a> | <a href='http://twitter.com/fablabsaintmalo' target='_blank'>@fablabsaintmalo</a>").addTo(map);
	L.marker([48.39860784596984,-4.497463703155518], {icon: fablab_Icon}).bindPopup("<b>Open Factory</b><br />Universit&eacute; Bretagne Ouest<br />3, rue des Archives<br />29200 BREST").addTo(map);
	L.marker([48.4085813395762,-4.480866193771362], {icon: fablab_Icon}).bindPopup("<b>POC Girafe</b><br />TyFab<br />Rue Jules Lesven<br />29200 BREST<br /><a href='http://www.poclagirafe.bzh' target='_blank'>poclagirafe.bzh</a> | <a href='http://twitter.com/collectif_poc' target='_blank'>@collectif_poc</a>").addTo(map);
	L.marker([47.666769,-2.9856916], {icon: fablab_Icon}).bindPopup("<b>La Fabrique du Loch</b><br />56400 AURAY<br /><a href='http://twitter.com/fabriqueduloch' target='_blank'>@fabriqueduloch</a>").addTo(map);

	/* --- MakerSpace --- */
	L.marker([47.74043, -3.40837], {icon: makerspace_Icon}).bindPopup("<b>Cr&eacute;aFab</b><br />Espace Cr&eacute;a Parc Technologique de Soye<br />Rue Galil&eacute;e<br />56270 PL&OElig;MEUR<br /><a href='http://www.crepp.org' target='_blank'>crepp.org</a> | <a href='http://twitter.com/CREAFABLorient' target='_blank'>@CREAFABLorient</a>").addTo(map);
	L.marker([48.0027842, -4.0940971], {icon: makerspace_Icon}).bindPopup("<b>FabriKern&eacute;</b><br />MJC de Kerfeunteun<br />4, rue Teilhard de Chardin<br />29000 QUIMPER<br /><a href='http://fabrikerne.fr' target='_blank'>fabrikerne.fr</a> | <a href='http://twitter.com/FabriKerne' target='_blank'>@FabriKerne</a>").addTo(map);


	/* --- HackerSpace --- */
	L.marker([48.1067505,-1.6510436], {icon: hackerspace_Icon}).bindPopup("<b>Breizh-Entropy</b><br />48, bd Villebois Mareuil<br />35000 RENNES<br /><a href='http://breizh-entropy.org' target='_blank'>breizh-entropy.org</a>").addTo(map);


	/* --- French Tech --- */
	L.marker([48.10689030135254,-1.677609086036682], {icon: frenchtech_Icon}).bindPopup("<b>La FrenchTech Rennes Saint-Malo</b><br />20, rue d'Isly<br />35000 RENNES<br /><a href='http://lafrenchtech-rennes.fr' target='_blank'>lafrenchtech-rennes.fr</a> | <a href='http://twitter.com/LaFTRennes' target='_blank'>@LaFTRennes</a>").addTo(map);
	L.marker([47.76193086576956,-2.1291160583496094], {icon: frenchtech_Icon}).bindPopup("<b>Le Grenier num&eacute;rique</b><br />Place de la Ferronnerie<br />56200 LA GACILLY<br /><a href='http://www.legreniernumerique.fr' target='_blank'>legreniernumerique.fr</a> | <a href='http://twitter.com/grenier_numeriq' target='_blank'>@grenier_numeriq</a>").addTo(map);
	L.marker([47.816875743505456,-2.1348077058792114], {icon: frenchtech_Icon}).bindPopup("<b>La Nurserie num&eacute;rique</b><br />Place de l'&Eacute;toile<br />56910 CARENTOIR<br /><a href='http://twitter.com/NnumCarentoir' target='_blank'>@NnumCarentoir</a>").addTo(map);
	L.marker([47.81002026746962,-2.3845428228378296], {icon: frenchtech_Icon}).bindPopup("<b>La Nurserie num&eacute;rique</b><br />Place du Docteur Jean Queinnec<br />56140 MALESTROIT<br /><a href='http://www.lanurserienumerique.com' target='_blank'>lanurserienumerique.com</a> | <a href='http://twitter.com/NNumerique' target='_blank'>@NNumerique</a>").addTo(map);


	/* --- Cantine Numérique --- */
	L.marker([47.98256841921402,-4.0374755859375], {icon: cantine_Icon}).bindPopup("<b>SiliconKern&eacute;</b><br />2 rue Fran&ccedil;ois Briant de Laubri&egrave;re<br />29000 QUIMPER<br /><a href='http://www.silicon-kerne.net' target='_blank'>silicon-kerne.net</a> | <a href='http://twitter.com/SiliconKerne' target='_blank'>@SiliconKerne</a>").addTo(map);
	L.marker([48.5091313,-2.7598532], {icon: cantine_Icon}).bindPopup("<b>La Matrice</b><br />21, bd Cl&eacute;menceau<br />22000 SAINT-BRIEUC<br /><a href='http://lamatrice.org' target='_blank'>lamatrice.org</a> | <a href='http://twitter.com/LaMatrice_SB' target='_blank'>@LaMatrice_SB</a>").addTo(map);
	L.marker([48.64692097935483,-2.0070433616638184], {icon: cantine_Icon}).bindPopup("<b>La CamBuzz</b><br />P&ocirc;le La Grande Passerelle<br />Rue Th&eacute;odore Monod<br />35288 SAINT-MALO<br /><a href='http://digital-saint-malo.com' target='_blank'>digital-saint-malo.com</a> | <a href='http://twitter.com/LaCamBuzz' target='_blank'>@LaCamBuzz</a>").addTo(map);
	L.marker([48.3919666,-4.4878427], {icon: cantine_Icon}).bindPopup("<b>La Cantine Num&eacute;rique brestoise An Daol Vras</b><br />20, rue Duquesne<br />29200 BREST<br /><a href='http://www.lacantine-brest.net' target='_blank'>lacantine-brest.net</a> | <a href='http://twitter.com/AnDaolVras' target='_blank'>@AnDaolVras</a>").addTo(map);


	/* --- Tiers Lieu --- */
	L.marker([48.4085982,-4.4805], {icon: tierslieu_Icon}).bindPopup("<b>Les Fabriques du Ponant</b><br />40, rue Jules Lesven<br />29200 BREST<br /><a href='http://www.lesfabriquesduponant.net' target='_blank'>lesfabriquesduponant.net</a> | <a href='http://twitter.com/FabDuPonant' target='_blank'>@FabDuPonant</a>").addTo(map);
	L.marker([47.62876324543288,-2.64920711517334], {icon: tierslieu_Icon}).bindPopup("<b>Tilt</b><br />56450 THEIX<br /><a href='http://twitter.com/tilt_theix' target='_blank'>@tilt_theix</a>").addTo(map);


	/* --- Usages --- */
	L.marker([48.10476968234334,-1.6765335202217102], {icon: usages_Icon}).bindPopup("<b>Bug</b><br />6 cours des Alli&eacute;s<br />35000 RENNES<br /><a href='http://www.asso-bug.org' target='_blank'>asso-bug.org</a> | <a href='http://twitter.com/assobug' target='_blank'>@assobug</a>").addTo(map);
	L.marker([47.74300658709913,-3.3655151724815364], {icon: usages_Icon}).bindPopup("<b>Camp'TIC</b><br />31, rue Duguay-Trouin<br />56100 LORIENT<br /><a href='http://www.camptic.fr' target='_blank'>camptic.fr</a> | <a href='http://twitter.com/CampTIC' target='_blank'>@CampTIC</a>").addTo(map);
	L.marker([48.10509387047545,-1.674259006977081], {icon: usages_Icon}).bindPopup("<b>Mus&eacute;omix Ouest</b><br />Mus&eacute;e de la Bretagne<br />10, cours des Alli&eacute;s<br />35000 RENNES<br /><a href='http://www.museomix.org' target='_blank'>museomix.org</a> | <a href='http://twitter.com/MuseomixOuest' target='_blank'>@MuseomixOuest</a>").addTo(map);
	L.marker([48.10527477014653,-1.6743314266204834], {icon: usages_Icon}).bindPopup("<b>Biblio Remix</b><br />Les Champs Libres<br />10, cours des Alli&eacute;s<br />35000 RENNES<br /><a href='http://biblioremix.wordpress.com' target='_blank'>biblioremix.wordpress.com</a> | <a href='http://twitter.com/BiblioRemix' target='_blank'>@BiblioRemix</a>").addTo(map);
	L.marker([48.50904746652217,-2.759740948677063], {icon: usages_Icon}).bindPopup("<b>Kreizenn Dafar</b><br />La Matrice<br />22000 SAINT-BRIEUC<br /><a href='http://www.kreizenn-dafar.org' target='_blank'>kreizenn-dafar.org</a> | <a href='http://twitter.com/KreizennDafar' target='_blank'>@KreizennDafar</a>").addTo(map);
	L.marker([48.3846115,-4.4888529], {icon: usages_Icon}).bindPopup("<b>Biblioth&egrave;que de Brest</b><br />Espace Multim&eacute;dia<br />16, bis rue traverse<br />29200 BREST<br /><a href='http://www.atelier-multimedia-brest.fr' target='_blank'>atelier-multimedia-brest.fr</a> | <a href='http://twitter.com/bibliobrest' target='_blank'>@bibliobrest</a>").addTo(map);
	L.marker([47.87392873628959,-3.0173322558403015], {icon: usages_Icon}).bindPopup("<b>M&eacute;diath&egrave;que de Baud</b><br />3, avenue Jean Moulin<br />56150 BAUD<br /><a href='http://baud.c3rb.org' target='_blank'>baud.c3rb.org</a> | <a href='http://twitter.com/MediadeBaud' target='_blank'>@MediadeBaud</a>").addTo(map);
	L.marker([48.07207529213718,-2.9637175798416138], {icon: usages_Icon}).bindPopup("<b>Espace Kenere</b><br />M&eacute;diath&egrave;que de Pontivy<br />34bis, rue du G&eacute;n&eacute;ral de Gaulle<br />56300 PONTIVY<br /><a href='http://www.espace-kenere.fr' target='_blank'>espace-kenere.fr</a> | <a href='http://twitter.com/espacekenere' target='_blank'>@espacekenere</a>").addTo(map);
	L.marker([47.63686981649663,-2.165132761001587], {icon: usages_Icon}).bindPopup("<b>M&eacute;diath&egrave;que d'Allaire</b><br />10, place de l'&Eacute;glise<br />56350 ALLAIRE<br /><a href='http://www.allaire.fr/?page=lmediatheque' target='_blank'>allaire.fr/?page=lmediatheque</a>").addTo(map);
	L.marker([47.883054917498285,-2.833029627799988], {icon: usages_Icon}).bindPopup("<b>M&eacute;diath&egrave;que de Locmin&eacute;</b><br />Place Anne de Bretagne<br />56500 LOCMIN&Eacute;<br /><a href='http://mediatheque.mairie-locmine.fr' target='_blank'>mediatheque.mairie-locmine.fr</a> | <a href='http://twitter.com/bibliolocmine' target='_blank'>@bibliolocmine</a>").addTo(map);
	L.marker([48.04359948853352,-1.616138219833374], {icon: usages_Icon}).bindPopup("<b>Bouillants</b><br />Lieu-dit Les Bouillants<br />35770 VERN-SUR-SEICHE<br /><a href='http://www.bouillants.fr' target='_blank'>bouillants.fr</a> | <a href='http://twitter.com/bouillants' target='_blank'>@bouillants</a>").addTo(map);
	L.marker([48.10535357772494,-1.6746988892555237], {icon: usages_Icon}).bindPopup("<b>4C</b><br />Les Champs-Libres<br />10, cours des Alli&eacute;s<br />35000 RENNES<br /><a href='http://leschampslibres.tumblr.com' target='_blank'>leschampslibres.tumblr.com</a> | <a href='http://twitter.com/LesChampsLibres' target='_blank'>@LesChampsLibres</a>").addTo(map);
	L.marker([47.32585776687383,-2.423413395881653], {icon: usages_Icon}).bindPopup("<b>Cybercentre Guérande</b><br />22, faubourg Saint-Michel<br />44350 GU&Eacute;RANDE<br /><a href='http://www.cybercentre-guerande.fr' target='_blank'>cybercentre-guerande.fr</a> | <a href='http://twitter.com/cyberguerande' target='_blank'>@cyberguerande</a>").addTo(map);

	/* --- FabLab MIT --- */
	L.marker([48.1147067, -1.6772091], {icon: fablabmit_Icon}).bindPopup("<b>LabFab EESAB</b><br />34 rue, Hoche<br />35000 RENNES<br /><a href='http://www.labfab.fr' target='_blank'>labfab.fr</a> | <a href='http://twitter.com/LabFabfr' target='_blank'>@LabFabfr</a>").addTo(map);
	L.marker([47.6424637, -2.7540], {icon: fablabmit_Icon}).bindPopup("<b>FabLab Vannes / MakerSpace 56</b><br />VIPE<br />56000 VANNES<br /><a href='http://twitter.com/fablabvannes' target='_blank'>@fablabvannes</a><br /><a href='http://makerspace56.org' target='_blank'>makerspace56.org</a> | <a href='http://twitter.com/makerspace56' target='_blank'>@makerspace56</a>").addTo(map);
	L.marker([48.4085982,-4.480659], {icon: fablabmit_Icon}).bindPopup("<b>TyFab</b><br />40 rue Jules Lesven<br />29200 BREST<br /><a href='http://tyfab.fr' target='_blank'>tyfab.fr</a> | <a href='http://twitter.com/TyFabBrest' target='_blank'>@TyFabBrest</a>").addTo(map);
	L.marker([48.7319268,-3.4509774], {icon: fablabmit_Icon}).bindPopup("<b>FabLab Lannion KerNEL</b><br />14, rue de Beauchamp<br />22300 LANNION<br /><a href='http://www.fablab-lannion.org' target='_blank'>fablab-lannion.org</a> | <a href='http://twitter.com/fablablannion' target='_blank'>@fablablannion</a>").addTo(map);


	</script>

</body>

</html>
