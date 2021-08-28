<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MH | TODO</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="assets/img/favIcon2.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

</head>

<body>
  <?php if (isset($_SESSION['uploadMusic'])) { ?>
    <div class="resultMotivation"><?= $_SESSION['uploadMusic'] ?></div>
  <?php
    unset($_SESSION['uploadMusic']);
  }
  ?>

  <div class="page">
    <div class="pageHeader">
      <div class="title"> <img src="assets/img/favIcon2.png" alt="us Icon" width="40px" style="vertical-align: -12px; margin-right: 5px;"> MH | TODO</div>
      <div class="userPanel"><span class="username"><a href="<?= siteUrl("?logout=1") ?>"><i style="position: relative;left: 10px; font-size: 27px; vertical-align: -10px; color:#fff" title="LogOut" class="fas fa-sign-out-alt clickable"></i></a><?= $_SESSION['login']['username'] ?? "Unknown" ?>
        </span></div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div class="itSelfSearchBox"><i class="fa fa-search"></i>
            <input id="searchTask" type="text" placeholder="Search" />
          </div>
          <div id="resultSearch"></div>
        </div>
        <div class="menu">
          <div class="title">List Of Folders</div>

          <ul>
            <a href="<?= siteUrl(); ?>" style="text-decoration: none;" title="For Show All Task Click Here!">
              <li class="allFolder <?php if (!isset($_GET['folder_id'])) {
                                      echo "active";
                                    } ?>"><i class="fa fa-folder"></i>All</li>
            </a>
            <!----------------------------------------------------------------------Show Folders---------------------------------------------------------------------->

            <?php

            foreach ($folders as $value) :
              if (!is_null($value)) {
            ?>
                <li class="folderItemName <?php if (isset($_GET['folder_id']) and $_GET['folder_id'] == $value['id']) {
                                            echo "active";
                                          }

                                          ?>">
                  <span data-folderId="<?= $value['id']; ?>" id="editId" class="editId" titles="For Edit Folder Name Click Here!"><i class="fa fa-folder"></i></span>
                  <a class="folders" href='<?= siteUrl("?folder_id=$value[id]") ?>'><?= $value['name'] ?></a>
                  <a id="remove" titles="For Delete This Folder Click Here!" class="remove" href='<?= siteUrl("?folder_delete_id=$value[id]"); ?>' onclick="return confirm('Are You Sure To Delete <?= $value['name']; ?> Folder ?')"><i class="fas fa-trash-alt removeIcon"></i></a>
                </li>
            <?php
              }
            endforeach;
            ?>
          </ul>

        </div>

        <div class="searchbox" style="margin-top: 40px;">
          <div class="itSelfSearchBox"><i class="fa fa-folder"></i>
            <input id="createFolder" type="search" placeholder="Folder Name . . ." <?php if ($foldersCount >= 5) {
                                                                                      echo "disabled";
                                                                                    } ?> />
          </div>

          <button id="btnFolder" class="button-folder" <?php if ($foldersCount >= 5) {
                                                          echo "disabled";
                                                        } ?>>Create Folder</button>

        </div>

        <div class="numOfUnDoneTask">unDone Tasks: </div>

      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title">Manage Tasks</div>
          <div class="functions">
            <div id="addTask" class="button active">Add New Task</div>


            <!---------------------------------------- sort tasks ---------------------------------------->
            <div class="dropdown">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Sort Task
              </a>

              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="<?= siteUrl("?sortBy=ASC") ?>">Ascending</a></li>
                <li><a class="dropdown-item" href="<?= siteUrl("?sortBy=DESC") ?>">Descending</a></li>
              </ul>
            </div>



          </div>
          <!-- Example single danger button -->
          <div id="muzic" class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Muzic
            </button>
            <ul class="dropdown-menu">
              <li id="addMuzic" class="dropdown-item clickable">Add Music</li>
              <li><a class="dropdown-item" href="music.php" target="_blank">Music Player</a></li>
            </ul>
          </div>


        </div>
        <div class="content">
          <div class="list">
            <div class="title">List Of Taks</div>

            <!-------------------------------------------------Show Tasks------------------------------------------------->
            <div class="taskBox">
              <ul class="ulTasks">
                <?php if (isset($tasks) and !is_null($tasks)) :
                  foreach ($tasks as $value) : ?>
                    <li class="<?php echo $status = ($value['status'] == 1 ? "checked" : null); ?>"><i id="statusDone" titles="For Change Status This Task Clikc Here" taskId="<?= $value['id']; ?>" class="<?php echo $status = ($value['status'] == 1 ? "fas fa-check-square" : "far fa-square"); ?> statusIcon"></i><span><?= $value['title']; ?></span>
                      <div class="info">
                        <span>Created at : <?= $value['created_at']; ?></span>
                        <a id="removeTask" titles="For Delete This Task Click Here!" class="removeTask" href='<?= siteUrl("?task_delete_id=$value[id]") ?>' onclick="return confirm('Are You Sure To Delete <?= $value['title']; ?> Task ?')"><i class="fas fa-trash-alt"></i></a>
                        <i style="color: #006938; font-size: 17px; vertical-align: -7px;" titles="For Edit This Task Click Here!" data-taskEditId="<?= $value['id']; ?>" id="editTask" class="fas fa-edit removeTask"></i>
                      </div>
                    </li>
                  <?php
                  endforeach;
                else :
                  ?>
                  <div class="notExist">There Is Not Any Task <br> Inside This Page!</div>
                <?php endif; ?>
              </ul>



            </div>


          </div>
        </div>
      </div>
      <!-------------------------PAGINATION HTML CODE------------------------->
      <nav aria-label="Page navigation example" id="navPag">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="<?= siteUrl() ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="<?= siteUrl("?page=1") ?>">1</a></li>
          <li class="page-item"><a class="page-link" href="<?= siteUrl("?page=2") ?>">2</a></li>
          <li class="page-item"><a class="page-link" href="<?= siteUrl("?page=3") ?>">3</a></li>
          <li class="page-item"><a class="page-link" href="<?= siteUrl("?page=4") ?>">4</a></li>
          <li class="page-item"><a class="page-link" href="<?= siteUrl("?page=5") ?>">5</a></li>
          <li class="page-item">
            <a class="page-link" href="<?= siteUrl() ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-------------------------PAGINATION HTML CODE------------------------->

    </div>
  </div>

  <!--------------------------------------------Modal For Edit Folder Name------------------------------------------ -->

  <div id="editFolderModal" class="modal">
    <div class="modalMain">
      <button class="closeModalBtn clickable"><i class="fas fa-times"></i></button>
      <label class="modalLable" for="editFoderName">Write a New Name <br>For This Folder :
        <br>
        <input type="text" id="modalInputEdit" class="modalInput" placeholder="Write A Name . . . ">

      </label>
      <button id="modalSubmitEdit" type="button" class="btn btn-primary modalSubmit">Update Folder Name</button>
    </div>
  </div>

  <!--------------------------------------------Modal For Add a New Task------------------------------------------ -->

  <div id="addTaskModal" class="modal">

    <?php if (isset($_GET['folder_id']) and !empty(is_numeric($_GET['folder_id']))) { ?>
      <div class="modalMain">
        <button class="closeModalBtn clickable"><i class="fas fa-times"></i></button>
        <label class="modalLable" for="editFoderName">Write a Name <br>For Your Task :
          <br>
          <input type="text" id="modalInputAdd" class="modalInput" placeholder="Write A Name . . . ">

        </label>

        <button id="modalSubmitAdd" type="button" class="btn btn-primary modalSubmit">Add New Task</button>
      </div>
    <?php } else { ?>

      <div class="notExistFolder modalMain">
        <p>Please Select a Folder <br> For Create a Task!</p>
        <button class="closeModalBtn clickable"><i class="fas fa-times"></i></button>
        <button id="ok" type="button" class="btn btn-primary modalSubmit" style="position: relative;left: 185px; top:60px ;padding: 5px 30px;font-weight: bold;">OK</button>
      </div>

    <?php } ?>
  </div>


  <div id="ohsnap"></div>

  <!--------------------------------------------Modal For Update a Task------------------------------------------ -->

  <div id="editTaskModal" class="modal">
    <div class="modalMain">
      <button class="closeModalBtn clickable"><i class="fas fa-times"></i></button>
      <label class="modalLable" for="editFoderName">Write a New Name <br>For This Folder :
        <br>
        <input type="text" id="modalInputTaskEdit" class="modalInput" placeholder="Write a Name . . . ">

      </label>
      <button id="modalSubmitTaskEdit" type="button" class="btn btn-primary modalSubmit">Update Task Name</button>
    </div>
  </div>

  <!--------------------------------------------Modal For add a music------------------------------------------ -->

  <div id="addMuzicModal" class="modal">
    <form class="modalMainUpload" action="<?= siteUrl("music.php") ?>" method="POST" enctype="multipart/form-data">
      <i class="fas fa-times closeUpload clickable"></i>
      <label class="modalLableUpload modalLable" for="modalInputAddMuzic">Write a New Name <br>For This Muzic :
        <br>
        <input name="muzicName" type="text" id="modalInputAddMuzic" class="modalInput modalInputUpload" placeholder="Write a Name . . . " autocomplete="off">
      </label>

      <label class="uploadLabel" for="uploadMuzic">
        <i class="fas fa-upload iconUpload"></i>
        <input name="muzic" id="uploadMuzic" type="file" class="inputFile">
      </label>
      <input id="addMusicBtn" name="uploadBtn" style="position: absolute;left: 245px;bottom: 5px;font-family: sans-serif;" type="submit" class="btn btn-primary modalSubmit" value="Upload Muzic">
    </form>
  </div>
  <!------------------------------------------The External Dependency-------------------------------------------->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
  </script>
  <script src="../assets/alert-library/ohsnap.js"></script>
  <!---------------------------------------jQuery Codes is in script.js--------------------------------------->
  <script src="<?= ROOT_PATH . 'assets/js/script.js' ?>"></script>


  <script>
    /**
     *---------------------------------------------------------------ajax add a new task---------------------------------------------------------------
     */
    $(document).ready(function() {
      $("button#modalSubmitAdd").click(function() {
        var taskName = $('input#modalInputAdd').val();
        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "addTask",
            taskName: taskName,
            folderId: <?= $_GET['folder_id']; ?>
          },
          success: function(respons) {
            // alert(respons);
            swal("Good!", respons, "success");
          }
        });
        setTimeout(function() {
          location.reload();
        }, 1500);
      });
    });
  </script>

</body>

</html>