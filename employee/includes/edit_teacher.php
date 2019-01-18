

<?php  // Get request tea id and database data extraction


if(isset($_GET['edit_teacher'])){


    $the_tea_id =  ($_GET['edit_teacher']);
    
    $query = "SELECT * FROM teachers WHERE tea_id = $the_tea_id ";
    $select_teas_query = mysqli_query($connection,$query);  

      while($row = mysqli_fetch_assoc($select_teas_query)) {

          $tea_id           = $row['tea_id'];
          $tea_username     = $row['tea_username'];
          $tea_password     = $row['tea_password'];
          $tea_firstname    = $row['tea_firstname'];
          $tea_lastname     = $row['tea_lastname'];
          $tea_group        = $row['tea_group'];
          $tea_email        = $row['tea_email'];
      
      }
?>
  

<?php  // Post request to update tea 
   

   if(isset($_POST['update_teacher'])) {
       
            
            $tea_firstname      = ($_POST['tea_firstname']);
            $tea_lastname       = ($_POST['tea_lastname']);
         
            $tea_username       = ($_POST['tea_username']);
            $tea_email          = ($_POST['tea_email']);
            $tea_group          = $_POST['tea_group'];
            $tea_password       = ($_POST['tea_password']);


        if(!empty($tea_password) ) { 

          $query_password = "SELECT tea_password FROM teachers WHERE tea_id =  $the_tea_id";
          $get_tea_query = mysqli_query($connection, $query_password);
          confirmQuery($get_tea_query);

          $row = mysqli_fetch_array($get_tea_query);

          $db_tea_password = $row['tea_password'];

          $hashed_password = $db_tea_password;

        //   $hashed_password = "";

            if($db_tea_password != $tea_password) {

                $hashed_password = password_hash($tea_password, PASSWORD_BCRYPT, array('cost' => 12));

                $query = 
                "UPDATE teachers SET 
                    tea_password   = '{$hashed_password}' 
                    WHERE tea_id = {$the_tea_id} ";
    
                $edit_tea_query = mysqli_query($connection,$query);
           
                confirmQuery($edit_tea_query);
                
            }

        } // if password empty check end

          $query = 
            "UPDATE teachers SET 
                tea_firstname  = '{$tea_firstname}', 
                tea_lastname = '{$tea_lastname}', 
                tea_username = '{$tea_username}', 
                tea_email = '{$tea_email}', 
                tea_password   = '{$hashed_password}' 
                WHERE tea_id = {$the_tea_id} ";

            $edit_tea_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_tea_query);

          echo "Maestro Actualizado" . " <a href='teachers.php'>View teachers?</a>";

            //  } // if password empty check end
      
        } // Post reques to update tea end





 } else {  // If the tea id is not present in the URL we redirect to the home page


        header("Location: index.php");

      }
    
?>

    <form action="" method="post">    
      
      <div class="form-group">
         <label for="tea_firstname">Firstname</label>
          <input type="text" value="<?php echo $tea_firstname; ?>" class="form-control" name="tea_firstname">
      </div>
      
       <div class="form-group">
         <label for="tea_lastname">Lastname</label>
          <input type="text" value="<?php echo $tea_lastname; ?>" class="form-control" name="tea_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" value="<?php echo $tea_username; ?>" class="form-control" name="tea_username">
      </div>

        <div class="form-group">
         <label for="post_tags">Grupo</label>
          <input type="text" value="<?php echo $tea_group; ?>" class="form-control" name="tea_group">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $tea_email; ?>" class="form-control" name="tea_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" autocomplete="off" class="form-control"  name="tea_password">
      </div>
      
      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_teacher" value="Actualizar Maestro">
      </div>

</form>