
<?php

include 'layout/header.html';
include 'layout/navbar.html';
?>
    <nav class="navbar navbar-default">
<a href="homeAdmin.php"><img src="resources/images/home.png" height="60" alt="HOME"></a>
    <div class="navbar-header">

      <form class="navbar-form navbar-right" role="search" method="post">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search family member" name="seek">
        </div>
        <button type="submit" class="btn btn-default" name="search">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MENU<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="index.php">add family member</a></li>
            <li><a href="#">edit family member</a></li>
            <li><a href="#">remove family member</a></li>
            <li class="divider"></li>
            <li><a href="#">View member profiles</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
    <?php


        //database connection.
        $server="localhost";
        $db_name="clan_mms";
        $username="emma";
        $password="";
    $db_conn=new mysqli($server,$username,$password,$db_name);

    if(isset($_POST['inserter'])){
                    $cname=explode(' ',$_POST['name']);
                    $size=sizeof($cname);
                      if($size>1){
                    $name=trim(implode(' ',array_slice($cname,0,$size-1)));
                      }

                    $mother_name=$_POST['mname'];
                    $father_name=$cname[$size-1];
                    $place=$_POST['pob'];
                    $date=$_POST['dob'];
                    $gender=$_POST['gender_selector'];

                    //login table details.
                    $logname=$name;
                    $logpassword="$gender.$date";
                    $logusername=strtoupper($cname[0]." ".$mother_name);


                    $sql="INSERT INTO member_details(name,mother_name,father_name,birth_place,birth_date,gender) VALUES('$name','$mother_name','$father_name','$place','$date','$gender')";

                    if($db_conn->query($sql)){
                    $loginquerry="INSERT INTO login_details(name,user_name,password) VALUES('$logname','$logusername','$logpassword')";
                    $db_conn->query($loginquerry);
                    echo('<div class="row text-center">Successfully added '.$name.'  '.$father_name).'</div>';
                        }
                    else{
                            echo('<div class="row text-center">Not Successfully added '.$name.'  '.$father_name.'</div>');
                        }
           $db_conn->close();
                    echo '<meta http-equiv=Refresh content=2;url=//localhost/Clan/homeAdmin.php>';
                }


    elseif(isset($_POST['delbtn'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $mname=$_POST['mname'];

       $log_del=strtoupper($fname." ".$mname);

        $delete_query="DELETE FROM member_details WHERE name='".$fname."' AND father_name='".$lname."'";

        if($db_conn->query($delete_query)){

            $delacc="DELETE FROM login_details WHERE user_name='".$log_del."'";

            if($db_conn->query($delacc)){

                if(mysqli_affected_rows($db_conn)==1){

                    echo('<div class="row text-center">Completely deleted '.$fname.' '.$lname.'</div>');
                }
                else{
                    echo('<div class="row text-center">partially deleted '.$fname.' '.$lname.', the account should be deleted manually.</div>');
                }
            }
        }
        else{
            echo('<div class="row text-center">Not Successfully deleted '.$fname.' '.$lname.'</div>');
        }
    echo '<script>location.href="http://localhost/htdocs/projects/Clan/homeAdmin.php"</script>';



    }

    elseif(isset($_POST['edbtn'])){
                $name=$_POST['chname'];
                $father_name=$_POST['fname'];
                $place=$_POST['bplace'];
                $date=$_POST['bdate'];
                $gender=$_POST['gendr'];

                $edquery="UPDATE member_details SET birth_place='$place', gender='$gender', birth_date='$date' WHERE name='$name' AND father_name='$father_name'";

                if($db_conn->query($edquery)){
                    if(mysqli_affected_rows($db_conn)==1){
                        echo('<div class="row text-center">successful updated '.$name.' ' .$father_name.'</div>');
                    }
                    else{
                        echo('<div class="row text-center">No data had been updated</div>');
                    }
                }
                else{
                    echo('<div class="row text-center">Failed to updated '.$name.' '.$father_name. 'because of '.$db_conn->error.'</div>');
                }
                    $db_conn->close();
        echo '<script>location.href="http://localhost/htdocs/projects/Clan/homeAdmin.php"</script>';

    }

    ?>
     <hr>

<?php
include 'layout/footer.html';
?>