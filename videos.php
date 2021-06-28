<!DOCTYPE html>
<html>
<head>
   <title> Youtube data API V3 integration</title>
   <!-- <link rel="stylesheet" href="bootstarp.min.css"> -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body class="container">

    <div class="container">
        <br/>
        <h1 class="text-center" style="color:blue"> Learn English with EnglishClass101.com  </h1>
        <h4 class="text-center">Discover the absolute best way to get started with English language for absolute beginners! Get the best resources and tools to get on your way to English fluency</h4>
        <br/>
        <br/>
    </div>

    <?php
       
        include "DbConnect.php";
        $db = new DbConnect();
        $conn = $db->connect();


        $stmt = $conn->prepare('SELECT * FROM videos WHERE video_type = 1');
        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='row'>";
        foreach($videos as $video){
            echo "<div class='col-md-6'>";

            echo "<label>".$video['title']."</label>";
        
            echo '<iframe width="570" height="315" src="https://www.youtube.com/embed/'.$video['video_id'].'" 
            title="YouTube video player" 
            frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>';
            echo "</div>";

        }
        echo "</div>";


    ?>


     <div style="position: fixed; bottom: 10px; right:10px; color:green;">
        <strong>
            
        </strong>
     
     </div>
</body>

</html>