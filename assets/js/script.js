// (function () {

// }).call(this);


/**
 *---------------------------------------------------------------ajax code for add a new folder---------------------------------------------------------------
 */
$(document).ready(function () {
    $("#btnFolder").click(function () {
        $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
                action: "addFolder",
                nameFolder: $("#createFolder").val()
            },
            success: function (respons) {
                swal("Good!", respons, "success");
            }
        });
        setTimeout(function () {
            location.reload();
        }, 1500);
    });
});



/**
 *---------------------------------------------------------------ajax code for edit folder name---------------------------------------------------------------
 */
$(document).ready(function () {
    $("span.editId").click(function () {
        $("div#editFolderModal").fadeIn(1000);
    });

    $("button.closeModalBtn").click(function () {
        $("div#editFolderModal").fadeOut(1000);
    });
});



/**
 *---------------------------------------------------------------modal for add a new task---------------------------------------------------------------
 */

$(document).ready(function () {
    $("div#addTask").click(function () {
        $("div#addTaskModal").fadeIn(1000);
    });

    $("button.closeModalBtn").click(function () {
        $("div#addTaskModal").fadeOut(1000);
    });

    $("button#ok").click(function () {
        $("div#addTaskModal").fadeOut(1000);
    });
});


/**
     *---------------------------------------------------------------Done Taks Ajax---------------------------------------------------------------
     */
$(document).ready(function () {
    $("i.statusIcon").click(function () {
        var taskId = $(this).attr("taskId");

        $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
                action: "doneTask",
                taskId: taskId,
            },
            success: function (respons) {
                if (respons == 1) {
                    location.reload();
                } else {
                    alert(respons);
                }
            }
        });
    });
});


/**
*---------------------------------------------------------------ajax update folder name---------------------------------------------------------------
*/

$(document).ready(function () {
    var folderId;
    $("span.editId").click(function () {
        folderId = $(this).attr("data-folderId");
    });

    $("#modalSubmitEdit").click(function () {
        var inputValue = $("#modalInputEdit").val();
        var folderIdNow = folderId;
        $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
                action: "updateFolder",
                newFolderName: inputValue,
                folderId: folderIdNow
            },
            success: function (respons) {
                swal("Good!", respons, "success");
            }
        });
        setTimeout(function () {
            location.reload();
        }, 1500);
    });

});


/**
*---------------------------------------------------------------ajax update Task name---------------------------------------------------------------
*/


$(document).ready(function () {
    var task_id;
    $("i#editTask").click(function () {
        task_id = $(this).attr("data-taskEditId");
        $("#editTaskModal").fadeIn(1000);
    });

    $(".closeModalBtn").click(function () {
        $("#editTaskModal").fadeOut(1000);
    });

    $("#modalSubmitTaskEdit").click(function () {
        var inputValue = $("#modalInputTaskEdit").val();
        $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
                action: "updateTask",
                newTaskName: inputValue,
                taskId: task_id
            },
            success: function (respons) {
                if (respons == 1) {
                    swal("Good!", "This Folder Updated !", "success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    alert(respons);
                }
            }
        });

    });

});


/**
*---------------------------------------------------------------ajax for live search task name---------------------------------------------------------------
*/

$(document).ready(function () {
    $("input#searchTask").keyup(function () {
        var inputValue = $("input#searchTask").val();
        $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
                action: "searchTask",
                taskName: inputValue
            },
            success: function (respons) {
                $("#resultSearch").html(respons);
            }
        });
    });
});

/**
*---------------------------------------------------------------ajax for Number of un done tasks---------------------------------------------------------------
*/

$(document).ready(function () {
    $.ajax({
        url: "process/ajaxHandler.php",
        method: "post",
        data: {
            action: "NoberOfUnDoneTasks"
        },
        success: function (respons) {
            if (respons == 0) {
                $("div.numOfUnDoneTask").append(respons + " " + "<i style='font-size:30px;vertical-align:-3px;position:relative;left:7px' class='fa fa-check'></i>").css({ "background-color": "green" });
            } else {
                $("div.numOfUnDoneTask").append(respons);
            }
            // alert(respons);
        }
    });
});


/**
*---------------------------------------------------------------Modal for Upload Music---------------------------------------------------------------
*/

$(document).ready(function () {
    $("li#addMusic").click(function () {
        $("#addMusicModal").fadeIn(1000);
    });
    $("i.closeUpload").click(function () {
        $("#addMusicModal").fadeOut(1000);
    });
});
