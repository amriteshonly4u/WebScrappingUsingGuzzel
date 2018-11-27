<!DOCTYPE html>
<html>
<head>
    <title>My Rss Reader</title>
</head>
<body>
    <form>
        Enter feed URL here: <input type="text" name="feed_url1" value="https://www.whatismybrowser.com/">
        <input type="submit" name="submit" value="submit">
    </form>
    <?php
        if(isset($_REQUEST['feed_url1'])){
            echo "feed_urlstat";
            require './vendor/autoload.php';
            $myClient  = new GuzzleHttp\Client([
                'headers' => ['User-Agent'=>'MyReader']
            ]);
            $feed_response = $myClient->request('GET',$_REQUEST['feed_url1']);
            if($feed_response->getStatusCode() == 200){
                if($feed_response->hasHeader('content-length')){
                    $contentLength = $feed_response->getHeader('content-length')[0];
                    echo "<p Downloaded $contentLength bytes of data. </p>";
                }
                $body = $feed_response->getBody();
                echo "$body";
                // $xml = new SimpleXMLElement($body);
                // // var_dump($xml);
                // foreach ($xml->channel->item as $key => $item) {
                //     echo "<h3>" .$item->title ."</h3>";
                //     echo "<p>"  .$item->description."</p";
                // }
            } 
        }
    ?>
</body>
</html>