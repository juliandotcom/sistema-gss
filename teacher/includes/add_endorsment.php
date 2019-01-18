
<?php
    
    if(isset($_POST['create_endorsment'])) {

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

        $end_teacher_id          = $_SESSION['id'];

        $query = 
        "INSERT INTO 
        endorsments(
            end_student_name, 
            end_student_group,
            end_student_gender, 
            end_student_number, 
            end_student_birthdate, 
            end_student_parent,
            end_reasons,
            end_procedures,
            end_historial,
            end_situation_level,
            end_teacher_id,
            end_date,
            end_status) 
        VALUES(
            '{$end_student_name}', 
            '{$end_student_group}',
            '{$end_student_gender}', 
            '{$end_student_number}',
            '{$end_student_birthdate}',
            '{$end_student_parent}',
            '{$end_reasons}',
            '{$end_procedures}',
            '{$end_historial}',
            '{$end_situation_level}',
            '{$end_teacher_id}',
             now(),
            'Pendiente')";

    $create_post_query = mysqli_query($connection, $query);

      confirmQuery($create_post_query);

      //Checks the last ID created
      $the_post_id = mysqli_insert_id($connection);

      echo "<p class='bg-success'>Referido Creado. <a target='_blank' rel='noopener noreferrer' href='../endorsment_tab.php?p_id={$the_post_id}'>Ver Referido </a>
       o <a href='endorsments.php'>Ver Otros Referidos</a></p>";

    }
?>


<!-- enctype sends different form data (images) -->
<form action="" method="post">
 
                <h1 class="page-header" >
                    Crear Referido
                </h1>  

        
            <!-- Student name -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_name">Nombre del Estudiante:</label>
                    <input  class="form-control" type='text' name='end_student_name' >
                </div>
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
                    <input  class="form-control" type='date' name='end_student_birthdate' >
                </div>
            </div> <br>


            <!-- Group and SIE Number -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_group">Grupo: </label>
                    <input  class="form-control" type='text' name='end_student_group' >
                </div>
                <div class="form-group">
                    <label for="end_student_number">Numero de SIE: </label>
                    <input  class="form-control" type='text' name='end_student_number' >
                </div>
            </div> <br>


             <!-- Parent name -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_parent">Nombre del Padre y/o Encargado:</label>
                    <input  class="form-control" type='text' name='end_student_parent' size='30' >
                </div>
            </div>

            
            <hr>
            
            <!-- Endorsment info -->
            <div class="form-group">
                <label for="end_reasons">Razones para Referir: </label>
                <textarea  class="form-control"  id="end_reasons" name="end_reasons" rows='7'></textarea>
            </div> <br>

            <div class="form-group">
                <label for="end_procedures">
                    Acciones tomadas por el/la Maestr@ y/u otro peronal antes de referir al estudiante:
                </label>
                <textarea  class="form-control"  id="end_procedures" name="end_procedures" rows='7'></textarea>
            </div> <br>

            <div class="form-inline">

                <div class="form-group">
                    <label for="end_historial">Historial</label>
                    <select class="form-control" name="end_historial" id="">   
                        <option value='Inicial'>Inicial</option>";
                        <option value='Revision'>Revision</option>";
                    </select>
                </div>
                <div class="form-group">
                    <label for="end_situation_level">Nivel de Situacion</label>
                    <select class="form-control" name="end_situation_level" id=""> 
                        <option value='Leve'>Leve</option>";
                        <option value='Moderada'>Moderada</option>";
                        <option value='Severo'>Severo</option>";
    
                    </select>
                </div>
            </div>
        
            <hr>

            <!-- Teacher name -->
                <div class="form-inline">
                    <div class="form-group">
                    <label for="end_teacher_id">Sometido Por: </label>
                    <input disabled class="form-control" name="end_teacher_id" 
                value="<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?>"id="">
                    </div> <!-- Teacher Name -->

                </div> <br>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_endorsment" value="Crear Referido">
    </div>


</form>