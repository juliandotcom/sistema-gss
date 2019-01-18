<?php include "includes/admin_header.php" ?>
<?php

    if(isset($_SESSION['id'])) {
        
        $emp_id = $_SESSION['id'];
        
        $query = "SELECT * FROM employees WHERE emp_id = '{$emp_id}' ";
        
        $select_emp_profile_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($select_emp_profile_query)) {
        
            $emp_id = $row['emp_id'];
            $emp_username = $row['emp_username'];
            $emp_password= $row['emp_password'];
            $emp_firstname = $row['emp_firstname'];
            $emp_lastname = $row['emp_lastname'];
            $emp_email = $row['emp_email'];
            $emp_role = $row['emp_role'];
        }
    }
?>
    
    
<?php 

    if(isset($_POST['edit_emp'])) {
       
            
            $emp_firstname = $_POST['emp_firstname'];
            $emp_lastname = $_POST['emp_lastname'];
            $emp_role = $_POST['emp_role'];

            $emp_username = $_POST['emp_username'];
            $emp_email = $_POST['emp_email'];
            $emp_password = $_POST['emp_password'];


            if(!empty($emp_password) ) { 

                $query_password = "SELECT emp_password FROM employees WHERE emp_id =  $emp_id";
                $get_emp_query = mysqli_query($connection, $query_password);
                confirmQuery($get_emp_query);
      
                $row = mysqli_fetch_array($get_emp_query);
      
                $db_emp_password = $row['emp_password'];
      
              //   $hashed_password = "";
      
                  if($db_emp_password != $emp_password) {
      
                      $hashed_password = password_hash($emp_password, PASSWORD_BCRYPT, array('cost' => 12));
      
                      $query = 
                      "UPDATE employees SET 
                          emp_password   = '{$hashed_password}' 
                          WHERE emp_id = {$emp_id} ";
          
                      $edit_emp_query = mysqli_query($connection,$query);
                 
                      confirmQuery($edit_emp_query);
                      
                  }
      
              } // if password empty check end


 
            $query = "UPDATE employees SET 
                emp_firstname     = '{$emp_firstname}', 
                emp_lastname      = '{$emp_lastname}', 
                emp_username      = '{$emp_username}',
                emp_role          = '{$emp_role}', 
                emp_email         = '{$emp_email}', 
                WHERE emp_id      = '{$emp_id}' ";
       
            $edit_emp_query = mysqli_query($connection,$query);
       
            confirmQuery($edit_emp_query);

            echo "Perfil Actualizado" . " <a href='employees.php'>Ver Empleados</a>";
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
          <input type="text" value="<?php echo $emp_firstname; ?>" class="form-control" name="emp_firstname">
      </div>

       <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text" value="<?php echo $emp_lastname; ?>" class="form-control" name="emp_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" value="<?php echo $emp_username; ?>" class="form-control" name="emp_username">
      </div>

    <div class="form-group">
         <label for="post_content">Rol</label>
          <input type="text" value="<?php echo $emp_role; ?>" class="form-control" name="emp_role">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $emp_email; ?>" class="form-control" name="emp_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" autocomplete="off" class="form-control" name="emp_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_emp" value="Actualizar Perfil">
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
