<!doctype html>


<html lang="en">


<head>


<meta charset="utf-8">


<meta name="viewport" content="width=device-width, initial-scale=1">


<title>LiveTV | Sunnxt Global</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" />


<link rel="shortcut icon" href="https://sunnxt.com/favicon.ico" />


<style>


body


{


    color: #FFFFFF;


    background-color: black;


}


@media (min-width:1025px) {


    .row


    {


    overflow: hidden;


    margin-left: 12px;


    margin-right: 12px;


}


}





.card-body


{


    text-align: center;


}





.card


{


    margin-bottom: 8px;


}


</style>


</head>


<body>





<nav class="navbar bg-light"><div class="container-fluid"><span class="navbar-brand mb-0 h1">&nbsp;SUNNXT GLOBAL </span><a href="app" class="btn btn-danger btn-sm"> Login </a></div></nav>








<div class="row mt-4" id="tv_catalouge"></div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>


<script>


get_channels();





function get_channels()


{


    $.ajax({


        "url": "app/channels.php",


        "type": "GET",


        "success":function(data)


        {


            try { data = JSON.parse(data); }catch(err){}


            if(data.status == "success")


            {


                sessionStorage.setItem("sunLogin", data.data.is_logged_in);


                let uere = "";


                $.each(data.data.channels, function(k, v){


                    uere = uere + '<div class="col-6 col-sm-4 col-lg-3 col-xl-2" data-cid="' + v.sid +'" onclick="opentv(this)">';


                    uere = uere + '<div class="card"><img src="' + v.logo + '" class="card-img-top" width="140" height="130" alt="' + v.title + '" />';


                    uere = uere + '<div class="card-body">';


                    uere = uere + '<h5 class="card-title" style="color: #000000;">' + v.title + '</h5>';


                    uere = uere + '</div></div></div>';


                });


                $("#tv_catalouge").html(uere);


            }


            else


            {


                alert("No Channels Found");


            }


        },


        "error":function(data)


        {


            alert("Failed To Get Channels List");


        }


    });


}





function opentv(e)


{


    let loginstatus = sessionStorage.getItem("sunLogin");


    let channel_id = $(e).attr("data-cid");


    if(loginstatus !== 1 && loginstatus !== "1")


    {


        alert("Please Login To Sunnxt Account To Watch");


    }


    else


    {


        window.location = "sun.php?id=" + channel_id;


    }


}


</script>


</body>


</html>