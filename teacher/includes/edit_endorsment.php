<?php

    if(isset($_GET['p_id'])){
        $the_end_id = $_GET['p_id'];

    }

    $query = 
    "SELECT * 
    FROM endorsments 
    WHERE end_id = $the_end_id";

    $select_endorsments_by_id = mysqli_query($connection, $query); //Pass the connection and query

    while ($row = mysqli_fetch_assoc($select_endorsments_by_id)) {
        $end_id                     = $row['end_id'];
        $end_student_name   	    = $row['end_student_name'];
        $end_student_group          = $row['end_student_group'];
        $end_student_gender         = $row['end_student_gender'];
        $end_student_number         = $row['end_student_number'];
        $end_student_birthdate      = date("d-M-Y", strtotime($row['end_student_birthdate'])); //$row['end_date'];
        $end_student_parent         = $row['end_student_parent'];
        $end_reasons                = $row['end_reasons'];
        $end_procedures             = $row['end_procedures'];
        $end_historial              = $row['end_historial'];
        $end_situation_level        = $row['end_situation_level'];
        $end_teacher_id             = $row['end_teacher_id'];
        $end_date                   = date("d-M-Y h:i:s A", strtotime($row['end_date']));
        $end_employee_id            = $row['end_employee_id'];
        $end_revision_date          = date("d-M-Y h:i:s A", strtotime($row['end_revision_date']));
        $end_status                 = $row['end_status'];
    
    }

    if(isset($_POST['update_endorsment'])){

        $end_student_name       = $_POST['end_student_name'];
        $end_student_group      = $_POST['end_student_group'];
        $end_student_gender     = $_POST['end_student_gender'];
        $end_student_number     = $_POST['end_student_number'];
        $end_student_birthdate  = $_POST['end_student_birthdate'];
        $end_student_parent     = $_POST['end_student_parent'];
        $end_reasons            = $_POST['end_reasons'];
        $end_procedures         = $_POST['end_procedures'];
        $end_historial          = $_POST['end_historial'];
        $end_situation_level    = $_POST['end_situation_level'];


        $query = 
        "UPDATE endorsments SET 
            end_student_name        = '{$end_student_name}', 
            end_student_group       = '{$end_student_group}', 
            end_student_gender      = '{$end_student_gender}', 
            end_student_number      = '{$end_student_number}', 
            end_student_birthdate   = '{$end_student_birthdate}', 
            end_student_parent      = '{$end_student_parent}', 
            end_reasons             = '{$end_reasons}', 
            end_procedures          = '{$end_procedures}',
            end_historial           = '{$end_historial}', 
            end_situation_level     = '{$end_situation_level}'
        WHERE end_id = '{$the_end_id}' ";

        $update_end = mysqli_query($connection, $query);

        confirmQuery($update_end);

        echo "<p class='bg-success'>Referido Actualizado. <a target='_blank' rel='noopener noreferrer' href='../endorsment_tab.php?p_id={$the_end_id}'>Ver Referido </a>
         o <a href='endorsments.php'>Editar Otros Referidos</a></p>";


    }//Isset

?>


                                <!-- enctype sends different form data (images) -->
<form action="" method="post">

        <h1 class="page-header" >
            Editar Referido  
            <small><?php echo '#' .$end_id; ?></small>
        </h1>



            <!-- Endorsment status -->
    	    <div class="form-inline">
                <div class="form-group">
                    <label for="end_status">Estatus del Referido</label>
                    <select disabled class="form-control" name="end_status" id="">   
                        <option value='<?php echo $end_status ?>'><?php echo $end_status; ?></option>
<?php
                    if($end_status == 'Pendiente') {
                        echo "<option value='Verificado'>Verificado</option>";
                        echo "<option value='Completado'>Completado</option>";
                    } else if($end_status == 'Verificado') {
                        echo "<option value='Pendiente'>Pendiente</option>";
                        echo "<option value='Completado'>Completado</option>";
                    } else{
                        echo "<option value='Pendiente'>Pendiente</option>";
                        echo "<option value='Verificado'>Verificado</option>";
                    }
