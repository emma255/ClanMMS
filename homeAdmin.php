
<?php

include 'layout/header.html';
include 'layout/navbar.html';
?>
<div class="row">
    <div class="col-sm-4 text-center col-md-12">
        <form method="post" id="buttons"></form>
      <button type="submit" name="insert" class="btn btn-edit btn-sm" form="buttons">Insert Member</button>
      <button type="submit" name="edit" class="btn btn-edit btn-sm" form="buttons">Edit Member</button>
      <button type="submit" name="view" class="btn btn-edit btn-sm" form="buttons">View Member</button>
      <button type="submit" name="delete" class="btn btn-delete btn-sm" form="buttons">Delete Member</button>
    </div>
    <hr>
<div class="container-fluid">
  <div class="row">
<?php

include 'database/hostname.php';
      //ADDING MEMBERS
      if(isset($_POST['insert'])){
        echo('
        <hr>
        <div class="row" >
            <div class="text-justify col-sm-4"> <!--Left container--></div>
            <div class="col-sm-4 text-justify">
              <form action="member.php" method="post" name="details form">
               <ul type="none">

                <li>Name <input type="text" name="name" placeholder="Child Name" class="form-control" required></li><br>

                <li>Mother Name <input type="text" name="mname" required placeholder="Name Of Mother" class="form-control"></li><br>

                <li>Place Of Birth <input type="text" name="pob" required placeholder="Place Of Birth" class="form-control"></li><br>

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

      //EDITING MEMBERS RECORDS
        elseif(isset($_POST['edit'])){
            echo('<hr><div class="row text-center"> <form class="navbar-form navbar-center" role="search" method="post" action="homeAdmin.php">
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Search member to delete" name="seekedit">
            </div>
            <button type="submit" class="btn btn-default" name="edsearch">Search</button>
            </form></div>');
            echo("<hr>");
          }
              elseif(isset($_POST['edsearch'])){
                  $rawedkey=explode(' ',$_POST['seekedit']);
                    $size=sizeof($rawedkey);
                    $edkey=trim(implode(' ',array_slice($rawedkey,0,$size-1)));
                    $father=$rawedkey[$size-1];

              $view_records="SELECT * FROM member_details WHERE name='".$edkey."' AND father_name='".$father."'";
              $view_found=$connection->query($view_records);
                  echo("<hr>");
              if($view_found->num_rows==1){
                  echo('<form method="POST" action="member.php" id="edform"></form>
                  <div align="center">
                    <table width="1000" border="2">
                        <tr  style="text-align: center" bgcolor=" #999999">
                            <td>Name</td>
                            <td>Name of Mother</td>
                            <td>Name of father</td>
                            <td>Place of Birth</td>
                            <td>Date of Birth</td>
                            <td>Gender</td>
                        </tr>');
                  while($found_row=$view_found->fetch_assoc()){
                  echo('<div class="row text-center"> <tr  style="text-align: center">
                  <td><input contenteditable="false" type="text" form="edform" name="chname" value="'.$found_row["name"].'" required readonly></td>

                  <td><input contenteditable="true" type="text" form="edform" name="mname" value="'.$found_row["mother_name"].'" required readonly</td>

                  <td><input contenteditable="false" type="text" form="edform" name="fname" value="'.$found_row["father_name"].'" required readonly></td>

                  <td><input contenteditable="true" type="text" form="edform" name="bplace" value="'.$found_row["birth_place"].'" required></td>

                  <td><input contenteditable="true" type="text" form="edform" name="bdate" value="'.$found_row["birth_date"].'" required></td>

                  <td><input contenteditable="true" type="text" form="edform" name="gendr" value="'.$found_row["gender"].'" required></td>

                  <td><button type="submit" class="btn btn-delete btn-sm" form="edform" name="edbtn">UPDATE</button></td></tr></div>');

                  }
                  echo("</table></div>");
              }
              else{
                  echo('<div class="row text-center">no record to edit found.</div>');
              }
              //$connection->close();
          }
      //viwing the records
          elseif(isset($_POST['view'])){

              echo("<hr>");

              $view_records = "SELECT * FROM member_details";

              $view_found = $connection->query($view_records);

              if($view_found->num_rows > 0){

                  echo('<div align="center">
                    <table width="1000" border="2">
                        <tr  style="text-align: center" bgcolor=" #999999">
                            <td>Name</td>
                            <td>Name of Mother</td>
                            <td>Name of father</td>
                            <td>Place of Birth</td>
                            <td>Date of Birth</td>
                            <td>Gender</td>
                        </tr>');

                  while($found_row = $view_found->fetch_assoc()){
                  echo('
                <div class="row text-center">
                    <tr style="text-align: center">
                        <td>'.$found_row["name"].'</td>
                        <td>'.$found_row["mother_name"].'</td>
                        <td>'.$found_row["father_name"].'</td>
                        <td>'.$found_row["birth_place"].'</td>
                        <td>'.$found_row["birth_date"].'</td>
                        <td>'.$found_row["gender"].'</td>
                    </tr>
                </div>');

                  }
                  echo("</table></div>");
              }
              else{
                  echo('<div class="row text-center">no record found found.</div>');
              }
              //$connection->close();
          }

      //DELETING THE RECORDS
          elseif(isset($_POST['delete'])){
              echo('<hr><div class="row text-center"> <form class="navbar-form navbar-center" role="search" method="post" action="homeAdmin.php">

              <div class="form-group">

              <input type="text" class="form-control" placeholder="Search member to delete" name="seeking">
              </div>

              <button type="submit" class="btn btn-default" name="delsearch">Search</button>
              </form></div>');

              }
              elseif(isset($_POST['delsearch'])){
                  $rawdelkey=explode(' ',$_POST['seeking']);
                    $size=sizeof($rawdelkey);
                    $delkey=trim(implode(' ',array_slice($rawdelkey,0,$size-1)));
                    $father=$rawdelkey[$size-1];

              $view_records="SELECT * FROM member_details WHERE name='".$delkey."' AND father_name='".$father."'";
              $view_found=$connection->query($view_records);
                  echo("<hr>");
              if($view_found->num_rows==1){
                  echo('<div class="row text-center">
                  <form method="post" action="member.php" id="delform"></form>
                    <div align="center">
                        <table width="1000" border="2">
                            <tr style="text-align: center" bgcolor=" #999999">
                                <td>Name</td>
                                <td>Name of Mother</td>
                                <td>Name of father</td>
                                <td>Place of Birth</td>
                                <td>Date of Birth</td>
                                <td>Gender</td>
                            </tr>');

                  while($found_row=$view_found->fetch_assoc()){
                  echo('<tr  style="text-align: center">
                  <td><input type="text" readonly form="delform" name="fname" value="'.$found_row["name"].'"></td>

                  <td><input type="text" readonly form="delform" name="mname" value="'.$found_row["mother_name"].'"></td>

                  <td><input type="text" readonly form="delform" name="lname" value="'.$found_row["father_name"].'"></td>

                  <td>'.$found_row["birth_place"].'</td>

                  <td>'.$found_row["birth_date"].'</td>

                  <td>'.$found_row["gender"].'</td>

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


      //SEARCHING THE RECORDS
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
  <!-- <?php include 'layout/footer.html'; ?> -->