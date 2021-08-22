<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>masoud | TODO</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="page">
    <div class="pageHeader">
      <div class="title">Dashboard</div>
      <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQEZrATmgHOi5ls0YCCQBTkocia_atSw0X-Q&usqp=CAU" width="40" height="40" /></div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div class="itSelfSearchBox"><i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
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
            foreach ($folders as $value) : ?>
              <li class="folderItemName <?php if (isset($_GET['folder_id']) and $_GET['folder_id'] == $value['id']) {
                                          echo "active";
                                        } ?>">
                <span data-folderId="<?= $value['id']; ?>" id="editId" class="editId" titles="For Edit Folder Name Click Here!"><i class="fa fa-folder"></i></span>
                <a class="folders" href='<?= siteUrl("?folder_id=$value[id]") ?>'><?= $value['name']; ?></a>
                <a id="remove" titles="For Delete This Folder Click Here!" class="remove" href='<?= siteUrl("?folder_delete_id=$value[id]"); ?>' onclick="return confirm('Are You Sure To Delete <?= $value['name']; ?> Folder ?');"><i class="fas fa-trash-alt removeIcon"></i></a>
              </li>
            <?php endforeach; ?>
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
                                                        } ?>>Create a Foder</button>

        </div>


      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title">Manage Tasks</div>
          <div class="functions">
            <div id="addTask" class="button active">Add New Task</div>
            <div class="button">Completed</div>
          </div>
        </div>
        <div class="content">
          <div class="list">
            <div class="title">List Of Taks</div>

            <!-------------------------------------------------Show Tasks------------------------------------------------->
            <div class="taskBox">
              <ul>
                <?php if (isset($tasks) and !is_null($tasks)) :
                  foreach ($tasks as $value) : ?>
                    <li class="<?php echo $status = ($value['status'] == 1 ? "checked" : null); ?>"><i taskId="<?= $value['id']; ?>" class="<?php echo $status = ($value['status'] == 1 ? "fas fa-check-square" : "far fa-square"); ?> statusIcon"></i><span><?= $value['title']; ?></span>
                      <div class="info">
                        <span>Created at : <?= $value['created_at']; ?></span>
                        <a id="removeTask" titles="For Delete This Task Click Here!" class="removeTask" href='<?= siteUrl("?task_delete_id=$value[id]") ?>' onclick="return confirm('Are You Sure To Delete <?= $value['title']; ?> Task ?')"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </li>
                  <?php
                  endforeach;
                else :
                  ?>
                  <div class="notExist">There Is Not Any Task <br> Inside This Folder!</div>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
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

  <!------------------------------------------The External Dependency-------------------------------------------->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
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
            alert(respons);
          }
        });
        location.reload();
      });
    });
  </script>

</body>

</html>