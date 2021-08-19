<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Task manager UI</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
          <div><i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
        </div>
        <div class="menu">
          <div class="title">List Of Folders</div>
          <ul>

            <?php
            /**
             * Show Folders
             */
            foreach ($folders as $value) :
            ?>

              <li>
                <a class="folders" href="?folder_id=<?= $value['id'] ?>"><i class="fa fa-folder"></i><?= $value['name'] ?></a>
                <a class="remove" href="?folder_delete_id=<?= $value['id'] ?>"><i class="fas fa-trash-alt"></i></a>
              </li>


            <?php endforeach; ?>
            <li class="active"><i class="fa fa-folder"></i>Current Folder</li>
          </ul>
        </div>

        <div class="searchbox" style="margin-top: 40px;">
          <div><i class="fa fa-folder"></i>
            <input id="createFolder" type="search" placeholder="Folder Name . . ." />
          </div>

          <button id="btnFolder" class="button-folder">Create a Foder</button>

        </div>

      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title">Manage Tasks</div>
          <div class="functions">
            <div class="button active">Add New Task</div>
            <div class="button">Completed</div>
            <div class="button inverz"><i class="fa fa-trash-o"></i></div>
          </div>
        </div>
        <div class="content">
          <div class="list">
            <div class="title">Today</div>
            <ul>
              <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
                <div class="info">
                  <div class="button green">In progress</div><span>Complete by 25/04/2014</span>
                </div>
              </li>
              <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
                <div class="info">
                  <div class="button">Pending</div><span>Complete by 10/04/2014</span>
                </div>
              </li>
              <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
                <div class="info"></div>
              </li>
            </ul>
          </div>
          <div class="list">
            <div class="title">Tomorrow</div>
            <ul>
              <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
                <div class="info"></div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="assets/js/script.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <script>
    $(document).ready(function() {
      $("#btnFolder").click(function() {
        $.ajax({
          url: "index.php",
          method: "post",
          data: {
            newFolder: $("#createFolder").val()
          },
        });
        location.reload();
      });
    });
  </script>
</body>

</html>