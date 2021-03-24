<?php

    $_HOST = "localhost";
    $_USERDB = "root";
    $_PASSDB = "";
    $_DBNAME = "db_notes";

    $_AUTH = mysqli_connect($_HOST, $_USERDB, $_PASSDB, $_DBNAME);

    if ($_AUTH) {
        // echo json_encode(
        //     array(
        //         "message" => "Congratulation!, your connection is successfully. To database " . $_DBNAME,
        //         "code" => 200,
        //         "status" => true
        //     )
        // );
    } else {
        // echo json_encode(
        //     array(
        //         "message" => "Sorry!, your connection is FAILED. To database " . $_DBNAME,
        //         "code" => 408,
        //         "status" => false
        //     )
        // );
    }

?>