?>
                </select>
                </div>
            </div> <br>



        
            <!-- Student name -->
                <div class="form-group">
                    <label for="end_student_name">Nombre del Estudiante:</label>
                    <input  class="form-control" type='text' name='end_student_name'  value='<?php echo $end_student_name; ?>'>
                </div> <br>

                     
            <!-- Gender and birthdate -->
            <div class="form-inline">
            <div class="form-group">
                    <label for="end_student_gender">Genero: </label>
                    <select  class="form-control" name='end_student_gender' >
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="end_student_birthdate">Fecha de Nacimiento: </label>
                    <input  class="form-control" type='date' name='end_student_birthdate' value='<?php echo date('Y-m-d',strtotime($end_student_birthdate)); ?>'>
                </div>
            </div> <br>


            <!-- Group and SIE Number -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_group">Grupo: </label>
                    <input  class="form-control" type='text' name='end_student_group' value='<?php echo $end_student_group; ?>'>
                </div>
                <div class="form-group">
                    <label for="end_student_number">Numero de SIE: </label>
                    <input  class="form-control" type='text' name='end_student_number' value='<?php echo $end_student_number; ?>'>
                </div>
            </div> <br>


             <!-- Parent name -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_parent">Nombre del Padre y/o Encargado:</label>
                    <input  class="form-control" type='text' name='end_student_parent' size='30' value='<?php echo $end_student_parent; ?>'>
                </div>
            </div>

            
            <hr>
            
            <!-- Endorsment info -->
            <div class="form-group">
                <label for="end_reasons">Razones para Referir: </label>
                <textarea  class="form-control"  id="end_reasons" name="end_reasons" rows='7'>
                    <?php echo $end_reasons ?>
                </textarea>
            </div> <br>

            <div class="form-group">
                <label for="end_procedures">
                    Acciones tomadas por el/la Maestr@ y/u otro peronal antes de referir al estudiante:
                </label>
                <textarea  class="form-control"  id="end_procedures" name="end_procedures" rows='7'>
                    <?php echo $end_procedures ?>
                </textarea>
            </div> <br>

            <div class="form-inline">

            <div class="form-group">
                <label for="end_historial">Historial</label>
                <select class="form-control" name="end_historial" id="">   
                    <option value='<?php echo $end_historial ?>'><?php echo $end_historial; ?></option>
<?php
                    if($end_historial == 'Inicial') {
                        echo "<option value='Revision'>Revision</option>";
                        
                    } else {
                        echo "<option value='Inicial'>Inicial</option>";
                    }
?>
                </select>
            </div>
            <div class="form-group">
                <label for="end_situation_level">Nivel de Situacion</label>
                <select class="form-control" name="end_situation_level" id="">   
                    <option value='<?php echo $end_situation_level ?>'><?php echo $end_situation_level; ?></option>
<?php
                            if($end_historial == 'Leve') {
                                echo "<option value='Moderada'>Moderada</option>";
                                echo "<option value='Severo'>Severo</option>";
                                
                            }else if($app_status == 'Moderada') {
                                echo "<option value='Leve'>Leve</option>";
                                echo "<option value='Severo'>Severo</option>";
                            } else {
                                echo "<option value='Leve'>Leve</option>";
                                echo "<option value='Moderada'>Moderada</option>";
                                
                            }
?>
                    </select>
                </div>
            </div>
        
            <hr>

            <!-- Teacher name -->
                <div class="form-inline">
                    <div class="form-group">
                    <label for="end_teacher_id">Maestro que refiere: </label>
                    <input disabled class="form-control" name="app_employee_id" 
                    value="<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?>"id="">
                    </div> <!-- Teacher Name -->
                    </div>

                    <div class="form-group">
                        <label for="end_date">Fecha del referido:</label>
                        <input disabled class="form-control" type='text' name='end_date' value='<?php echo $end_date; ?>'>
                    </div>
                </div> <br>

            <!-- Employee name -->
            <div class="form-group">
                <label for="employee">Verificado Por: </label>
<?php
            $query = "SELECT * FROM employees WHERE emp_id = $end_employee_id";
            $select_employees = mysqli_query($connection, $query); //Pass the connection and query

            // confirmQuery($select_employees);

            while ($row = mysqli_fetch_assoc($select_employees)) {
            $emp_id = $row['emp_id'];
            $emp_firstname = $row['emp_firstname'];
            $emp_lastname = $row['emp_lastname'];
            $emp_role = $row['emp_role'];
            
                echo "<input disabled class='form-control'  type='text' name='end_employee_id' size='35' 
                value='{$emp_role} - {$emp_firstname} {$emp_lastname}'>";
            }
?>
                </div>

            <div class="form-inline">
            
                <div class="form-group">
                        <label for="end_revision_date">Fecha de revisión:</label>
                        <input disabled class="form-control" type='text' name='end_revision_date' value='<?php echo $end_revision_date; ?>'>
                </div>
            </div> <br>
            
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_endorsment" value="Actualizar Referido">
    </div>

</form>