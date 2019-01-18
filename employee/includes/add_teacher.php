<?php
   

   if(isset($_POST['create_teacher'])) {
       
            
            $tea_firstname    = $_POST['tea_firstname'];
            $tea_lastname     = $_POST['tea_lastname'];
            $tea_username     = $_POST['tea_username'];
            $tea_group        = $_POST['tea_group'];
            $tea_email        = $_POST['tea_email'];
            $tea_password     = $_POST['tea_password'];



            //Encrypted password
            $tea_password = password_hash($tea_password, PASSWORD_BCRYPT, array('cost' => 10));    
              
            $query = 
            "INSERT INTO 
            teachers(
                tea_firstname, 
                tea_lastname, 
                tea_username, 
                tea_group, 
                tea_email,
                tea_password)
            VALUES(
                '{$tea_firstname}',
                '{$tea_lastname}',
                '{$tea_username}',
                '{$tea_group}', 
                '{$tea_email}', 
                '{$tea_password}') "; 
                 
            $create_tea_query = mysqli_query($connection, $query);  
              
            confirmQuery($create_tea_query); 
       
       
                 echo "Maestro Creado: " . " " . "<a href='teachers.php'>Ver Maestros</a> "; 
   
   }

?>

    <form action="" method="post">    
     
     
     
      <div class="form-group">
         <label for="title">Firstname</label>
          <input type="text" class="form-control" name="tea_firstname">
      </div>
      
       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input type="text" class="form-control" name="tea_lastname">
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" class="form-control" name="tea_username">
      </div>

        <div class="form-group">
         <label for="post_tags">Grupo</label>
          <input type="text" class="form-control" name="tea_group">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" class="form-control" name="tea_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" class="form-control" name="tea_password">
      </div>
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_teacher" value="Crear Maestro">
      </div>


</form>
    