<!DOCTYPE html>
<html lang="fr">
<head>
<title>Geolocalisation titre</title>
<meta charset="iso-8859-1">
<script 
src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyAVUMCuxzIviXITWu-O5Q04-Fi9B0jvf_s" 
type="text/javascript">
</script>
<script type="text/javascript">
var map;
var geocoder;
function initialisation(){
	map= new Gmap2(document.getElementById("carte"));
	map.setCenter(new( GLatLng(34,0),1);
	geocoder = new GclientGeocoder();
}
function sur_carte(response) {
	map.clearOverLay();
	if(!reponse || response.Status.code != 200) {
		(alert("Désolé nous ne pouvont pas geolocaliser la positon du restaurant.");
	}
	else{
		place= response.Placemark[0];
		point = new GlatLng(place.Point.coordonates[1],
		place.Point.coordinate[0]);
		marker = new Gmarker (point);
		map.setCenter(point,13);
		map.addOverlay(marker);
		}
	}
	function geolocalisation(){
		var adresse = document.form.latitude.value + "," +
		document.form.lon

		
	}
	
		
	}
</script>