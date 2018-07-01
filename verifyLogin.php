
<?php 
include 'layout/header.html';
?>

    <?php
    if(isset($_POST['log'])){
        $logname=$_POST['username'];
        $logpassword=$_POST['password'];
        
        //database connection.
        $server="localhost";
        $db_name="clan_mms";
        $username="emma";
        $password="";

        $db_conn=new mysqli($server,$username,$password,$db_name);

        $sql="SELECT * FROM login_details WHERE user_name='".$logname."' AND password='".$logpassword."'";
        //$sql="SELECT * FROM login_details";
        $result=$db_conn->query($sql);
        if($result->num_rows==1){
            $rowres=$result->fetch_assoc();

            if($logname=="superAdmin"){
                if($logpassword==$rowres['password']){
            echo '<script>location.href="http://localhost/htdocs/projects/Clan/homeAdmin.php"</script>';
                }
                else{
                    echo("not registered as an admin");
            echo '<script>location.href="http://localhost/htdocs/projects/Clan/index.html"</script>';

                }
            }
            
            else{
            $name=$rowres['name'];
                $cname=explode(' ',$rowres['user_name']);
                $size=sizeof($cname);
            $mother=$cname[$size-1];
            $tomemberquerry="SELECT * FROM member_details WHERE name='$name'";
            $member_result=$db_conn->query($tomemberquerry);
            $member_row=$member_result->fetch_assoc();
				if($mother==strtoupper($member_row['mother_name'])){
				echo '<meta http-equiv=Refresh content=0;url=/home.php>';
				}
				else{
				   echo("not registered yet!");
                   echo '<script>location.href="http://localhost/htdocs/projects/Clan/index.html"</script>';
				}
        }
		}
        else{
            echo '<script>location.href="http://localhost/htdocs/projects/Clan/index.html"</script>';
        }
        $db_conn->close();
        
    }
 
    ?>

    
<?php 
include 'layout/footer.html';
?>