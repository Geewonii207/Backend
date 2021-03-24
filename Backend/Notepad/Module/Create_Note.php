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

            $title_note = $_POST['titleof_notes'];
            $content_note = $_POST['contentof_notes'];
            $category_note = $_POST['categoryof_notes'];
            
            $query_tambahnotes = "INSERT INTO tbl_notes (titleof_notes, contentof_notes, id_user, categoryof_notes) VALUES 
            ('$title_note','$content_note', $id_user_result, '$category_note')";
            $execute_addnote = mysqli_query($_AUTH, $query_tambahnotes);

            if($execute_addnote){
                $query_listdatanotes = "SELECT * FROM tbl_notes ORDER BY id_notes ASC";
                $execute_listdatanotes = mysqli_query ($_AUTH, $query_listdatanotes);

                $query_totaldatanote = "SELECT COUNT(*) 'total_notes' FROM tbl_notes";
                $execute_totalnote = mysqli_query ($_AUTH, $query_totaldatanote);
                $get_totalnotes = mysqli_fetch_assoc ($execute_totalnote);

                $response ['Message'] = "Data Berhasil Di Tampilkan";
                $response ['Code'] = 200;
                $response ['Status'] = true;
                $response ['Total Notes'] = $get_totalnotes ['total_notes'];
                $response ['DataNotes'] = array();

                while($row = mysqli_fetch_array($execute_listdatanotes)) {
                    $data = array();

                    $data['titleof_notes'] = $row['titleof_notes'];
                    $data['contentof_notes'] = $row['contentof_notes'];
                    $data['date_created'] = $row['date_created'];
                    $data['id_user'] = $row['id_user'];
                    $data['categoryof_notes'] = $row['categoryof_notes'];

                    array_push($response['DataNotes'], $data);
                }
                echo json_encode($response);
            }else{
                $response["message"] = trim("Data gagal diTambahkan.");
                $response["code"] = 401;
                $response["status"] = false;
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
        $response["code"] = 401;
        $response["status"] = false;

        echo json_encode($response); 
    }

    
?>