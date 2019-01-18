
<?php
    
    if(isset($_POST['create_appointment'])) {

    // $post_title = ($_POST['title']);
    
    $app_status             = $_POST['app_status'];
    $app_category_id        = $_POST['app_category_id'];
    // $app_date               = date("d-M-Y h:i:s A", strtotime($row['app_date'])); //$row['app_date'];
    $app_parent_name        = $_POST['app_parent_name'];
    $app_student_name       = $_POST['app_student_name'];
    $app_student_group      = $_POST['app_student_group'];
    $app_phone_number       = $_POST['app_phone_number'];
    $app_mobile_number      = $_POST['app_mobile_number'];
    $app_day_of_week        = $_POST['app_day_of_week'];
    $app_time_of_day        = $_POST['app_time_of_day'];
    $app_parent_comment     = $_POST['app_parent_comment'];
    // $app_parent_id          = $_POST['app_parent_id'];
    $app_employee_id        = $_POST['app_employee_id'];
    // $app_employee_fullname  = $_POST['app_employee_fullname'];
    // $app_employee_role      = $_POST['app_employee_role'];
    $app_employee_comment   = $_POST['app_employee_comment'];
    


    $query = 
    "INSERT INTO 
    appointments(
        app_status, 
        app_category_id,
        app_date, 
        app_parent_name, 
        app_student_name, 
        app_student_group,
        app_mobile_number,
        app_phone_number,
        app_day_of_week,
        app_time_of_day,
        app_parent_comment,
        app_parent_id,
        app_employee_id,
        app_employee_comment) 
    VALUES(
        '{$app_status}', 
        '{$app_category_id}',
         now(),
        '{$app_parent_name}', 
        '{$app_student_name}', 
        '{$app_student_group}',
        '{$app_mobile_number}',
        '{$app_phone_number}',
        '{$app_day_of_week}',
        '{$app_time_of_day}',
        '{$app_parent_comment}',
        '{$app_parent_id}',
        '{$app_employee_id}',
        '{$app_employee_comment}')";

    $create_app_query = mysqli_query($connection, $query);

      confirmQuery($create_app_query);

      //Checks the last ID created
      $the_app_id = mysqli_insert_id($connection);

      echo "<p class='bg-success'>Cita Creada. <a target='_blank' rel='noopener noreferrer' href='../appointment_tab.php?p_id={$the_app_id}'>Ver Cita </a>
       or <a href='appointments.php'>Ver Todas las Citas</a></p>";

    }


?>


<!-- enctype sends different form data (images) -->
<form action="" method="post" >


            <h1 class="page-header" >
                Crear Cita  
                <small> </small>
            </h1>

            <!-- Appointment status -->
            <div>
                <label for="app_status">Estatus de Cita: </label>
                <select name="app_status" class="form-control" id="">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Verificado">Verificado</option>
                    <option value="Completado">Completado</option>
                </select>
            </div>

            <br>
        
            <!-- Parent name -->
            <div>
                <label for="parent_name">Padre y/o Encargado:</label>
                <input  type='text' name='app_parent_name' class='form-control'>
            </div>

            <br>
            
            <!-- Name and group -->
                <div class="form-group">
                    <label for="student_name">Nombre del estudiante:</label>
                    <input class='form-control' type='text' name='app_student_name' >
                </div>
            <br>
                <div class="form-group">
                    <label for="student_group">Grupo:</label>
                    <input class='form-control' type='text' name='app_student_group'>
                </div>
            <!-- Phone Numbers -->
            <div class="form-inline">

                <div class="form-group">
                    <label for="student_name">Telefono Movil:</label>
                    <input class='form-control' type='tel' name='app_mobile_number' maxlength="12" id='phone_number'>
                </div>

                <div class="form-group">
                    <label for="student_group">Telefono Residencial:</label>
                    <input class='form-control' type='tel' name='app_phone_number' maxlength="12" id='phone_number'>
                </div>
            </div>


            <hr>
            
            <!-- Appointment info -->


            <!-- Appointment Selected Date -->
            <div class="form-inline">
            <div class="form-group">
                <label for="app_day_of_week">Fecha Deseada de Cita: </label>
                <input class='form-control' type='date' name='app_day_of_week'>
            </div>

            <div class="form-group">
                <label for="app_time_of_day">Hora Deseada: </label>
                <select class='form-control' name="app_time_of_day" id="">
                    <option value="8:00 A.M.">8:00 A.M.</option>
                    <option value="9:00 A.M.">9:00 A.M.</option>
                    <option value="10:00 A.M.">10:00 A.M.</option>
                    <option value="1:00 P.M.">1:00 P.M.</option>
                    <option value="2:00 P.M.">2:00 P.M.</option>
                </select>
            </div>

            </div>


         

            <div class="form-group">
                <label for="category">Categoria</label>
                <select class='form-control' name="app_category_id" id="">
<?php 

            $query = 
            "SELECT * 
            FROM categories";
            $select_categories = mysqli_query($connection, $query); //Pass the connection and query

            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];  
            $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }//while loop

?>
                    <option value=""></option>
                </select>
            </div> <!-- Category -->

            <hr>

            <div class="form-group">
                <label for="app_parent_comment">Comentarios del Padre y/o Encargado (Opcional): </label>
                <textarea  type="text" class="form-control" name="app_parent_comment"  cols="20" rows="5"></textarea>
            </div>

            <hr>

            <!-- Employee name -->
            <!-- <div class="form-group">
                <label for="employee">Verificado Por: </label>
                <input type='text' name='employee' size='50'>
            </div> -->

            
            <div class="form-group">
                <label for="app_employee_id">Verificado Por: </label>
                <select name="app_employee_id" id="">
                <option value=""></option>
<?php 

            $query = "SELECT * FROM employees";
            $select_employees = mysqli_query($connection, $query); //Pass the connection and query

            confirmQuery($select_employees);

            while ($row = mysqli_fetch_assoc($select_employees)) {
            $emp_id = $row['emp_id'];
            $emp_fullname = $row['emp_firstname'] . ' ' . $row['emp_lastname'];
            $emp_role = $row['emp_role'];
               

                //value='{$emp_role} - {$emp_fullname}'
                echo "<option value='{$emp_id}'>{$emp_role} - {$emp_fullname}</option>";
            }//while loop

?>
                    
                </select>
            </div> <!-- Verificado por -->



            <!-- Employee comments -->
            <div class="form-group">
            <label for="app_employee_comment">Comentarios Empledo de Apoyo:</label>
            <textarea  type="text" class="form-control" name="app_employee_comment" cols="20" rows="5"></textarea>
            </div>


            <!-- Submit button -->
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="create_appointment" value="Crear Cita">
            </div>





        </form>
