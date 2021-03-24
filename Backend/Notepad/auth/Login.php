<?php

    include '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cekusername = $_POST['username'];
        $cekpassword = $_POST['password'];

        $proses_login = mysqli_query ($_AUTH, "SELECT id_user, username, password, hash_useracces, level, datauser_create FROM tbl_user WHERE username = '$cekusername' AND password = MD5('$cekpassword')";
        $getfieldlogin = mysqli_fetch_assoc($proseslogin);

        $exist_user = mysqli_query ($_AUTH, "SELECT COUNT(*) 'total' FROM tbl_user WHERE username = '$cekusername' AND password = MD5('$cekpassword')";
        $total_data = mysqli_fetch_assoc ($exist_user);

        if($total_data ['total'] == 0){
            $response["message"] = "Maaf, Anda gagal melakukan login kedalam aplikasi, silahkan cek user credensial anda!";
            $response["code"] = 400;
            $response["status"] = false;
            
            echo json_encode($response); 

        }else{
            $passwd = $getfieldlogin['password'];
            $hashwd = $getfieldlogin['hash_useracces'];
            $lvlwd = $getfieldlogin['level'];
            
            $cek_authentikasi = mysqli_query($_AUTH, "SELECT COUNT(*) 'existuser' FROM tbl_user WHERE username = '$cekusername' AND password = '$passwd' AND hash_useracces = '$hashwd' AND level = '$lvlwd'");
            $requireauth = mysqli_fetch_assoc($cek_authentikasi);
            
            if ($requireauth['existuser'] == 0) {
            } else {
                $response["message"] = "Congratulation! Anda berhasil login atas nama " .$cekusername;
                $response["code"] = 200;
                $response["status"] = true;
    
                $response["id"] = $getfieldlogin['id_user'];
                $response["user"] = $getfieldlogin['username'];
                $response["pass"] = $getfieldlogin['password'];
                $response["hash"] = $getfieldlogin['hash_useraccess'];
                $response["level"] = $getfieldlogin['level'];
                $response["created_at"] = $getfieldlogin['dateuser_created'];
            
                echo json_encode($response);
            }
        }

    }else{
        $response["message"] = trim("Oops! Sory, Request API ini membutuhkan parameter!.");
        $response["code"] = 400;
        $response["status"] = false;

        echo json_encode($response); 
    }
?>