<?php include "includes/admin_header.php" ?>
<?php

    if(isset($_SESSION['id'])) {
        
        $admin_id = $_SESSION['id'];
        
        $query = "SELECT * FROM admins WHERE admin_id = '{$admin_id}' ";
        
        $select_admin_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_admin_profile_query)) {
        
            $admin_id = $row['admin_id'];
            $admin_username = $row['admin_username'];
            $admin_password= $row['admin_password'];
            $admin_firstname = $row['admin_firstname'];
            $admin_lastname = $row['admin_lastname'];
            $admin_email = $row['admin_email'];
        
        }
    }
?>
    
    
<?php 

    if(isset($_POST['edit_user'])) {
       
            
            $admin_firstname = $_POST['admin_firstname'];
            $admin_lastname = $_POST['admin_lastname'];
            $admin_role = $_POST['admin_role'];
    
//            $post_image = $_FILES['image']['name'];
//            $post_image_temp = $_FILES['image']['tmp_name'];
    
    
            $admin_username = $_POST['admin_username'];
            $admin_email = $_POST['admin_email'];
            $admin_password = $_POST['admin_password'];
 
            $query = "UPDATE admins SET 
                admin_firstname     = '{$admin_firstname}', 
                admin_lastname      = '{$admin_lastname}', 
                admin_username      = '{$admin_username}', 
                admin_email         = '{$admin_email}', 
                admin_password      = '{$admin_password}' 
                WHERE admin_id      = '{$admin_id}' ";
       
            $edit_admin_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_admin_query);

            echo "Perfil Actualizado" . " <a href='admins.php'>View admins?</a>";
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
         <label for="title">Firstname</label>
          <input type="text" value="<?php echo $admin_firstname; ?>" class="form-control" name="admin_firstname">
      </div>

       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input type="text" value="<?php echo $admin_lastname; ?>" class="form-control" name="admin_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" value="<?php echo $admin_username; ?>" class="form-control" name="admin_username">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $admin_email; ?>" class="form-control" name="admin_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" autocomplete="off" class="form-control" name="admin_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_admin" value="Update Profile">
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
