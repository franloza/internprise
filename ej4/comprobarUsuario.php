<?php
$user = $_GET['user'];
$userStatus = "disponible" ;
if (isset($user)) {
    if ($user === "pablo" ) {
        $userStatus = "existe";
    }
}
echo json_encode(array("userStatus"=>$userStatus));