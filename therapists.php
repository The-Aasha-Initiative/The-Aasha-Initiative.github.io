<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Align</title>
    <link rel="shortcut icon" type="image/jpg" href="images/favicon.ico"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <img id="blog-banner" src="images/Find_Therapists.png">

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top navbar-border nav-shadow">
            
        <a class="navbar-brand nb" href="index.html">HOME</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-right flex-grow-1 mr-right" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-5 flex-nowrap">
                <a class="nav-link border-r" href="#">Find Therapists</a>
                <a class="nav-link me-5 mr-right" href="#">For Professionals</a>
            </div>
        </div>

    </nav>

    <div class="t-header"> 
        <h2 class="mt-5">Find Mental Health Professionals</h2>
        <h5 class="mt-3 mb-5">Find Psychotherapists, Counsellors, Psychologists, Psychiatrists and Mental Health Clinics</h5>
    </div>
    
        <form class="ms-5 me-5" id="search-box" method="post"> 
            <label for="lgsearch">Search by Location </label>
            <input type="search" class="searchTerm" id="lsearch" name="lsearch" placeholder="Area (e.g. Delhi)" title="Type in the city">
        </form>
        <hr>

    <div class="container-fluid" id="therapists-container">

        
        <div id="dropdowns"> 
            <?php
                session_start();
                
                $username = "root";
                $password = "";
                $database = "aasha";
                $mysqli = new mysqli("localhost", $username, $password, $database);

                $sql = "SELECT DISTINCT `Designation` FROM `therapists`"; 
                if($res = $mysqli->query($sql))
                {

                    echo '<div class="select">
                                <select id="profession" name="profession" onchange="getSelectValue(this.value);">
                                <option selected disabled>Filter by Profession</option> ';              
                    while ($row = $res->fetch_assoc()) {
                        echo "<option value='" . $row['Designation'] ."'>" . $row['Designation'] ."</option>";
                    }
                    echo '      </select>
                          </div>';
                    $res->free();
                  
                } 

                $ids = "SELECT DISTINCT `Identifies As` FROM `therapists`";
                if($res = $mysqli->query($ids))
                {
                    echo '<div class="select">
                                <select id="idas" name="idas" onchange="getSelectValue(this.value);">
                                <option selected disabled>Identifies as</option> ';              
                    while ($row = $res->fetch_assoc()) {
                        echo "<option value='" . $row['Identifies As'] ."'>" . $row['Identifies As'] ."</option>";
                    }
                    echo '      </select>
                          </div>';
                    $res->free();
                
                }
                
                $clgr = "SELECT DISTINCT `Client Group` FROM `therapists`";
                if($res = $mysqli->query($clgr))
                {

                    echo '<div class="select">
                            <select id="clgr" name="clgr" onchange="getSelectValue(this.value);">
                                <option selected disabled>Client Group</option> ';

                    while ($row = $res->fetch_assoc()) {
                        echo "  <option value='" . $row['Client Group'] ."'>" . $row['Client Group'] ."</option>";
                    } 
                    echo '   </select>
                          </div>';
                    $res->free();
                }

                $istr = "SELECT DISTINCT `Issues Treated` FROM `therapists`";
                if($res = $mysqli->query($istr))
                {

                    echo '<div class="select">
                             <select id="istr" name="istr" onchange="getSelectValue(this.value);">
                                <option selected disabled>Issues treated</option> ';

                    while ($row = $res->fetch_assoc()) {
                        echo "  <option value='" . $row['Issues Treated'] ."'>" . $row['Issues Treated'] ."</option>";
                    } 
                    echo '   </select>
                          </div>';
                    $res->free();
                } 
                
                $lan = "SELECT DISTINCT `Languages` FROM `therapists`";
                if($res = $mysqli->query($lan))
                {

                    echo '<div class="select">
                             <select id="idas" name="lan" onchange="getSelectValue(this.value);">
                                <option selected disabled>Languages</option> ';

                    while ($row = $res->fetch_assoc()) {
                        echo "  <option value='" . $row['Languages'] ."'>" . $row['Languages'] ."</option>";
                    } 
                    echo '   </select>
                          </div>';
                    $res->free();
                }
                  
                  ?>
                </div>  
                <div id="boxes" class="mr-t"> 
                  <?php
                    
                    if (!empty($_REQUEST['lsearch'])) {
                        
                    $term = $mysqli -> real_escape_string($_REQUEST['lsearch']);
                    $_SESSION['location'] = $term;
                    
                    $query = "SELECT * FROM `therapists` AS `T` inner join `personal details` as `P` ON `T`.`Therapist ID` = `P`.`Therapist ID` WHERE `Location` LIKE '%".$term."%' ";
                    //echo "<b> <center>Database Output</center> </b> <br> <br>";

                    if ($result = $mysqli->query($query)) {
                    
                        while ($row = $result->fetch_assoc()) {
                            
                            $field1name = $row["Therapist ID"];
                            $field2name = $row["Name"];
                            $field3name = $row["Designation"];
                            $field4name = $row["Identifies As"];
                            $field5name = $row["Client Group"];
                            $field6name = $row["Languages"];
                            $field7name = $row["Issues Treated"];
                            $field8name = $row["Location"];
                            $field9name = $row["Phone Number"];
                            $field10name = $row["Intro"];
                            $field11name = $row["Instagram Link"];
                            $field12name = $row["Linkedin Link"];
                            $field13name = $row["Aasha URL"];
                            $field14name = $row["Image"];
        
                                    echo '<div id="profile-card">
                                              <div id="info">
                                                  <div class="name-desig-img">
                                                    <div class="name-desig">          
                                                        <a class="therapist-name" href="profile.php">';echo $field2name;echo'</a>
                                                        <p>';echo $field3name;echo'</p>
                                                    </div>
                                                    <div class="p-img">
                                                        <img class="prof-img" src="';echo $field14name;echo'">
                                                    </div>  
                                                  </div>   
                                                  <div class="intro">
                                                      <p>';echo $field10name;echo'</p>
                                                  </div>
                                                  <div class="location">  
                                                       <p>';echo $field8name;echo'</p><p>
                                                  </div>
                                              </div>    
                                              <div id="links">
                                                  <div id="t-socials">
                                                    <div class="tp"><a class="t-links" href="';echo $field13name;echo'">';echo' Profile </a></div>
                                                    <div class="tli">|</div>
                                                    <div class="tli"><a class="t-links" href="';echo $field12name;echo '"><i class="fab fa-linkedin">';echo'</i></a> </div>  
                                                    <div class="tli">|</div>
                                                    <div class="tli"><a class="t-links" href="';echo $field11name;echo '"><i class="fab fa-instagram-square">';echo'</i></a></div>
                                                  </div>  
                                                  <p class="showphone">
                                                      <span class="clickshow" style="display: inline;"><b>Show Phone Number</b></span>
                                                      <span class="hiddenphone" style="display: none;">
                                                          <span>';echo $field9name;echo'</span>
                                                      </span>
                                                  </p>
                                              </div>
                                        </div>';        
                        }
                    
                        /*freeresultset*/
                        $result->free();
                        }
                    }   
                      
                    ?>
                </div>    
            
    </div>

    <div id="footer" style="position: relative; z-index: 9;">
        <img src="images/coverfooter.jpg" class="img-fluid" id="footerbanner" alt="...">  
    </div>

    <div class="footer-basic" style="position: relative; z-index: 9;">
        <footer>
            <ul class="list-inline">
                <li class="list-inline-item fw-bold fs-4">Reach Us</li>
            </ul>
            
            <div class="social">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/the-aasha-initiative/"><i class="fab fa-linkedin"></i></a>
                <!-- <a href="#"><i class="icon ion-social-twitter"></i></a>
                <a href="#"><i class="icon ion-social-facebook"></i></a></div> -->
            
            <p class="copyright">The Aasha Initiative © 2021</p>
        </footer>
    </div>

    <script src="js/therapists.js"></script>                         
                            
</body>
</html>