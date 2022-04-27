<?php
require_once 'core/init.php';
include 'includes/header.php';

echo "
<div class='maincontainer'></div>";

$data = $user->data();

$db = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi433416','dbi433416','123');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $db->query("SELECT * FROM posts ORDER BY id DESC");
$reply = $db->query("SELECT * FROM reply");

if(isset($_POST['liked'])){
  $postid = $_POST['postid'];
  $result = $db->query("SELECT * FROM posts WHERE id = $postid");
  $row = $result->fetch(PDO::FETCH_ASSOC);
  $n = $row['likes'];

  $like = "UPDATE posts SET likes=? WHERE id=$postid";
  $insert = "INSERT INTO likes(userid, postid) VALUES(?, ?)";
  $stmt1 = $db->prepare($like);
  $stmt1->execute([$n+1]);
  $stmt2 = $db->prepare($insert);
  $stmt2->execute([$data->id, $postid]);
  exit();
}

if(isset($_POST['unliked'])){
  $postid = $_POST['postid'];
  $result = $db->query("SELECT * FROM posts WHERE id = $postid");
  $row = $result->fetch(PDO::FETCH_ASSOC);
  $n = $row['likes'];

  $like = "UPDATE posts SET likes=? WHERE id=$postid";
  $insert = "DELETE FROM likes WHERE postid=? AND userid=?";
  $stmt1 = $db->prepare($like);
  $stmt1->execute([$n-1]);
  $stmt2 = $db->prepare($insert);
  $stmt2->execute([$postid, $data->id]);
  exit();
}

if(isset($_POST['likedreply'])){
  $replyid = $_POST['replyid'];
  $result = $db->query("SELECT * FROM reply WHERE replyid = $replyid");
  $rowreply = $result->fetch(PDO::FETCH_ASSOC);
  $n = $rowreply['likes'];

  $like = "UPDATE reply SET likes=? WHERE replyid=$replyid";
  $insert = "INSERT INTO replylikes(userid, replyid) VALUES(?, ?)";
  $stmt1 = $db->prepare($like);
  $stmt1->execute([$n+1]);
  $stmt2 = $db->prepare($insert);
  $stmt2->execute([$data->id, $replyid]);
  exit();
}

if(isset($_POST['unlikedreply'])){
  $replyid = $_POST['replyid'];
  $result = $db->query("SELECT * FROM reply WHERE replyid = $replyid");
  $rowreply = $result->fetch(PDO::FETCH_ASSOC);
  $n = $rowreply['likes'];

  $like = "UPDATE reply SET likes=? WHERE replyid=$replyid";
  $insert = "DELETE FROM replylikes WHERE replyid=? AND userid=?";
  $stmt1 = $db->prepare($like);
  $stmt1->execute([$n-1]);
  $stmt2 = $db->prepare($insert);
  $stmt2->execute([$replyid, $data->id]);
  exit();
}

if(isset($_POST['deleted'])){
  $postid = $_POST['postid'];
  $result = $db->query("SELECT * FROM posts WHERE id = $postid");
  $row = $result->fetch(PDO::FETCH_ASSOC);

  $delete = "DELETE FROM posts WHERE id=?";
  $stmntdelete = $db->prepare($delete);
  $stmntdelete->execute([$postid]);
  exit();
}


echo"
<link rel='stylesheet' href='assets/css/styles.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

