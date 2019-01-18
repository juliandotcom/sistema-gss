

<?php  // Get request par id and database data extraction


if(isset($_GET['edit_parent'])){


    $the_par_id =  ($_GET['edit_parent']);
    
    $query = "SELECT * FROM parents WHERE par_id = $the_par_id ";
    $select_pars_query = mysqli_query($connection,$query);  

      while($row = mysqli_fetch_assoc($select_pars_query)) {

          $par_id        = $row['par_id'];
          $par_username  = $row['par_username'];
          $par_password  = $row['par_password'];
          $par_firstname = $row['par_firstname'];
          $par_lastname  = $row['par_lastname'];
          $par_email     = $row['par_email'];
      
          
      }
?>
  

<?php  // Post request to update par 
   

   if(isset($_POST['update_parent'])) {
       
            
            $par_firstname      = ($_POST['par_firstname']);
            $par_lastname       = ($_POST['par_lastname']);
         
            $par_username       = ($_POST['par_username']);
            $par_email          = ($_POST['par_email']);
            $par_password       = ($_POST['par_password']);
            // $post_date     = (date('d-m-y'));

        if(!empty($par_password) ) { 

          $query_password = "SELECT par_password FROM parents WHERE par_id =  $the_par_id";
          $get_par_query = mysqli_query($connection, $query_password);
          confirmQuery($get_par_query);

          $row = mysqli_fetch_array($get_par_query);

          $db_par_password = $row['par_password'];

        //   $hashed_password = "";

            if($db_par_password != $par_password) {

                $hashed_password = password_hash($par_password, PASSWORD_BCRYPT, array('cost' => 12));

                $query = 
                "UPDATE parents SET 
                    par_password   = '{$hashed_password}' 
                    WHERE par_id = {$the_par_id} ";
    
                $edit_par_query = mysqli_query($connection,$query);
           
                confirmQuery($edit_par_query);
                
            }

        } // if password empty check end

          $query = 
            "UPDATE parents SET 
                par_firstname  = '{$par_firstname}', 
                par_lastname = '{$par_lastname}', 
                par_username = '{$par_username}', 
                par_email = '{$par_email}', 
                par_password   = '{$hashed_password}' 
                WHERE par_id = {$the_par_id} ";

            $edit_par_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_par_query);

          echo "parent Updated" . " <a href='parents.php'>View parents?</a>";

            //  } // if password empty check end
      
        } // Post reques to update par end





 } else {  // If the par id is not present in the URL we redirect to the home page


        header("Location: index.php");

      }
    
?>

    <form action="" method="post">    
      
      <div class="form-group">
         <label for="par_firstname">Firstname</label>
          <input type="text" value="<?php echo $par_firstname; ?>" class="form-control" name="par_firstname">
      </div>
      
       <div class="form-group">
         <label for="par_lastname">Lastname</label>
          <input type="text" value="<?php echo $par_lastname; ?>" class="form-control" name="par_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" value="<?php echo $par_username; ?>" class="form-control" name="par_username">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $par_email; ?>" class="form-control" name="par_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" autocomplete="off" class="form-control" value="<?php echo $par_password; ?>" name="par_password">
      </div>
      
      <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_parent" value="Update parent">
      </div>

</form>