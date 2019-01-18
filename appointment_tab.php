<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

<?php

if (isset($_GET['p_id'])) {

    $the_app_id = $_GET['p_id'];

    $query = 
    "SELECT * 
    FROM appointments 
    WHERE app_id = $the_app_id";

    $select_all_apps_query = mysqli_query($connection, $query); //Pass the connection and query

    while ($row = mysqli_fetch_assoc($select_all_apps_query)) {
        $app_id                 = $row['app_id'];
        $app_category_id        = $row['app_category_id'];
        $app_date               = date("d-M-Y h:i:s A", strtotime($row['app_date'])); //$row['app_date'];
        $app_parent_name        = $row['app_parent_name'];
        $app_student_name       = $row['app_student_name'];
        $app_student_group      = $row['app_student_group'];
        $app_phone_number       = $row['app_phone_number'];
        $app_mobile_number      = $row['app_mobile_number'];
        $app_day_of_week        = date("d-M-Y", strtotime($row['app_day_of_week']));
        $app_time_of_day        = $row['app_time_of_day'];
        $app_parent_comment     = $row['app_parent_comment'];
        $app_parent_id          = $row['app_parent_id'];
        $app_employee_id        = $row['app_employee_id'];
        $app_employee_comment   = $row['app_employee_comment'];
        $app_status             = $row['app_status'];

            
            //Get the day of the week using PHP's date function.
            $dayOfWeek = date("N", strtotime($app_day_of_week));
            if($dayOfWeek == 1){
                $app_day_name = "lunes, ";
            } else if($dayOfWeek == 2){
                $app_day_name = "martes, ";
            } else if($dayOfWeek == 3){
                $app_day_name = "miercoles, ";
            } else if($dayOfWeek == 4){
                $app_day_name = "jueves, ";
            } else if($dayOfWeek == 5){
                $app_day_name = "viernes, ";
            } else {
                $app_day_name = "";
            }
?>


      <!-- APPOINTMENT SHOWS HERE -->

        <!-- creation date -->
        <h1 class="page-header" >
            Cita creada el 
            <small><span class="glyphicon glyphicon-time"></span><?php echo $app_date; ?></small>
        </h1>

        <form action="">

            <!-- Appointment status -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="app_status">Estatus de Cita: </label>
                    <input disabled class="form-control" type='text' name='app_status' value='<?php echo $app_status; ?>'>
                </div>
            </div>

            <br>
        
            <!-- Parent name -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="parent_name">Pader y/o Encargado:</label>
                    <input disabled class="form-control" type='text' name='parent_name' value='<?php echo $app_parent_name; ?>'>
                </div>
            </div>

            <br>
            
            <!-- Name and group -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="student_name">Nombre del estudiante:</label>
                    <input disabled class="form-control" type='text' name='student_name' value='<?php echo $app_student_name; ?>'>
                </div>
                
                <div class="form-group">
                    <label for="student_group">Grupo:</label>
                    <input disabled class="form-control" type='text' name='student_group' value='<?php echo $app_student_group; ?>'>
                </div>
            </div>
                  
            
            <br>

            <!-- Phone Numbers -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="student_name">Telefono Movil:</label>
                    <input disabled class="form-control" type='text' name='student_name' value='<?php echo $app_mobile_number; ?>'>
                </div> 

                <div class="form-group">
                    <label for="student_group">Telefono Residencial:</label>
                    <input disabled class="form-control" type='text' name='student_group' value='<?php echo $app_phone_number; ?>'>
                </div>
            </div>
            <hr>
            
            <!-- Appointment info -->
            <div class="form-group">
                <h3>
                <p>
                    Cita solicitada para el <b><?php echo $app_day_name . $app_day_of_week; ?></b> 
                    a las <b><?php echo $app_time_of_day; ?></b>
                </p>
                </h3>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="categories">Categoria: </label>
<?php 
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query); //Pass the connection and query

                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];  
                    $cat_title = $row['cat_title'];

                    if($cat_id == $app_category_id){
                        echo "<input disabled class='form-control' name='categories' type='text' value='{$cat_title}'>";
                    }
                }//while loop
?>
            </div> <!-- Category -->

            <hr>

            <div class="form-group">
                <label for="app_parent_comment">Comentarios de Pariente:</label>
                <textarea disabled class="form-control" rows='7'  id="app_parent_comment">
                    <?php echo $app_parent_comment ?>
                </textarea>
            </div>

            <hr>

            <!-- Employee name -->

                


            <div>
                <label for="employee">Verificado Por: </label>
<?php
            $query = "SELECT * FROM employees WHERE emp_id = $app_employee_id";
            $select_employees = mysqli_query($connection, $query); //Pass the connection and query

            // confirmQuery($select_employees);

            while ($row = mysqli_fetch_assoc($select_employees)) {
            $emp_id = $row['emp_id'];
            $emp_firstname = $row['emp_firstname'];
            $emp_lastname = $row['emp_lastname'];
            $emp_role = $row['emp_role'];
            
                echo "<input disabled class='form-control' type='text' name='employee' size='35' 
                value='{$emp_role} - {$emp_firstname} {$emp_lastname}'>";
            }
?>
            </div>

            <div class="form-group">
            <label for="app_employee_comment">Comentarios Empledo de Apoyo:</label>
                <textarea disabled class="form-control" rows='7' id="app_employee_comment">
                    <?php echo $app_employee_comment ?>
                </textarea>
            </div>





        </form>



            
<?php }//while loop 

}//isset p_id   ?>

 





    </div> <!-- col-md-8 -->

    <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar_demo.php"; ?>



</div>
<!-- /.row -->

<hr>

<?php include "includes/footer.php" ?>