<?php
    include '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $search_username = $_POST['username'];

        $cariusername = mysqli_query ($_AUTH, "SELECT COUNT(username) 'totaldata' FROM tbl_user WHERE username = '$search_username'");
        $exe_cariusername = mysqli_fetch_assoc($cariusername);

        if($exe_cariusername['totaldata'] == 0) {
            $key = $_POST ['password'];
            $hashuser = $_POST ['hash_useracces'];
            $leveluser = $_POST ['level'];

            $tambah_user = mysqli_query ($_AUTH, "INSERT INTO tbl_user (username, password, hash_useracces, level) VALUES ('$search_username', MD5('$key'), SHA1('$hashuser'), '$leveluser')");

            $detect_user = mysqli_query($_AUTH, "SELECT COUNT(username) 'useradded' FROM tbl_user WHERE username = '$search_username'");
            $fetch_detect = mysqli_fetch_assoc ($detect_user);

            if($fetch_detect ['useradded'] >= 0){

                $fielddata = mysqli_query ($_AUTH, "SELECT id_user, username, password, hash_useracces, level, datauser_create FROM tbl_user WHERE username = '$search_username'");

                $response["message"] = "User dengan name " . $search_username . " berhasil ditambahkan kedalam database";
                $response["code"] = 200;
                $response["status"] = true;
                $response["userbaru"] = array();

                while($row = mysqli_fetch_array($fielddata)){
                    $data = array();

                    $data['id_user'] = $row['id_user'];
                    $data['username'] = $row['username'];
                    $data['password'] = $row['password'];
                    $data['hash_useracces'] = $row['hash_useracces'];
                    $data['level'] = $row['level'];
                    $data['datauser_create'] = $row['datauser_create'];

                    array_push($response['userbaru'], $data);
                }
                echo json_encode($response);

            }
        }else{
            $response["message"] = "Imposible / tidak memungkinkan menambahkan username ini kedalam database, karena data tersedia didatabase";
            $response["code"] = 400;
            $response["status"] = false;

            echo json_encode($response);
        }
    
        
    }else{
        
        $response["message"] = trim("Oops! Sory, Request API ini membutuhkan parameter!.");
        $response["code"] = 400;
        $response["status"] = false;

        echo json_encode($response); 
    }
?>
