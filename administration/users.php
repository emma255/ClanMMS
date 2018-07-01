
<?php
include 'layout/header.html';
include 'layout/navbar.html';
?>
    <?php

    $server="localhost";
    $db_name="clan_mms";
    $username="root";
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

                    $loginquerry="INSERT INTO login_details(name,user_name,password) VALUES('$logname','$logusername','$logpassword')";
                    if($db_conn->query($loginquerry)){
                    echo('<div class="row text-center">Successfully created an account for '.$name.'  '.$father_name).'</div>';
                        }
                    else{
                            echo('<div class="row text-center">Not Successfully created an account for '.$name.'  '.$father_name.'</div>');
                        }
                $db_conn->close();
                    echo '<meta http-equiv=Refresh content=2;url=//localhost/Clan/administration/homeAdminAccounts.php>';
                }


    elseif(isset($_POST['delbtn'])){
        $name=$_POST['name'];
        $uname=$_POST['uname'];
        $pswd=$_POST['pswd'];

       $log_del=strtoupper($uname);

        $delete_query="DELETE FROM login_details WHERE name='".$name."' AND user_name='".$uname."'";

        if($db_conn->query($delete_query)){
            echo('<div class="row text-center">Successfully deleted '.$uname.'</div>');
        }
        else{
            echo('<div class="row text-center">Not Successfully deleted '.$uname.'</div>');
        }
    echo '<script>location.href="http://localhost/htdocs/projects/Clan/administration/homeAdminAccounts.php"</script>';


    }

    elseif(isset($_POST['edbtn'])){
                $name=$_POST['name'];
                $user_name=$_POST['uname'];
                $password=$_POST['pswd'];

                $edquery="UPDATE login_details SET user_name='$user_name', password='$password' WHERE name='$name' ";//AND user_name='$user_name'";
                if($db_conn->query($edquery)){
                    if(mysqli_affected_rows($db_conn)==1){
                        echo('<div class="row text-center">successful updated '.$user_name.'</div>');
                    }
                    else{
                        echo('<div class="row text-center">No data had been updated</div>');
                    }
                }
                else{
                    echo('<div class="row text-center">Failed to updated '.$user_name.' because of '.$db_conn->error.'</div>');
                }
                    $db_conn->close();
        echo '<script>location.href="http://localhost/htdocs/projects/Clan/administration/homeAdminAccounts.php"</script>';
    }

    ?>
     <hr>

</div>
<script src="../
<?php
include 'layout/footer.php';
?>