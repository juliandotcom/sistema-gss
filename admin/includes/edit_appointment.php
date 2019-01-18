<?php

    if(isset($_GET['p_id'])){
        $the_app_id = $_GET['p_id'];

    }

    $query = 
    "SELECT * 
    FROM appointments 
    WHERE app_id = $the_app_id";

    $select_apps_by_id = mysqli_query($connection, $query); //Pass the connection and query

    while ($row = mysqli_fetch_assoc($select_apps_by_id)) {
        $app_id                 = $row['app_id'];
        $app_category_id        = $row['app_category_id'];
        $app_date               = $row['app_date'];
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
    
    }

    if(isset($_POST['update_appointment'])){

        $app_status             = $_POST['app_status'];
        $app_category_id        = $_POST['app_category_id'];
        $app_parent_name        = $_POST['app_parent_name'];
        $app_student_name       = $_POST['app_student_name'];
        $app_student_group      = $_POST['app_student_group'];
        $app_phone_number       = $_POST['app_phone_number'];
        $app_mobile_number      = $_POST['app_mobile_number'];
        $app_day_of_week        = $_POST['app_day_of_week'];
        $app_time_of_day        = $_POST['app_time_of_day'];
        $app_parent_comment     = $_POST['app_parent_comment'];
        $app_employee_id        = $_POST['app_employee_id'];
        $app_employee_comment   = $_POST['app_employee_comment'];
        

        $query = 
        "UPDATE appointments SET 
            app_status              = '{$app_status}', 
            app_category_id         = '{$app_category_id}',
            app_parent_name         = '{$app_parent_name}', 
            app_student_name        = '{$app_student_name}',
            app_student_group       = '{$app_student_group}',
            app_mobile_number       = '{$app_mobile_number}',
            app_phone_number        = '{$app_phone_number}',
            app_day_of_week         = '{$app_day_of_week}',
            app_time_of_day         = '{$app_time_of_day}',
            app_parent_comment      = '{$app_parent_comment}',
            app_employee_id         = '{$app_employee_id}',
            app_employee_comment    = '{$app_employee_comment}' 
        WHERE app_id            = '{$the_app_id}' ";

        $update_appointment = mysqli_query($connection, $query);

        confirmQuery($update_appointment);

        echo "<p class='bg-success'>Cita Actualizada. 
        <a target='_blank' rel='noopener noreferrer' href='../appointment_tab.php?p_id={$the_app_id}'>Ver Cita </a>
         or <a href='appointments.php'>Editar Mas Citas</a></p>";


    }//Isset

?>


<form action="" method="post">

            <!-- Appointment status -->
            <!-- <div>
                <label for="app_status">Estatus de Cita: </label>
                <select name="app_status" id="">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Verificado">Verificado</option>
                    <option value="Completado">Completado</option>
                </select>
            </div> -->

            <!-- Appointment status -->
            <div class="form-group">
                <label for="app_status">Estatus de Cita</label>
                <select name="app_status" id="">   
                    <option value='<?php echo $app_status ?>'><?php echo $app_status; ?></option>
<?php
                    if($app_status == 'Pendiente') {
                        echo "<option value='Verificado'>Verificado</option>";
                        echo "<option value='Completado'>Completado</option>";
                    } else if($app_status == 'Verificado') {
                        echo "<option value='Pendiente'>Pendiente</option>";
                        echo "<option value='Completado'>Completado</option>";
                    } else{
                        echo "<option value='Pendiente'>Pendiente</option>";
                        echo "<option value='Verificado'>Verificado</option>";
                    }
