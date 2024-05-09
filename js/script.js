const table = $('.students-table');

let Student = function() {
    this.id = "";
    this.group = "";
    this.firstname = "";
    this.lastname = "";
    this.gender = "";
    this.birthday = "";
    this.status = false;
};

$(document).ready(function() {
    $(window).on('load', async function() {
        if ('serviceWorker' in navigator) {
            try {
                await navigator.serviceWorker.register('sw.js');
                console.log("Correct registration");
            } catch (e) {
                console.log("Service work fail");
            }
        }
    });

    $('#student-form').submit(function(event) {
        event.preventDefault();
        let student = new Student();
        student.id = $('#id').val();
        student.group = $('#group').val();
        student.firstname = $('#first-name').val();
        student.lastname = $('#last-name').val();
        student.gender = $('#gender').val();
        student.birthday = $('#birth').val();
        student.status = $('#status').prop('checked');

        let json = JSON.stringify(student);
        console.log(json);

        addEditStudent(student);
    });

    $('#delete-submit').click(function(event) {
        let id = $('#deleteId').val();
        deleteStudent(id);
    });

    $('.functional-part').on('click', 'button', function(event) {
        let button = $(event.target).closest('button');
        if (button.hasClass('add-edit-button')) {
            openEditAddModal(button);
        } else if (button.hasClass('delete-students-row-button')) {
            openDeleteModal(button);
        }
    });

    function openEditAddModal(button) {
        clearValidation();
        let student = new Student();
        let title = "Add student";
        let button_text = "Add";

        if (button.data('id') !== "") {
            title = "Edit student";
            button_text = "Edit";
            let tr = button.closest('tr');
            let columns = tr.find('td');
            let isActive;
            columns.each(function() {
                if ($(this).find('i.status').length) {
                    isActive = $(this).find('i.status').hasClass('active');
                }
            });

            student.id = tr.data("id");
            student.group = columns.eq(1).data("value");
            let name = columns.eq(2).text().split(" ");
            student.firstname = name[0];
            student.lastname = name[1];
            student.gender = columns.eq(3).data("value");
            student.birthday = columns.eq(4).text();
            student.status = isActive;
        }

        $('#id').val(student.id ? student.id : "");
        $('#group').val(student.group);
        $('#first-name').val(student.firstname ? student.firstname : "");
        $('#last-name').val(student.lastname ? student.lastname : "");
        $('#gender').val(student.gender);
        $('#birth').val(student.birthday ? transformDateForModal(student.birthday) : "");
        $('#status').prop('checked', student.status);

        $('#add-edit-submit').text(button_text);
        $('#ModalLabel').text(title);
        let modal = new bootstrap.Modal(document.getElementById('student-modal'));
        modal.show();
    }

    function clearValidation() {
        $('.is-invalid').removeClass('is-invalid');
    }

    function addEditStudent(student) {
        console.log(student);
        $.ajax({
            url: 'validation.php',
            type: 'POST',
            data: student,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                clearValidation();
                if (data.status) {
                    if (student.id === "") {
                        student.id = data.id;
                        addStudent(student);
                    } else {
                        editStudent(student);
                    }
                    let model = bootstrap.Modal.getInstance(document.getElementById("student-modal"));
                    model.hide();
                } else {
                    $('#' + data.error.type).addClass("is-invalid");
                }
            },
            error: function(xhr, status, error) {
                console.error(status + ': ' + error);
                console.log(xhr.responseText);
            }
        });
    }
});

function addStudent(student) {
    let newRow = $('<tr></tr>').attr("data-id", student.id);
    let status;
    if (student.status) {
        status = '<i class="bi bi-circle-fill status active"></i>';
    } else {
        status = '<i class="bi bi-circle-fill status"></i>';
    }
    newRow.html(
        `<td><input type="checkbox" class="table-input"></td>
        <td data-value="${student.group}">${$('#group option[value="' + student.group + '"]').text()}</td>
        <td>${student.firstname + " " + student.lastname}</td>
        <td data-value="${student.gender}">${$('#gender option[value="' + student.gender + '"]').text()}</td>
        <td>${transformDateForTable(student.birthday)}</td>
        <td>${status}</td>
        <td>
            <div class="d-flex justify-content-center align-items-center mx-auto">
                <button class="btn-icon me-2 add-edit-button" data-id="${student.id}">
                    <i class="bi bi-pencil table-icons"></i>
                </button>
                <button class="btn-icon delete-students-row-button" data-id="${student.id}">
                    <i class="bi bi-x-lg table-icons"></i>
                </button>
            </div>
        </td>`
    );
    table.find('tbody').append(newRow);
}

function getRowByDataAttribute(attname, attvalue) {
    return table.find('tr[data-' + attname + '="' + attvalue + '"]');
}

function editStudent(student) {
    let row = getRowByDataAttribute('id', student.id);
    let columns = row.find('td');

    columns.eq(1).text($('#group option[value="' + student.group + '"]').text());
    columns.eq(2).text(student.firstname + " " + student.lastname);
    columns.eq(3).text($('#gender option[value="' + student.gender + '"]').text());
    columns.eq(4).text(transformDateForTable(student.birthday));
    if (student.status) {
        columns.eq(5).html('<i class="bi bi-circle-fill status active"></i>');
    } else {
        columns.eq(5).html('<i class="bi bi-circle-fill status"></i>');
    }

    columns.eq(1).attr("data-value", student.group);
    columns.eq(3).attr("data-value", student.gender);
}

function transformDateForModal(dateString) {
    let parts = dateString.split('.');
    return parts[2] + '-' + parts[1] + '-' + parts[0];
}

function transformDateForTable(dateString) {
    let parts = dateString.split('-');
    return parts[2] + '.' + parts[1] + '.' + parts[0];
}

function openDeleteModal(button) {
    let row = button.closest('tr');
    let columns = row.find('td');
    let name = columns.eq(2).text().trim();
    $('#deleteId').val(button.data("id"));
    $('#delete-message').text("Are you sure you want to delete student " + name + "?");
    let modal = new bootstrap.Modal(document.getElementById('delete-modal'));
    modal.show();
}

function deleteStudent(id) {
    $.ajax({
        url: 'delete_student.php',
        type: 'POST',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.status) {
                console.log('Student deleted successfully');
                let row = getRowByDataAttribute('id', id);
                row.remove();
                let model = bootstrap.Modal.getInstance(document.getElementById("delete-modal"));
                model.hide();
            } else {
                console.log('Error deleting student');
            }
        },
        error: function(xhr, status, error) {
            console.error(status + ': ' + error);
        }
    });
}