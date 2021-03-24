<?php
    include '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_access = $_POST['hash_useracces'];
        $level_user = $_POST['level'];

        $querysearch_user = mysqli_query($_AUTH, "SELECT * FROM tbl_user WHERE username = '$username' AND password = MD5('$password') AND 
        hash_useracces = SHA1('$hash_access') AND level = '$level_user'");
        $_response = array();
        $execute_querylogin = mysqli_num_rows($querysearch_user);

        $cari_iduser = "SELECT id_user FROM tbl_user WHERE username = '$username'";
        $execute_cariiduser = mysqli_query ($_AUTH, $cari_iduser);
        $getid_user = mysqli_fetch_assoc ($execute_cariiduser);
        $id_user_result = $getid_user['id_user'];

        if ($execute_querylogin > 0 ){
            $get_idnotes = $_POST['id_notes']; 

            $query_searchdata = "SELECT COUNT(*) total_data FROM tbl_notes WHERE id_notes = $get_idnotes";
            $execute_searchdata = mysqli_query($_AUTH, $query_searchdata);
            $get_availabledata = mysqli_fetch_assoc($execute_searchdata);

            if($get_availabledata['total_data'] > 0) {

                $query_deletedatanote = "DELETE FROM tbl_notes WHERE id_notes = $get_idnotes";
                $execute_deleteddata = mysqli_query($_AUTH, $query_deletedatanote);
            
                $response['message'] = "Data notes dengan id $get_idnotes berhasil dihapus dari database";
                $response['code'] = 201;
                $response['status'] = true;
                
                echo json_encode($response);
            }else{
                $response['message'] = "Data notes dengan id $get_idnotes gagal terhapus dari database, karna data tidak tersedia";
                $response['code'] = 404;
                $response['status'] = false;
                
                echo json_encode($response);
            }
        }else{
            
            $response["message"] = trim("Autentikasi gagal, Cek kembali user credential anda.");
            $response["code"] = 401;
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