?>
            </select>
        </div>

            <br>
        
            <!-- Parent name -->
            <div>
                <label for="parent_name">Padre y/o Encargado:</label>
                <input  type='text' name='app_parent_name' class='form-control' value='<?php echo $app_parent_name; ?>'>
            </div>

            <br>
            
            <!-- Name and group -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="student_name">Nombre del estudiante:</label>
                    <input class='form-control' type='text' name='app_student_name' value='<?php echo $app_student_name; ?>'>
                </div>
                
                <div class="form-group">
                    <label for="student_group">Grupo:</label>
                    <input class='form-control' type='text' name='app_student_group' value='<?php echo $app_student_group; ?>'>
                </div>
            </div>
                  
            <br>

            <!-- Phone Numbers -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="student_name">Telefono Movil:</label>
                    <input class='form-control' type='tel' name='app_mobile_number' maxlength="12" id='phone_number' value='<?php echo $app_mobile_number; ?>'>
                </div>

                <div class="form-group">
                    <label for="student_group">Telefono Residencial:</label>
                    <input class='form-control' type='tel' name='app_phone_number' maxlength="12" id='phone_number' value='<?php echo $app_phone_number; ?>'>
                </div>
            </div>


            <hr>
            
            <!-- Appointment info -->


            <!-- Appointment Selected Date -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="app_day_of_week">Fecha Deseada de Cita: <?php echo $app_day_of_week ?></label>
                    <input type='date' name='app_day_of_week' value='<?php echo date('Y-m-d',strtotime($app_day_of_week)); ?>'>
                </div>

                <div class="form-group">
                    <label for="app_time_of_day">Hora Deseada: </label>
                    <select name="app_time_of_day" id="">
                        <option value="<?php echo $app_time_of_day ?>"><?php echo $app_time_of_day; ?></option>
                        <option value="8:00 A.M.">8:00 A.M.</option>
                        <option value="9:00 A.M.">9:00 A.M.</option>
                        <option value="10:00 A.M.">10:00 A.M.</option>
                        <option value="1:00 P.M.">1:00 P.M.</option>
                        <option value="2:00 P.M.">2:00 P.M.</option>
                    </select>
                </div>
            </div> <!-- Appointment Selected Date -->


            <div class="form-group">
                <label for="categories">Categorias</label>
                <select class="form-control" name="app_category_id" id="">
<?php 

            $query = 
            "SELECT * 
            FROM categories";
            $select_categories = mysqli_query($connection, $query); //Pass the connection and query

            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if($cat_id == $post_category_id){
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                }else {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }//while loop
?>
                </select>
            </div>

            <hr>

            <div class="form-group">
                <label for="app_parent_comment">Comentarios del Padre y/o Encargado (Opcional): </label>
                <textarea  type="text" class="form-control" name="app_parent_comment"  cols="20" rows="5" >
                <?php echo $app_parent_comment; ?>
                </textarea>
            </div>


            <hr>

            <!-- Employee name -->
            <!-- <div class="form-group">
                <label for="employee">Verificado Por: </label>
                <input type='text' name='employee' size='50'>
            </div> -->

            
            <div class="form-group">
                <label for="app_employee_id">Verificado Por: </label>
                <select class="form-control" name="app_employee_id" id="">
<?php 
            $query = 
            "SELECT * 
            FROM employees";
            $select_employees = mysqli_query($connection, $query); //Pass the connection and query

            confirmQuery($select_employees);

            while ($row = mysqli_fetch_assoc($select_employees)) {
            $emp_id = $row['emp_id'];
            $emp_fullname = $row['emp_firstname'] . ' ' . $row['emp_lastname'];
            $emp_role = $row['emp_role'];

                if($emp_id == $app_employee_id){

                    echo "<option selected value='{$emp_id}'>{$emp_role} - {$emp_fullname}</option>";
                
                }else {
        
                    echo "<option value='{$emp_id}'>{$emp_role} - {$emp_fullname}</option>";
                }
            }//while loop
?>   
                </select>
            </div> <!-- Category -->



            <!-- Employee comments -->
            <div class="form-group">
            <label for="app_employee_comment">Comentarios Empledo de Apoyo:</label>
            <textarea  type="text" class="form-control" name="app_employee_comment" cols="20" rows="5">
            <?php echo $app_employee_comment; ?>
            </textarea>
            </div>


            <!-- Submit button -->
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_appointment" value="Actualizar Cita">
            </div>




</form>