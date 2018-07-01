
<?php
include '../layout/header.html';
include '../layout/navbar.html';
?>
<div class="row">
    <div class="col-sm-4 text-center col-md-12">
        <form method="post" id="buttons"></form>
      <button type="submit" name="insert" class="btn btn-edit btn-sm" form="buttons">Create Account</button>
      <button type="submit" name="edit" class="btn btn-edit btn-sm" form="buttons">Edit Account</button>
      <button type="submit" name="view" class="btn btn-edit btn-sm" form="buttons">View Account(s)</button>
    <button type="submit" name="delete" class="btn btn-delete btn-sm" form="buttons">Delete Account</button>
    </div>
    <hr>
<div class="container-fluid">
  <div class="row">
<?php
    include 'database/hostname.php';

    //ADDING Account
    if(isset($_POST['insert'])){
        echo('<hr><div class="row" >
        <div class="text-justify col-sm-4"> <!--Left container--></div>
        <div class="col-sm-4 text-justify">
            <form action="users.php" method="post" name="details form">
            <ul type="none">

            <li>Name <input type="text" name="name" placeholder="Child Name" class="form-control" required></li><br>

            <li>Mother Name <input type="text" name="mname" required placeholder="Name Of Mother" class="form-control"></li><br>

            <li>Date Of Birth <input type="date" name="dob" required placeholder="Date Of Birth" class="form-control"></li><br>

            <li><select name="gender_selector" required>
                <option value="" hidden="">Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                </select></li><br>

            <input type="reset" class="btn btn-default"> <input type="submit" class="btn btn-default" name="inserter">

                </ul>
                </form>
            </div>
            <div class="col-sm-4 text-justify"><!--Right container--></div>
            </div>');
    }

    //EDITING ACCOUNT RECORDS
        elseif(isset($_POST['edit'])){
            echo('<hr><div class="row text-center"> <form class="navbar-form navbar-center" role="search" method="post" action="homeAdminAccounts.php">
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Search an account" name="seekedit" title="type the member first name followed by the mother name">
            <button type="submit" class="btn btn-default" name="edsearch">Search</button>
            </form></div>');
            echo("<hr>");
        }
            elseif(isset($_POST['edsearch'])){
                $edkey=$_POST['seekedit'];

            $view_records="SELECT * FROM login_details WHERE user_name='".$edkey."'";
            $view_found=$connection->query($view_records);
                echo("<hr>");
            if($view_found->num_rows==1){
                echo('<form method="POST" action="users.php" id="edform"></form>
                <div align="center"><table width="1000" border="2"><tr  style="text-align: center" bgcolor=" #999999"><td>Name</td><td>User Name</td><td>Password</td></tr>');
                while($found_row=$view_found->fetch_assoc()){
                echo('<div class="row text-center"> <tr  style="text-align: center">
                <td><input contenteditable="false" type="text" form="edform" name="name" value="'.$found_row["name"].'" required readonly></td>

                <td><input contenteditable="true" type="text" form="edform" name="uname" value="'.$found_row["user_name"].'" required</td>

                <td><input contenteditable="false" type="text" form="edform" name="pswd" value="'.$found_row["password"].'" required></td>

                <td><button type="submit" class="btn btn-delete btn-sm" form="edform" name="edbtn">UPDATE</button></td></tr></div>');

                }
                echo("</table></div>");
            }
            else{
                echo('<div class="row text-center">no record to edit found.</div>');
            }
            //$connection->close();
        }
    //viEwing the accounts
        elseif(isset($_POST['view'])){
            echo("<hr>");
            $view_records="SELECT * FROM login_details";
            $view_found=$connection->query($view_records);
            if($view_found->num_rows>0){
                echo('<div align="center"><table width="1000" border="2"><tr  style="text-align: center" bgcolor=" #999999"><td>Name</td><td>user name<td>password</td></tr>');
                while($found_row=$view_found->fetch_assoc()){
                echo('<div class="row text-center"> <tr  style="text-align: center"><td>'.$found_row["name"].'</td><td>'.$found_row["user_name"].'</td><td>'.$found_row["password"].'</td></tr></div>');

                }
                echo("</table></div>");
            }
            else{
                echo('<div class="row text-center">no record found found.</div>');
            }
            //$connection->close();
        }

    //DELETING THE ACCOUNTS
        elseif(isset($_POST['delete'])){
            echo('<hr><div class="row text-center"> <form class="navbar-form navbar-center" role="search" method="post" action="homeAdminAccounts.php">

            <div class="form-group">

            <input type="text" class="form-control" placeholder="Search account to delete" name="seeking" title="type the member first name followed by the mother name">
            </div>

            <button type="submit" class="btn btn-default" name="delsearch">Search</button>
            </form></div>');

            }
            elseif(isset($_POST['delsearch'])){
            $delkey=$_POST['seeking'];

            $view_records="SELECT * FROM login_details WHERE user_name='".$delkey."'";
            $view_found=$connection->query($view_records);
                echo("<hr>");
            if($view_found->num_rows==1){
                echo('<div class="row text-center"><form method="post" action="users.php" id="delform"></form><div align="center"><table width="1000" border="2"><tr  style="text-align: center" bgcolor=" #999999"><td>Name</td><td>User name</td><td>Password</td></tr>');

                while($found_row=$view_found->fetch_assoc()){
                echo('<tr  style="text-align: center">
                <td><input type="text" readonly form="delform" name="name" value="'.$found_row["name"].'"></td>

                <td><input type="text" readonly form="delform" name="uname" value="'.$found_row["user_name"].'"></td>

                <td><input type="text" readonly form="delform" name="pswd" value="'.$found_row["password"].'"></td>

                <td><button type="submit" class="btn btn-delete btn-sm" form="delform" name="delbtn">DELETE</button></td>

                </tr></div>');

                }
                echo("</table></div>");
            }
            else{
                echo('<div class="row text-center">no record found.</div>');
            }
            // $connection->close();
        }


    //SEARCHING THE ACCOUNTS
        elseif(isset($_POST['search'])){
            $search_key=$_POST['seek'];
            if(is_null($search_key)){
                echo('<div class="row text-center">No value to search! provide it</div>');
            }

            else{
            $search_query="SELECT * FROM member_details WHERE name='".$search_key."'";
                //echo('<div class="row text-center">'.$search_query.'</div>');
            $found=$connection->query($search_query);
                echo("<hr>");
            if($found->num_rows>0){
                while($found_row=$found->fetch_assoc()){
                echo('<div class="row text-center"> You are a '.$found_row["gender"].' named '.$found_row["name"].', your father name is '.$found_row["father_name"].' and your mother name is '.$found_row["mother_name"].". you were born at ".$found_row["birth_place"].' on '.$found_row["birth_date"].'<br></div>');

                }
            }
                else{
                    echo('<div class="row text-center">no record named <strong>'. $search_key.'</strong> found.</div>');
                }
                //$connection->close();
            }
        }

    ?>
</div>
</div>
</div>

<?php
include 'layout/footer.php';
?>