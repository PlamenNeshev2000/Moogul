<?php

echo "<div class='maincontainer'>";
require_once 'core/init.php';

include 'includes/header.php';

if (Session::exists('home')) {
  echo '<p>' . Session::flash('home') .  '</p>';
}

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to('login.php');
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Moogul</title>
</head>

<body id="body-pd">

    <body onload="myFunction()">

        <div class="text_title">
            <h1 class="Subj">Courses</h1>
        </div>

        <div class="navigation_button">
            <div class="button_nav">
                <p class="lectures">
                    <a href="SubjectPage.php">Media Production</a> </p>

            </div>
            <div class="button_nav">
                <p class="lectures">
                  <a href="SubjectPageHacker.php"> Object Oriented Design</a></p>
            </div>
            <div class="button_nav">
                <p class="lectures">
                    <a href="SubjectPageUser.php">User Experience Design</a></p>
            </div>
        </div>
        </div>


        <h1 class="Subj">Teacher info</h1>

<br><br><br>
        <div class="boxx">
          
              <div class="cardd">
                <div class="imgBx">
                  
                    <img src="assets/img/jan.jpg"  alt="images"
                    button type="button" class="bn btn-primary" data-toggle="modal" data-target="#exampleJan">
                    </button>>
                    
                    
                </div>
                <div class="details">
                    <h2>Jan Salge<br><span>Media Production <br>Teacher</span></h2><br><br>
                    
                </div>
              </div>

               <div class="cardd">
                 <div class="imgBx">
                  <img src="assets/img/medhat.jpg"  alt="images"
                  button type="button" class="bn btn-primary" data-toggle="modal" data-target="#exampleMedhat">
                  </button>
                 </div>
                 <div class="details">
                    <h2>Medhat Riad<br><span>Object Oriented Design<br>Teacher</span></h2>
                  </div>
               </div>

               <div class="cardd" >
                 <div class="imgBx">
                  <img src="assets/img/lin.jpg"  alt="images"
                  button type="button" class="bn btn-primary" data-toggle="modal" data-target="#exampleLin">
                  </button>
                    
                 </div>
                 <div class="details">
                    <h2>Yuzhong Lin<br><span>User Experience Design <br> Teacher</span></h2>
                  </div>
               </div>
          </div>




         
          <div class="modal fade" id="exampleJan" tabindex="-1" role="dialog" aria-labelledby="exampleJanTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleJanTitle">Teacher Profile</h5>
                  
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img class ="fonjan" src="assets/img/jan.jpg"  alt="images" id="Myimg">
                  <p class ="nname"> Jan Salge</p>
                  <p class ="nname2"> Media Production <br> Teacher</p>
                  <p class ="nname3"> Contact: </p>
                  <p class ="nname4"> j.salge@fontys.nl</p>
                  
                </div>
                <div class="modal-footer">
                 
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      




        <div class="modal fade" id="exampleMedhat" tabindex="-1" role="dialog" aria-labelledby="exampleMedhatTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleMedhatTitle">Teacher Profile</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img class ="fon" src="assets/img/medhat.jpg"  alt="images" id="Myimg">
                <p class ="mednname"> Medhat Riad</p>
                <p class ="mednname2"> Programming <br> Teacher</p>
                <p class ="mednname3"> Contact: </p>
                <p class ="mednname4"> medhat.riad@fontys.nl</p>
                
              </div>
              <div class="modal-footer">
               
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>





      <div class="modal fade" id="exampleLin" tabindex="-1" role="dialog" aria-labelledby="exampleLinTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleLinTitle">Teacher Profile</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img class ="fon" src="assets/img/lin.jpg"  alt="images" id="Myimg">
              <p class ="linnname"> Yuzhong Lin</p>
              <p class ="linnname2"> User Experience <br> Teacher</p>
              <p class ="nname3"> Contact: </p>
              <p class ="linnname4"> y.lin@fontys.nl</p>
              
            </div>
            <div class="modal-footer">
             
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>



        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>


        <script>
            var myVar;

            function myFunction() {
                myVar = setTimeout(showPage, 1500);
            }

            function showPage() {
                document.getElementById("loader").style.display = "none";
                document.getElementById("myDiv").style.display = "block";
            }
        </script>
    </body>

</html>
