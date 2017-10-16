<?php

include 'utils/utils.php';

if (isset($_GET['params'])) {
    $params = explode("/", $_GET['params']);

//    if (strcasecmp($params[0], 'github') === 0
//        && strcasecmp($params[1], 'cgcu-website') === 0
//    ) {
//        header('LOCATION:https://github.com/CGCU/cgcu-website/');
//        die();
//    }
//
//    if (strcasecmp($params[0], 'wie-photos') === 0) {
//        header('LOCATION:https://www.dropbox.com/sh/qsl6qk178g7xxie/AABrOxURANSl6abx4yEA53tEa?dl=0');
//        die();
//    }

    var_dump($params);

} else {
    send404();
}

?>
