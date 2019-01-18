<?php
   

   if(isset($_POST['create_employee'])) {
       
            
            $emp_firstname    = $_POST['emp_firstname'];
            $emp_lastname     = $_POST['emp_lastname'];
            $emp_role         = $_POST['emp_role'];
            $emp_username     = $_POST['emp_username'];
            $emp_email        = $_POST['emp_email'];
            $emp_password     = $_POST['emp_password'];



            //Encrypted password
            $emp_password = password_hash($emp_password, PASSWORD_BCRYPT, array('cost' => 10));    
              
            $query = "INSERT INTO employees(emp_firstname, emp_lastname, emp_role,emp_username,emp_email,emp_password) ";
                 
            $query .= "VALUES('{$emp_firstname}','{$emp_lastname}','{$emp_role}','{$emp_username}','{$emp_email}', '{$emp_password}') "; 
                 
            $create_emp_query = mysqli_query($connection, $query);  
              
            confirmQuery($create_emp_query); 
       
       
                 echo "Empleado Creado: " . " " . "<a href='employees.php'>Ver Empleados</a> "; 
   
   }

?>

    <form action="" method="post">    
     
     
     
      <div class="form-group">
         <label for="title">Firstname</label>
          <input type="text" class="form-control" name="emp_firstname">
      </div>
      
      
      

       <div class="form-group">
         <label for="post_status">Lastname</label>
          <input type="text" class="form-control" name="emp_lastname">
      </div>
     
     
        <div class="form-group">

        <select class="form-control" name="emp_role" id="">
            <option value="Trabajadora Social">Trabajadora Social</option>
            <option value="Orientadora">Orientadora</option>
            <option value="Directora">Directora</option>
        </select>
      </div>

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" class="form-control" name="emp_username">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" class="form-control" name="emp_email">
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" class="form-control" name="emp_password">
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_employee" value="Crear Empleado">
      </div>


</form>
    