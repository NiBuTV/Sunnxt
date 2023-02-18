<?php



//error_reporting(0);



function api($status, $code, $msg, $data)

{

    header("Content-Type: application/json");

    if($status == "error"){ $data = array(); }

    if($status !== "success" && $status !== "error")

    {

        http_response_code(500);

        exit('Fatal Error Occured');

    }

    else

    {

        $out = array('status' => $status,

                     'code' => $code,

                     'msg' => $msg,

                     'data' => $data);

        exit(json_encode($out));

    }

}



//---------------------------------------------------------//



$IS_LOGGED_IN_SUN = 0;

$SUNAUTH_LRV_TOKEN = "";

$SUNAUTH_XSFR_TOKEN = "";

$streamenvproto = "http";

$SUNNXT_CHANNELS = '[{"sid":"14020","title":"Sun TV HD","logo":"https://i.postimg.cc/65jLjybq/Sun-TV-HD.png","language":"Tamil","category":"Entertainment"},{"sid":"38926","title":"Sun News","logo":"https://i.postimg.cc/5yGyvdp4/Sun-News.png","language":"Tamil","category":"News"},{"sid":"26566","title":"KTV HD","logo":"https://i.postimg.cc/N0gsKjY8/KTV-HD.png","language":"Tamil","category":"Movies"},{"sid":"9013","title":"Sun Music HD","logo":"https://i.postimg.cc/kGt90VFC/Sun-Music.png","language":"Tamil","category":"Music"},{"sid":"26569","title":"Sun Life","logo":"https://i.postimg.cc/B6Pn0w4R/Sun-Life.png","language":"Tamil","category":"Lifestyle"},{"sid":"9023","title":"Adithya TV","logo":"https://i.postimg.cc/8CWYghxt/Adithya-TV.png","language":"Tamil","category":"Entertainment"},{"sid":"9016","title":"Sun TV","logo":"https://i.postimg.cc/Y2yz8vs9/Sun-TV.png","language":"Tamil","category":"Entertainment"},{"sid":"32138","title":"KTV","logo":"https://i.postimg.cc/7LVgzhzq/KTV.png","language":"Tamil","category":"Movies"},{"sid":"9025","title":"Sun Music","logo":"https://i.postimg.cc/kGt90VFC/Sun-Music.png","language":"Tamil","category":"Music"},{"sid":"14019","title":"Gemini HD","logo":"https://i.postimg.cc/sXM4RyBy/Gemini-HD.png","language":"Telugu","category":"Entertainment"},{"sid":"26570","title":"Gemini Movies HD","logo":"https://i.postimg.cc/1tVwjHT3/Gemini-Movies-HD.png","language":"Telugu","category":"Movies"},{"sid":"26568","title":"Gemini Music HD","logo":"https://i.postimg.cc/Hszc3Rxt/Gemini-Music-HD.png","language":"Telugu","category":"Music"},{"sid":"9027","title":"Gemini Comedy","logo":"https://i.postimg.cc/XYDZ659G/Gemini-Comedy.png","language":"Telugu","category":"Entertainment"},{"sid":"26572","title":"Gemini Life","logo":"https://i.postimg.cc/4dYq2DsH/Gemini-Life.png","language":"Telugu","category":"Lifestyle"},{"sid":"9017","title":"Gemini TV","logo":"https://i.postimg.cc/Z5YfDGLY/Gemini-TV.png","language":"Telugu","category":"Entertainment"},{"sid":"9015","title":"Gemini Movies","logo":"https://i.postimg.cc/VNmzTLVr/Gemini-Movies.png","language":"Telugu","category":"Movies"},{"sid":"9026","title":"Gemini Music","logo":"https://i.postimg.cc/pT9VQcSq/Gemini-Music.png","language":"Telugu","category":"Music"},{"sid":"26574","title":"Surya HD","logo":"https://i.postimg.cc/dtRs9yWP/Surya-HD.png","language":"Malayalam","category":"Entertainment"},{"sid":"9019","title":"Surya Movies","logo":"https://i.postimg.cc/GmpWs8Vj/Surya-Movies.png","language":"Malayalam","category":"Movies"},{"sid":"26575","title":"Surya Music","logo":"https://i.postimg.cc/CKhz8NYQ/Surya-Music.png","language":"Malayalam","category":"Music"},{"sid":"30835","title":"Surya Comedy","logo":"https://i.postimg.cc/BQFN6xqF/Surya-Comedy.png","language":"Malayalam","category":"Entertainment"},{"sid":"9018","title":"Surya TV","logo":"https://i.postimg.cc/B6ycZvkN/Surya.png","language":"Malayalam","category":"Entertainment"},{"sid":"30846","title":"Udaya HD","logo":"https://i.postimg.cc/XvqCZbwP/Udaya-HD.png","language":"Kannada","category":"Entertainment"},{"sid":"26576","title":"Udaya Movies","logo":"https://i.postimg.cc/zGcfcRgd/Udaya-Movies.png","language":"Kannada","category":"Movies"},{"sid":"9022","title":"Udaya Music","logo":"https://i.postimg.cc/Z52TctG2/Udaya-Music.png","language":"Kannada","category":"Music"},{"sid":"9014","title":"Udaya Comedy","logo":"https://i.postimg.cc/m2rBWgRK/Udaya-Comedy.png","language":"Kannada","category":"Entertainment"},{"sid":"9029","title":"Udaya TV","logo":"https://i.postimg.cc/XvqCZbwP/Udaya-HD.png","language":"Kannada","category":"Entertainment"},{"sid":"9014","title":"Udaya Comedy","logo":"https://i.postimg.cc/m2rBWgRK/Udaya-Comedy.png","language":"Kannada","category":"Entertainment"},{"sid":"26567","title":"Chutti TV ","logo":"https://sund-images.sunnxt.com/26567/300x300_c103e59e-217e-44fd-a087-651fcf8e6278.jpg","language":"Kannada","category":"Entertainment"},{"sid":"26577","title":"Chintu TV ","logo":"https://sund-images.sunnxt.com/26577/300x300_4a0f4f2f-e317-4230-9fb6-6169ef66991d.jpg","language":"Kannada","category":"Entertainment"},{"sid":"26571","title":"Kushi TV ","logo":"https://sund-images.sunnxt.com/26571/300x300_d0545f75-f99b-4375-8f42-6120c95fc55c.jpg","language":"Kannada","category":"Entertainment"},{"sid":"26573","title":"Kochu TV ","logo":"https://sund-images.sunnxt.com/26573/300x300_5787336f-08b9-480f-9c97-3db09999b558.jpg","language":"Kannada","category":"Entertainment"},{"sid":"75117","title":"Sun Bangla","logo":"https://sund-images.sunnxt.com/75117/200x200_4b19b530-f0bb-4b26-a9de-f3cdd5f8be20.jpg","language":"Bengali","category":"Entertainment"}]';





