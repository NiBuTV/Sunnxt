<?php

include('configs.php');

if(isset($SUNNXT_CHANNELS) && !empty($SUNNXT_CHANNELS))
{
    $process_chn = @json_decode($SUNNXT_CHANNELS, true);
    if(!empty($process_chn))
    {
        api('success', 200, 'Channels List', array('is_logged_in' => $IS_LOGGED_IN_SUN, 'channels' => $process_chn));
    }
}

api('error', 404, 'No Channels Found', '');

?>