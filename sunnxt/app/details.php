<?php





include('configs.php');





$id = ""; $outputarray = array();





if(isset($_REQUEST['id']))


{


    $id = $_REQUEST['id'];


}





if(!empty($SUNNXT_CHANNELS))


{


    $process_chn = @json_decode($SUNNXT_CHANNELS, true);


    if(!empty($process_chn))


    {


        foreach($process_chn as $sunxc)


        {


            if($id == $sunxc['sid'])


            {


                $outputarray = array('title' => $sunxc['title'], 'logo' => $sunxc['logo'], 'link' => 'app/master.php?id='.$id.'&e=.m3u8');


            }


        }


    }


    if(!empty($outputarray))


    {


        api('success', 200, 'Channels List', $outputarray);


    }


}





api('error', 404, 'Channel Detail Not Found', '');





?>