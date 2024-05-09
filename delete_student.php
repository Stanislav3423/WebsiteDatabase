<?php
header("Content-Type: application/json");
require "config.php";

function deleteStudent($id, $conn) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt -> bind_param("i", $id);
    $stmt->execute();
    /*if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }*/
}

if($_SERVER['REQUEST_METHOD'] == "POST"){ 
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        if (!empty($id)) {
            deleteStudent($id, $conn);
            $response = array('status' => true);
            $response['id'] = $_POST;
            /*$result = deleteStudent($id, $conn);
            if ($result) {
                $response = array('status' => true);
                $response["id"] = $_POST;
            }
            else {
                $response = array('status' => false);
                $response["id"] = $_POST;
                //error_info(110, "Error umdefi", "id");
            }*/
        } else {
            error_info(106, "Id is empty", "id");
        }
        echo json_encode($response);
    }else{
        error_info(107, "Not exists id", "id");
    }
}