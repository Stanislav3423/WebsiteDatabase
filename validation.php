<?php
header("Content-Type: application/json");
require "config.php";

function addStudent($group, $firstName, $secondName, $gender, $birthday, $status, $conn) {
    $stmt = $conn->prepare("INSERT INTO students (idGroup, firstName, secondName, idGender, birthday, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt-> bind_param("issisi", $group, $firstName, $secondName, $gender, $birthday, $status);
    $stmt->execute();
}

function editStudent($id, $group, $firstName, $secondName, $gender, $birthday, $status, $conn) {
    $stmt = $conn->prepare("UPDATE students SET idGroup=?, firstName=?, secondName=?, idGender=?, birthday=?, status=? WHERE id=?");
    $stmt-> bind_param("issisii", $group, $firstName, $secondName, $gender, $birthday, $status, $id);
    $stmt->execute();
}

function error_info($code, $message, $type) {
    $response["status"] = false;
    $response["error"]["code"] = $code;
    $response["error"]["message"] = $message;
    $response["error"]["type"] = $type;
    echo json_encode($response);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['group']) || !isset($arrGroup[$_POST['group']])) {
        error_info(101, "Choose group from list", "group");
    }
    if (empty($_POST['firstname'])) {
        error_info(102, "Input first name", "first-name");
    }
    if (empty($_POST['lastname'])) {
        error_info(103, "Input last name", "last-name");
    }
    if (empty($_POST['gender']) || !isset($arrGender[$_POST['gender']])) {
        error_info(104, "Choose gender from list", "gender");
    }
    if (empty($_POST['birthday'])) {
        error_info(105, "Choose date of birth calendar", "birth");
    }

    $response["status"] = true;

    $id = $_POST['id'];
    $group = $conn->real_escape_string($_POST['group']);
    $firstName = $conn->real_escape_string($_POST['firstname']);
    $secondName = $conn->real_escape_string($_POST['lastname']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $status = $conn->real_escape_string($_POST['status']);
    $status = ($status === 'true') ? 1 : 0;

    if (empty($id)) {
        addStudent($group, $firstName, $secondName, $gender, $birthday, $status, $conn);
        $id = mysqli_insert_id($conn);
    } else {
        editStudent($id, $group, $firstName, $secondName, $gender, $birthday, $status, $conn);
    }

    $response["id"] = $id;
    $response["user"] = $_POST;
    echo json_encode($response);
    exit;
}
echo "Requested resource is forbidden";