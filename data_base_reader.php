<?php
include "config.php";

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $student) {
        addStudent($student, $arrGroup, $arrGender);
    }
}

function addStudent($student, $arrGroup, $arrGender) {
    $newRow = '<tr data-id="' . $student['id'] . '">
                <td><input type="checkbox" class="table-input"></td>
                <td data-value="' . $student['idGroup'] . '">' . $arrGroup[$student['idGroup']] . '</td>
                <td>' . $student['firstName'] . ' ' . $student['secondName'] . '</td>
                <td data-value="' . $student['idGender'] . '">' . $arrGender[$student['idGender']] . '</td>
                <td>' . transformDateForTable($student['birthday']) . '</td>
                <td><i class="bi bi-circle-fill status ' . ($student['status'] ? 'active' : '') . '"></i></td>
                <td>
                    <div class="d-flex justify-content-center align-items-center mx-auto">
                        <button class="btn-icon me-2 add-edit-button" data-id="' . $student['id'] . '">
                            <i class="bi bi-pencil table-icons"></i>
                        </button>
                        <button class="btn-icon delete-students-row-button" data-id="' . $student['id'] . '">
                            <i class="bi bi-x-lg table-icons"></i>
                        </button>
                    </div>
                </td>';

    echo $newRow;
}

function transformDateForTable($dateString) {
    $parts = explode("-", $dateString);
    return $parts[2] . "." . $parts[1] . "." . $parts[0];
}
?>