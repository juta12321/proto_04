<?php
// DB接続
$dbn ='mysql:dbname=gsacy_d01_10;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}


// SQL作成&実行1(悪いゴミステーション)------------------------------------
//----------------------------------------------------------------------
$sql = "SELECT * FROM proto_3_table WHERE score = 1";

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "

    { lat: {$record["lat"]},lng: {$record["lng"]},date: {$record["date"]},score: {$record["score"]}},
  ";  
  
};


// SQL作成&実行2(良いゴミステーション)------------------------------------
//----------------------------------------------------------------------
$sql_good="SELECT * FROM proto_3_table WHERE score = 0";

$stmt_good = $pdo->prepare($sql_good);

try {
  $status_good = $stmt_good->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result_good = $stmt_good->fetchAll(PDO::FETCH_ASSOC);
$output_good = "";
foreach ($result_good as $record_good) {
  $output_good .= "
    { lat: {$record_good["lat"]},lng: {$record_good["lng"]},date: {$record_good["date"]}},
  ";
}



// //緯度(lat)の出力
// $result_lat = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $output_lat = "";
// foreach ($result_lat as $record_lat) {
//   $output_lat .= "
//     <tr>
//       <td>{$record_lat["lat"]}</td>     
//     </tr>
//   ";
// }

// //緯度(lng)の出力
// $result_lng = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $output_lng = "";
// foreach ($result_lng as $record_lng) {
//   $output_lng .= "
//     <tr>
//       <td>{$record_lng["lng"]}</td>     
//     </tr>
//   ";
// }




?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>一覧画面</title>
</head>

<body>

  <h1>ゴミステーションの状態で治安を確認！(閲覧)</h1>

      <!-- 住所入力 -->
    <span>住所を入力してください。</span><br>
    <input type="text" id="addressInput" placeholder="山口県周南市遠石">
    <button id="searchGeo">検索</button>
    <div>
        <input type="hidden" id="lat" name="lat_geo">
        <input type="hidden" id="lng" name="lng_geo">
    </div>
    

    <div id="map" style="width:100%;height:650px;margin-top:10px"></div>


    <script
        src="https://maps.googleapis.com/maps/api/js?key=【key】&callback=initMap&v=weekly"
        async>
    </script>
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- <legend>一覧画面</legend> -->
    <div style="text-align:center;margin-top:10px">
      <a href="proto_4_input.php">-管理画面-</a>
    </div>
    
    <table>

      <!--<thead>
        <tr>
          <th>date</th>
          <th>lat</th>
          <th>lng</th>
          <th>score</th>
        </tr>
      </thead>

      <tbody>
         ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る 
          <?= $output_good ?>
      </tbody>
    </table>
    -->
 



    <script>    
      //表示位置の定義(悪いゴミステーション)
      const data = [
        <?= $output ?>
      ];
       
      //表示位置の定義(良いゴミステーション)
      const data2 = [
        <?= $output_good ?>
      ];





      function initMap() {

        //指定した位置情報を中心にマップを表示
        let map;
        map = new google.maps.Map(document.getElementById("map"), {
        
        center: {
            lat: 39.05240000, lng: 136.82900000,
          },

          zoom: 5.5  ,
          radius: 5,

        });


        //検索ボタンを押したらその場所を中心に地図表示

        //郵便番号から位置情報検索
        $('#searchGeo').on('click', function getLatLng() {

          // 入力した住所を取得します。
          var addressInput = document.getElementById('addressInput').value;

          // Google Maps APIのジオコーダを使います。
          var geocoder = new google.maps.Geocoder();

          // ジオコーダのgeocodeを実行します。
          // 第１引数のリクエストパラメータにaddressプロパティを設定します。
          // 第２引数はコールバック関数です。取得結果を処理します。
          geocoder.geocode(
            {
              address: addressInput
            },
            
            function (results, status)
            {
             console.log(results, status)
             var latlng = "";
             if (status == google.maps.GeocoderStatus.OK)
             {
                // 取得が成功した場合
                // 結果をループして取得します。
                for (var i in results)
                {
                  if (results[i].geometry)
                  {
                    // 緯度を取得します。
                    var lat = results[i].geometry.location.lat();
                    // 経度を取得します。
                    var lng = results[i].geometry.location.lng();
                    // val()メソッドを使ってvalue値を設定できる
                    // idがlat(またはlng)のvalue値に、変数lat(またはlng)を設定する

                    $('#lat').val(lat);
                    $('#lng').val(lng);


                    let map;
                    map = new google.maps.Map(document.getElementById("map"), {
                    
                    center: {
                        lat:lat , lng: lng,
                      },

                      zoom: 16  ,
                      radius: 5,

                    });


        //悪いゴミステーションのマッピング
          data.map(d => {
          // マーカーをつける(悪い方)
            const marker = new google.maps.Marker({

              position: { lat: d.lat, lng: d.lng },
                map: map,

                icon: {
                  url: "img/circle_red.png",
                  scaledSize: new google.maps.Size(45, 45)
                }

            });
            //クリックしたら情報を表示
            const infoWindow = new google.maps.InfoWindow({
	      	    content:"緯度:"+JSON.stringify(d.lat)+"<br>"+"経度:"+JSON.stringify(d.lng)+"<br>"+"調査日:"+d.date+"<br>"+"状態:"+d.score 
        	  });
          
	          google.maps.event.addListener(marker, 'click', function() { //マーカークリック時の動作
	      	    infoWindow.open(map, marker); //情報ウィンドウを開く
        	  });

          });
    

         data2.map(d2 => {
           // マーカーをつける(良い方)
           const marker2 = new google.maps.Marker({

           position: { lat: d2.lat, lng: d2.lng },
              map: map,
              icon: {
                url: "img/circle_green.png",
                scaledSize: new google.maps.Size(45, 45)
              }
            });

            //クリックしたら情報を表示
            const infoWindow = new google.maps.InfoWindow({
	      	    content:"緯度:"+JSON.stringify(d2.lat)+"<br>"+"経度:"+JSON.stringify(d2.lng)+"<br>"+"調査日:"+d2.date+"<br>"+"状態:"+d2.score //情報ウィンドウのテキスト
        	  });

	          google.maps.event.addListener(marker2, 'click', function() { //マーカークリック時の動作
              
	      	    infoWindow.open(map, marker2); //情報ウィンドウを開く

        	  });


          });
                  























                    // そもそも、ループを回して、検索結果にあっているものをiに入れていっているため
                    // 精度の低いものもでてきてしまう。その必要はないから、一回でbreak               
                      break;
                  }
                }
                } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS)
                { alert("住所が見つかりませんでした。");
                } 
                else if (status == google.maps.GeocoderStatus.ERROR)
                {alert("サーバ接続に失敗しました。");
                }
                else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) 
                {alert("リクエストが無効でした。");
                }
                else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                alert("リクエストの制限回数を超えました。");
                    }
                  else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
                    alert("サービスが使えない状態でした。");
                  }
                else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
                alert("原因不明のエラーが発生しました。");
                            }
                        })




           

              

          });












      };
    </script>

</body>

</html>