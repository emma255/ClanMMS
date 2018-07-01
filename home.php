
<?php
include 'layout/header.html';
include 'layout/navbar.html';
?>

<div class="row">
    <div class="col-sm-4 text-center col-md-12">
        <form method="post" id="buttons"></form>
      <button type="submit" name="insert" class="btn btn-edit btn-sm" form="buttons">Insert Member</button>
      <button type="submit" name="view" class="btn btn-edit btn-sm" form="buttons">View Member</button>
    </div>
<div class="container-fluid">
  <div class="row">
<?php
      $connection=new mysqli("localhost","root","","clan_members_store");

      if(isset($_POST['insert'])){
                  echo('<hr><div class="row" >
                <div class="text-justify col-sm-4"> <!--Left container--></div>
                <div class="col-sm-4 text-justify">
                  <form action="member.php" method="post" name="details form">
                   <ul type="none">
                    <li>Name <input type="text" name="name" placeholder="Child Name" class="form-control"></li><br>
                    <li>Mother Name <input type="text" name="mname" placeholder="Name Of Mother" class="form-control"></li><br>
                    <li>Father Name <input type="text" name="fname" placeholder="Name Of Father" class="form-control"></li><br>
                    <li>Place Of Birth <input type="text" name="pob" placeholder="Place Of Birth" class="form-control"></li><br>
                    <li>Date Of Birth <input type="date" name="dob" placeholder="Date Of Birth" class="form-control"></li><br>
                    <li><select name="gender_selector">
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

          elseif(isset($_POST['view'])){
              echo("<hr>");
              $view_records="SELECT * FROM member_details";
              $view_found=$connection->query($view_records);
              if($view_found->num_rows>0){
                  echo('<div align="center"><table width="1000" border="2"><tr  style="text-align: center" bgcolor=" #999999"><td>Name</td><td>Name of Mother</td><td>Name of father</td><td>Place of Birth</td><td>Date of Birth</td><td>Gender</td></tr>');
                  while($found_row=$view_found->fetch_assoc()){
                  echo('<div class="row text-center"> <tr  style="text-align: center"><td>'.$found_row["name"].'</td><td>'.$found_row["mother_name"].'</td><td>'.$found_row["father_name"].'</td><td>'.$found_row["birth_place"].'</td><td>'.$found_row["birth_date"].'</td><td>'.$found_row["gender"].'</td></tr></div>');

                  }
                  echo("</table></div>");
              }
              else{
                  echo('<div class="row text-center">no record found found.</div>');
              }
              $connection->close();
          }

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
                  $connection->close();
                }
          }

      ?>
    </div>
</div>
    <hr>
  </div>

<?php
include 'layout/footer.html';
?>