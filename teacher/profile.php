<?php include "includes/admin_header.php" ?>
<?php

    if(isset($_SESSION['id'])) {
        
        $tea_id = $_SESSION['id'];
        
        $query = "SELECT * FROM teachers WHERE tea_id = '{$tea_id}' ";
        
        $select_tea_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_tea_profile_query)) {
        
            $tea_id = $row['tea_id'];
            $tea_username = $row['tea_username'];
            $tea_password= $row['tea_password'];
            $tea_firstname = $row['tea_firstname'];
            $tea_lastname = $row['tea_lastname'];
            $tea_email = $row['tea_email'];
            $tea_group = $row['tea_group'];
        }
    }
?>
    
    
<?php 

    if(isset($_POST['edit_tea'])) {
       
            
            $tea_firstname = $_POST['tea_firstname'];
            $tea_lastname = $_POST['tea_lastname'];
            $tea_group = $_POST['tea_group'];

            $tea_username = $_POST['tea_username'];
            $tea_email = $_POST['tea_email'];
            $tea_password = $_POST['tea_password'];


            if(!empty($tea_password) ) { 

                $query_password = "SELECT tea_password FROM teachers WHERE tea_id =  $tea_id";
                $get_tea_query = mysqli_query($connection, $query_password);
                confirmQuery($get_tea_query);
      
                $row = mysqli_fetch_array($get_tea_query);
      
                $db_tea_password = $row['tea_password'];
      
              //   $hashed_password = "";
      
                  if($db_tea_password != $tea_password) {
      
                      $hashed_password = password_hash($tea_password, PASSWORD_BCRYPT, array('cost' => 12));
      
                      $query = 
                      "UPDATE teachers SET 
                          tea_password   = '{$hashed_password}' 
                          WHERE tea_id = {$tea_id} ";
          
                      $edit_tea_query = mysqli_query($connection,$query);
                 
                      confirmQuery($edit_tea_query);
                      
                  }
      
              } // if password teaty check end


 
            $query = "UPDATE teachers SET 
                tea_firstname     = '{$tea_firstname}', 
                tea_lastname      = '{$tea_lastname}', 
                tea_username      = '{$tea_username}',
                tea_group          = '{$tea_group}', 
                tea_email         = '{$tea_email}', 
                WHERE tea_id      = '{$tea_id}' ";
       
            $edit_tea_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_tea_query);

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
            
        <form action="" method="post">    
     
     
     
      <div class="form-group">
         <label for="title">Nombre</label>
          <input type="text" value="<?php echo $tea_firstname; ?>" class="form-control" name="tea_firstname">
      </div>

       <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text" value="<?php echo $tea_lastname; ?>" class="form-control" name="tea_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" value="<?php echo $tea_username; ?>" class="form-control" name="tea_username">
      </div>

    <div class="form-group">
         <label for="post_content">Grupo</label>
          <input type="text" value="<?php echo $tea_group; ?>" class="form-control" name="tea_group">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $tea_email; ?>" class="form-control" name="tea_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" autocomplete="off" class="form-control" name="tea_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_tea" value="Actualizar Perfil">
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
