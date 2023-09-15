( function( $ ) {
	
	"use strict";
	
	var mapCenter;
	var map;	
	var mapInfo_Zoom = Number( $( '#mapInfo_Zoom' ).html() );
	var mapInfo_coorN = $( '#mapInfo_coorN' ).html();
	var mapInfo_coorE = $( '#mapInfo_coorE' ).html();
  
	function initialize() {
		
		mapCenter = new google.maps.LatLng( mapInfo_coorN, mapInfo_coorE );
		
		var marker = new google.maps.Marker( {
										
			position: mapCenter
			
		} );
		
		var mapProp = {
			
			center: mapCenter,
			zoom: mapInfo_Zoom,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			panControl: false,
			zoomControl: false,
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			overviewMapControl: false,
			rotateControl: false,
			scrollwheel: false
		
		};
		
		map = new google.maps.Map( document.getElementById( 'googleMap' ), mapProp );
		marker.setMap( map );
	
	}
	
	google.maps.event.addDomListener( window, 'load', initialize );
  
} ) ( jQuery );