</div>";
  if ($user->isLoggedIn()) {
        echo "<a href = 'createpost.php' class='ad'><button type='button' class='btn btn-primary btn-create' style='position: relative; left:44%;'>Create Thread</button></a>";

      ?>

<?php
      while ($row = $stmt->fetch()){
        echo "
        <div id='".$row['id']."' class='modal'>
        <div class='modal-content'>
          <span class='close'>&times;</span>
          <p>".$row['title']."</p>
          <p>".$row['date']."</p>
          <p>".$row['descc']."</p>
        </div>
      </div>
      ";
      ?>
<?php


      echo"
        <form action='updatepost.php' method='POST'>
        <div class='container-fluid mt-100'>
        <div class='row'>
            <div class='col-md-12' style='margin-top: 50px;'>
                <div class='card mb-4'>
                    <div class='card-header'>
                        <div class='media flex-wrap w-100 align-items-center'> <img
                                src='";?> <?php
                                if($row['user'] == $user->data()->name){
                                echo escape($user->data()->img);}?>
                                <?php echo "'class='d-block ui-w-40 rounded-circle'
                                alt='' style='width: 80px;'>
                            <div class='media-body ml-3'> <a href='javascript:void(0)' data-abc='true'>" . $row['user'] ."</a>
                                    <p class='text-center title-thread'>".$row['title']."</p>";?>
                                    <?php
                                    echo"
                            </div>
                            <div class='text-muted small ml-3'>
                                <div> Latest update on <strong>".$row['date']."</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class='card-body'>
                    ".$row['descc']."
                    </div>
                    <div
                        class='card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3'>
                        <div class='px-4 pt-3'>";?>
                        <?php
                          $data = $user->data(); // user exists

                          $result = $db->query("SELECT * FROM likes WHERE userid=$data->id AND postid= ".$row['id']."");
                          $row_count = $result->rowCount();
                          if($row_count == 1){
                          echo "<span><a href='' class='unlike' id='". $row['id'] ."'><i class='fa fa-heart-o text-danger' aria-hidden='true'></i>&nbsp; ".$row['likes']." likes </a></span>";
                          }
                          else{
                          echo "<span><a href='' class='like' id='". $row['id'] ."'><i class='fa fa-heart text-danger'></i>&nbsp; ".$row['likes']." likes </a></span>";
                          }

                          if($user->hasPermission('admin') || $row['user'] == $user->data()->username){
                          echo "<input type='submit' class='edit info' name='updatepost' value='Edit'>
                                <input type='hidden' name='postid' value='". $row['id'] ."'>
                                <span><a href='' class='delete info' id='". $row['id'] ."'>Delete</a></span>";
                          }
                          
                                  
                        echo"</form>";?>
                        <?php echo"
                       </a></div>
                        <div class='px-4 pt-3'> 
                        
                        <form method='post' action=''>
                        <input type='submit' class='btn btn-primary' name='".$row['id']."' value='Add comment' />
                        </form>";
      
                       

              echo'        </div>
                        </div>
                        </div>';

                         if (isset($_POST[$row['id']])) {

                          echo  '
                                    <form method="get" action="post.php"> 
                                      
                                      </form>
                        
                        
                                    <form method="post" action="">
                                    <textarea class ="replycom" name="newReply"> </textarea>
                                       <input type="submit" class="btn btn-kodq" name="replybtn' .$row['id'].  '" value="Submit"/>
                                       </form>';
                        }

                        if (isset($_POST['replybtn'.$row['id']])) {
                          //echo '<label>' . $_POST['newReply'] .  '</label>';
                        
                          CreateReply( $row['id'], $user->data()->id, $_POST['newReply'], $user->data()->name);
                          
                        }

                        $array = GetReplies($row['id']);

?>

<?php

    echo "
    <p>
    <button class='btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample'>
     View Comments
    </button>
  </p>
  <div class='collapse' id='collapseExample'>
    <div class='card card-body'>";
?>
<?php

foreach ($array as $key => $value) {
  while ($row2 = $reply->fetch()){


  echo"
    <div class ='container-fluid mt-100'>
    <div class='row'>
        <div class='col-md-12' style='margin-top: 50px;'>
            <div class='card mb-4'>
                <div class='card-header'>
                    <div class='media flex-wrap w-100 align-items-center'> <img
                            src='";?> <?php
                            if($row['user'] == $user->data()->name){
                            echo escape($user->data()->img);}?>
                            <?php echo "' class='d-block ui-w-40 rounded-circle'
                            alt='' style='width: 80px;'>
                        <div class='media-body ml-3'>
                          <a href='javascript:void(0)' data-abc='true'>".$row2['user']."</a>
                                <p class='text-center title-thread'>Reply to:" . $row['title'] . "</p>
                        </div>
                        <div class='text-muted small ml-3'>
                        </div>
                    </div>
                </div>
                <div class='card-body'>
                ".$row2['msg']."
                </div>
                <div class='card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3'>
                    <div class='px-4 pt-3'> ";?>
                    <?php
                      $data = $user->data(); // user exists


                      $result = $db->query("SELECT * FROM replylikes WHERE userid=$data->id AND replyid= ".$row2['replyid']."");
                      $row_count = $result->rowCount();

                      if($row_count == 1){
                      echo "<span><a href='' class='unlikereply' id='". $row2['replyid'] ."'><i class='fa fa-heart-o text-danger' aria-hidden='true'></i>&nbsp; ".$row2['likes']." likes </a></span>";
                      }
                      else{
                      echo "<span><a href='' class='likereply' id='". $row2['replyid'] ."'><i class='fa fa-heart text-danger'></i>&nbsp; ".$row2['likes']." likes </a></span>";
                      }
                              
                    echo"</form>";?>
                    <?php echo" </div></div>
                                </div>
                              </div>";
                            }
                          }
                        ?>

      <?php
      echo"






    </div>
  </div>";

  echo "</div>
        </div>
      </div>";
      ?>



<?php
  echo "
 </div>
</div>";
}
} else {
echo "<p>You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a></p>";
while ($row = $stmt->fetch()){
echo "
<div class='overlay'>
<div class='gallery'>
<img src=". $row['src'] .">
<div class='desc'>".$row['title']."</div>
</div>
</div>";
}
}
?>
       <script src="assets/js/main.js"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type='text/javascript'>
  $(document).ready(function () {

    $('.like').click(function () {
      var postid = $(this).attr('id');
      $.ajax({
        url: 'posts.php',
        type: 'post',
        async: false,
        data: {
          'liked': 1,
          'postid': postid
        },
        success: function () {

        }
      });
    });

    $('.unlike').click(function () {
      var postid = $(this).attr('id');
      $.ajax({
        url: 'posts.php',
        type: 'post',
        async: false,
        data: {
          'unliked': 1,
          'postid': postid
        },
        success: function () {

        }
      });
    });

    $('.likereply').click(function () {
      var replyid = $(this).attr('id');
      $.ajax({
        url: '',
        type: 'post',
        async: false,
        data: {
          'likedreply': 1,
          'replyid': replyid
        },
        success: function () {

        }
      });
    });

    $('.unlikereply').click(function () {
      var replyid = $(this).attr('id');
      $.ajax({
        url: '',
        type: 'post',
        async: false,
        data: {
          'unlikedreply': 1,
          'replyid': replyid
        },
        success: function () {

        }
      });
    });
  });

  $('.delete').click(function () {
    var postid = $(this).attr('id');
    $.ajax({
      url: 'posts.php',
      type: 'post',
      async: false,
      data: {
        'deleted': 1,
        'postid': postid
      },
      success: function () {

      }
    });
  });

  if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

</script>


<?php

function CreateReply($postID, $userID, $msg, $username)
        {
            $db = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi433416', 'dbi433416', '123');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'INSERT INTO reply (postid, userid, msg, user, likes) VALUES (:pid, :uid, :msg, :user, :likes)';
            $values = array(':pid' => $postID, ':uid' => $userID, ':msg' => $msg, ':user' => $username, ':likes' => 0);

            try {
                $res = $db->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                throw new Exception('Database query error' . $e->getMessage());
            }
        }

        function GetReplies($postID)
        {
            $db = new PDO('mysql:host=studmysql01.fhict.local;dbname=dbi433416', 'dbi433416', '123');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'Select msg and replyid FROM reply WHERE postid = :pid';
            $values = array(':pid' => $postID);

            try {
                $res = $db->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                throw new Exception('Database query error' . $e->getMessage());
            }

            

            return $res->fetchAll(PDO::FETCH_COLUMN);
            //PDO::FETCH_ASSOC
        }

?>