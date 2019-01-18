<?php
   

   if(isset($_POST['create_parent'])) {
       
            
            $par_firstname    = $_POST['par_firstname'];
            $par_lastname     = $_POST['par_lastname'];
            $par_username     = $_POST['par_username'];
            $par_email        = $_POST['par_email'];
            $par_password     = $_POST['par_password'];



            //Encrypted password
            $par_password = password_hash($par_password, PASSWORD_BCRYPT, array('cost' => 10));    
              
            $query = "INSERT INTO parents(par_firstname, par_lastname, par_username,par_email,par_password) ";
                 
            $query .= "VALUES('{$par_firstname}','{$par_lastname}','{$par_username}','{$par_email}', '{$par_password}') "; 
                 
            $create_par_query = mysqli_query($connection, $query);  
              
            confirmQuery($create_par_query); 
       
       
                 echo "Pariente Creado: " . " " . "<a href='parents.php'>Ver Parientes</a> "; 
   
   }

?>

    <form action="" method="post">    
     
     
     
      <div class="form-group">
         <label for="title">Firstname</label>
          <input type="text" class="form-control" name="par_firstname">
      </div>
      

       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input type="text" class="form-control" name="par_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" class="form-control" name="par_username">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" class="form-control" name="par_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" class="form-control" name="par_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_parent" value="Crear Empleado">
      </div>


</form>
    