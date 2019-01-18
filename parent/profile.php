<?php include "includes/admin_header.php" ?>
<?php

    if(isset($_SESSION['id'])) {
        
        $par_id = $_SESSION['id'];
        
        $query = "SELECT * FROM parents WHERE par_id = '{$par_id}' ";
        
        $select_par_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_par_profile_query)) {
        
            $par_id = $row['par_id'];
            $par_username = $row['par_username'];
            $par_password= $row['par_password'];
            $par_firstname = $row['par_firstname'];
            $par_lastname = $row['par_lastname'];
            $par_email = $row['par_email'];
        
        }
    }
?>
    
    
<?php 

    if(isset($_POST['edit_par'])) {
       
            
            $par_firstname = $_POST['par_firstname'];
            $par_lastname = $_POST['par_lastname'];
    
            $par_username = $_POST['par_username'];
            $par_email = $_POST['par_email'];
            $par_password = $_POST['par_password'];
 
            $query = "UPDATE parents SET 
                par_firstname     = '{$par_firstname}', 
                par_lastname      = '{$par_lastname}', 
                par_username      = '{$par_username}', 
                par_email         = '{$par_email}', 
                par_password      = '{$par_password}' 
                WHERE par_id      = '{$par_id}' ";
       
            $edit_par_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_par_query);

            echo "Perfil Actualizado";
   }
    
?> 
    

    <div id="wrapper">
        
        <!-- Navigation -->
 
<?php include "includes/admin_navigation.php" ?>


<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
        Profile
        <small>Settings</small>
    </h1>
            
        <form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="title">Nombre</label>
          <input type="text" value="<?php echo $par_firstname; ?>" class="form-control" name="par_firstname">
      </div>

       <div class="form-group">
         <label for="post_status">Apellido</label>
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
          <input type="password" autocomplete="off" class="form-control" name="par_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_par" value="Update Profile">
      </div>


</form>    
            
      
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php include "includes/admin_footer.php" ?>
