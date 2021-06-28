<!DOCTYPE html>
<html>
<head>
   <title> Youtube data API V3 integration</title>
   <!-- <link rel="stylesheet" href="bootstarp.min.css"> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h2 class="text-center"> youtube data api v3 </h2>
    </div>

    <?php
       
        /*besoin de la connexion de la base*/
        include "DbConnect.php";
        $db = new DbConnect();
        $conn = $db->connect();

        $key= "AIzaSyClxeK8LEtDmiUGTudoxBtqnLfj3rir6j0";
        $base_url="https://www.googleapis.com/youtube/v3/";
        $channelId = "UCeTVoczn9NOZA9blls3YgUg" ;
        $maxResult= 5;
        $video_type= !isset($_GET['vtype'] ) ? 1 : 2 ;


        // $API_URL = $base_url."search?order=date&part=snippet&channelId=".$channelId."&maxResults=".$maxResult."&key=".$key;
        // $API_URL = $base_url."playlists?order=date&part=snippet&channelId=".$channelId."&maxResults=".$maxResult."&key=".$key;

        if( $video_type == 1)
        {
            $API_URL = $base_url."search?order=date&part=snippet&channelId=".$channelId."&maxResults=".$maxResult."&key=".$key;
            getVideos($API_URL);
        } else {
            $API_URL = $base_url."playlists?order=date&part=snippet&channelId=".$channelId."&maxResults=".$maxResult."&key=".$key;
            getPlaylists($API_URL);
        }


        function getPlaylists($API_URL){
            global $conn ;

            $playlists = json_decode (file_get_contents ($API_URL)) ;
            foreach($playlists->items as $video) {

                $sql = "INSERT INTO `videos` (`id`, `video_type`, `video_id`, `title`, `thumbnail_url`, `published_at`) VALUES (NULL, 2, :vid, :title,:turl, :pdate)" ;

                $stmt = $conn->prepare($sql) ; 
                $stmt->bindParam(':vid', $video->id ) ;
                $stmt->bindParam(':title', $video->snippet->title ) ;
                $stmt->bindParam(':turl', $video->snippet->thumbnails->high->url ) ;
                $stmt->bindParam(':pdate', $video->snippet->publishedAt ) ;

                $stmt->execute() ; 
                

            } 
        }

        //  echo "<pre>";
        // print_r($playlists) ;
        function getVideos($API_URL) {
            global $conn ;

            $videos = json_decode (file_get_contents ($API_URL)) ;
    
            foreach($videos->items as $video) {

                $sql = "INSERT INTO `videos` (`id`, `video_type`, `video_id`, `title`, `thumbnail_url`, `published_at`) VALUES (NULL, 1, :vid, :title,:turl, :pdate)" ;

                $stmt = $conn->prepare($sql) ; 
                //$stmt->bindParam(":vtype", 1 ) ; 
                $stmt->bindParam(':vid', $video->id->videoId ) ;
                $stmt->bindParam(':title', $video->snippet->title ) ;
                $stmt->bindParam(':turl', $video->snippet->thumbnails->high->url ) ;
                $stmt->bindParam(':pdate', $video->snippet->publishedAt ) ;

                $stmt->execute() ; 

            }

        }

    ?>


     <div style="position: fixed; bottom: 10px; right:10px; color:green;">...
     
     </div>
</body>

</html>