if(file_exists('authdata/xsrf_token'))

{

    $GET_SUNAUTH_XSFR_TOKEN = @file_get_contents('authdata/xsrf_token');

    if(!empty($GET_SUNAUTH_XSFR_TOKEN))

    {

        $SUNAUTH_XSFR_TOKEN = $GET_SUNAUTH_XSFR_TOKEN;

    }

}



if(file_exists('authdata/laravel_session'))

{

    $GET_SUNAUTH_LRV_TOKEN = @file_get_contents('authdata/laravel_session');

    if(!empty($GET_SUNAUTH_LRV_TOKEN))

    {

        $SUNAUTH_LRV_TOKEN = $GET_SUNAUTH_LRV_TOKEN;

    }

}



if(!empty($SUNAUTH_LRV_TOKEN) && !empty($SUNAUTH_XSFR_TOKEN))

{

    $IS_LOGGED_IN_SUN = 1;

}



if(isset($_SERVER['HTTPS']))

{

    if($_SERVER['HTTPS'] == "on")

    {

        $streamenvproto = "https";

    }

}



if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']))

{

    if($_SERVER['HTTP_X_FORWARDED_PROTO'] == "https")

    {

        $streamenvproto = "https";

    }

}



$local_ip = getHostByName(php_uname('n'));

if($_SERVER['SERVER_ADDR'] !== "127.0.0.1"){ $plhoth = $_SERVER['HTTP_HOST']; }else{ $plhoth = $local_ip; }





?>