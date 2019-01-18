<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


 <?php

        if(isset($_POST['submit'])){

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];


            if(!empty($firstname) && !empty($lastname) && !empty($username) && !empty($email) && !empty($password)){

            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            $firstname = mysqli_real_escape_string($connection, $firstname);
            $lastname = mysqli_real_escape_string($connection, $lastname);

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

            $query = "INSERT INTO employees (emp_username, emp_email, emp_password, emp_firstname, emp_lastname)";
            $query .= "VALUES('{$username}', '{$email}', '{$password}', '{$firstname}', '{$lastname}')";
           
            $register_user_query = mysqli_query($connection, $query);
            if(!$register_user_query){
                die("QUERY FAILED: " . mysqli_error($connection));
            }

            $message = "<p class='bg-success'>Your Registration has been submitted</p>";
            "Your Registration has been submitted";

            } else {

                $message = "Fields cannot be empty";


            }


        } else {
            $message = "";
        }





?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>EMPLOYEE REGISTER TEST</h1>
                    <form role="form" action="employee_registration.php" method="post" id="login-form" autocomplete="off">

                        <h6 class="text-center"><?php echo $message ?></h6>

                        <div class="form-group">
                            <label for="firstname" class="sr-only">Nombre</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Apellidos</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Nombre de Usuario</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Usuario">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Correo Electronico</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@mail.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
