<!DOCTYPE html>
  <html lang="ja">
  <head>
    <title>レストラン検索</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
      function do_submit(){
        $('<input>').attr({
          name: 'lat',
          type: 'text',
          value: pos['lat']
        }).appendTo('#target_id');
        $('<input>').attr({
          name: 'lon',
          type: 'text',
          value: pos['lng']
        }).appendTo('#target_id');
        document.forms['postresult'].submit();
      }
      </script>
  </head>
  <body>
    <h1>レストラン検索ページ</h1>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var geocoder = new google.maps.Geocoder();
      var pos = [];
      geocoder.geocode(
          { address: 'tokyo' },
          function( results, status )
          {
              if( status == google.maps.GeocoderStatus.OK )
              {
                  alert( results[ 0 ].geometry.location );
              }
              else
              {
                  alert( 'Faild：' + status );
              }
          } );

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 16
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // geocode

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }

     </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5eKBrtbRY8ohoiYMkM9zyKI38VzO5C3o&callback=initMap">
    </script>

    <section>
      <form action="result.php" method="post" name="postresult">
        <div id = "target_id">

           範囲
           <select name = "range">
            <option value="1">300m以内</option>
            <option value="2">500m以内</option>
            <option value="3">1km以内</option>
            <option value="4">2km以内</option>
            <option value="5">3km以内</option>
            <input type="button" value="送信" onClick="do_submit();" />


         </div>
      </form>
  </section>
  <br>
  <br>
  <center>
      <a href="http://api.gnavi.co.jp/api/scope/" target="_blank">
      <img src="http://api.gnavi.co.jp/api/img/credit/api_265_65.gif" width="265" height="65" border="0" alt="グルメ情報検索サイト　ぐるなび">
      </a>
  </center>
  </body>
</html>
