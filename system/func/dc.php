<?PHP
//
//-- https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c
//

    function discordmsg($msg, $webhook) {
        if($webhook != "") {
            $ch = curl_init( $webhook );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $msg);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
 
            $response = curl_exec( $ch );
            // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
            echo $response;
            curl_close( $ch );
        }
    }
    $hpname = 'Homepage: '.PAGETITLE.'';
    // URL FROM DISCORD WEBHOOK SETUP
    $webhook = "https://discord.com/api/webhooks/1080240816162885712/yRImaSZYDrzzgAJpT82QnsRI1Ek9AW4JPlyqKAP15xrh0LDBJZkkCQZKEpPpBEVI-72S"; 
    $timestamp = date("c", strtotime("now"));
    $msg = json_encode([
    // Message
    "content" => "Neuer Report ist eingegangen von:",
 
    // Username
    "username" => "Webspell-Reportbot",
 
    // Avatar URL.
    // Uncomment to use custom avatar instead of bot's pic
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",
 
    // text-to-speech
    "tts" => false,
 
    // file_upload
    // "file" => "",
 
    // Embeds Array
    "embeds" => [
        [
            // Title
            "title" => "",
 
            // Embed Type, do not change.
            "type" => "rich",
 
            // Description
            "description" => "",
 
            // Link in title
            "url" => "",
 
            // Timestamp, only ISO8601
            "timestamp" => $timestamp,
 
            // Left border color, in HEX
            "color" => hexdec( "3366ff" ),
 
            // Footer text
            "footer" => [
                "text" => "",
                "icon_url" => ""
            ],
 
            // Embed image
            "image" => [
                "url" => "https://www.webspell-rm.de/includes/plugins/news/images/news-rubrics/1.jpg?size=600"
            ],
 
            // thumbnail
            //"thumbnail" => [
            //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
            //],
 
            // Author name & url
            "author" => [
                "name" => $hpname,
                "url" => $hp_url
            ],
 
            // Custom fields
            "fields" => [
                [
                    "name" => "User",
                    "value" => getnickname($userID),
                    "inline" => false
                ],
                [
                    "name" => "IP",
                    "value" => $GLOBALS['ip'],
                    "inline" => true
                ],
                [
                    "name" => "Meldung",
                    "value" => "Serversystem Offline",
                    "inline" => true
                ]
            ]
        ]
    ]
 
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>