<?php

        if(isset($_POST['checkBoxArray'])) {
            
            foreach($_POST['checkBoxArray'] as $endorsmentValueId ){
                
        $bulk_options = $_POST['bulk_options'];
                
                switch($bulk_options) {
                case 'published':
                
        $query = "UPDATE endorsments SET end_status = '{$bulk_options}' WHERE end_id = {$endorsmentValueId}  ";
                
        $update_to_published_status = mysqli_query($connection,$query);       
        confirmQuery($update_to_published_status);

                break;        
                    
                    case 'draft':
                
        $query = "UPDATE endorsments SET end_status = '{$bulk_options}' WHERE end_id = {$endorsmentValueId}  ";
                
        $update_to_draft_status = mysqli_query($connection,$query);
                    
        confirmQuery($update_to_draft_status);

                break;
                            
                    case 'delete':
                
        $query = "DELETE FROM endorsments WHERE end_id = {$endorsmentValueId}  ";
                
        $update_to_delete_status = mysqli_query($connection,$query);
                    
        confirmQuery($update_to_delete_status);
                
                break;

                    case 'clone':

                    $query = "SELECT * FROM endorsments WHERE end_id = '{$endorsmentValueId}' ";
                    $select_end_query = mysqli_query($connection, $query);
        
                    while ($row = mysqli_fetch_array($select_end_query)) {
                        $end_id                 = $row['end_id'];
                        $end_student_name       = $row['end_student_name'];
                        $end_student_group      = $row['end_student_group'];
                        $end_student_gender     = $row['end_student_gender'];
                        $end_student_number     = $row['end_student_number'];
                        $end_student_birthdate  = $row['end_student_birthdate'];
                        $end_student_parent     = $row['end_student_parent'];
                        $end_reasons            = $row['end_reasons'];
                        $end_procedures         = $row['end_procedures'];
                        $end_historial          = $row['end_historial'];
                        $end_situation_level    = $row['end_situation_level'];
                        $end_status             = $row['end_status'];
                        $end_employee_id        = $row['end_employee_id'];
                        $end_teacher_id         = $row['end_teacher_id'];
                        $end_revision_date      = $row['end_revision_date'];
                }

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
                    end_employee_id,
                    end_status,
                    end_revision_date) 
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
                    '{$end_employee_id}',
                    '{$end_status}',
                    '{$end_revision_date}')";

                        $copy_query = mysqli_query($connection, $query);   

                    if(!$copy_query ) {

                        die("QUERY FAILED" . mysqli_error($connection));
                    }   
                        
                        break;
                }
            } 
        }


?>


<form action="" method="post">


<table class="table table-bordered table-hover">


        <div id="bulkOptionContainer" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div> 

        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="endorsments.php?source=add_endorsment">Add New</a>

        </div>
         

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Fecha Sometido</th>
                    <th>Estudiantes</th>
                    <th>Grupo</th>
                    <th>Sometido Por</th>
                    <th>Historial</th>
                    <th>Nivel</th>
                    <th>Fecha Revision</th>
                    <th>Estatus</th>
                    <th>Ver Cita</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
                <tbody>

<?php

    $teacher_id = $_SESSION['id'];
                        
    $query = 
    "SELECT * 
    FROM endorsments
    WHERE end_teacher_id = '{$teacher_id}'
    ORDER BY end_id DESC";
    $select_endorsments = mysqli_query($connection, $query); //Pass the connection and query


    while ($row = mysqli_fetch_assoc($select_endorsments)) {
    $end_id                 = $row['end_id'];
    $end_date               = date("d-M-Y h:i:s A", strtotime($row['end_date']));
    $end_student_name       = $row['end_student_name'];
    $end_student_group      = $row['end_student_group'];
    $end_teacher_id         = $row['end_teacher_id'];
    $end_historial          = $row['end_historial'];
    $end_situation_level    = $row['end_situation_level'];
    $end_revision_date      = date("d-M-Y h:i:s A", strtotime($row['end_revision_date']));
    $end_status             = $row['end_status'];

    echo "<tr>";
?>

 <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $end_id; ?>'></td>

<?php
    //endorsment ID
    echo "<td>$end_id</td>";

    //Date of Creation
    echo "<td>$end_date</td>";

    //Name of Student
    echo "<td>$end_student_name</td>";

    echo "<td>$end_student_group</td>";

    //Employee fullname and group
    $query = "SELECT * FROM teachers WHERE tea_id = $end_teacher_id";
    $select_teachers = mysqli_query($connection, $query); //Pass the connection and query

    confirmQuery($select_teachers);

    while ($row = mysqli_fetch_assoc($select_teachers)) {
    $tea_id = $row['tea_id'];
    $tea_fullname = $row['tea_firstname'] . ' ' . $row['tea_lastname'];
    $tea_group = $row['tea_group'];
       
        echo "<td><b>{$tea_fullname}</b> - {$tea_group}</td>";

    }

    echo "<td>{$end_historial}</td>";

    //Date of endorsment
    echo "<td>{$end_situation_level}</td>";

    // Date of revision
    echo "<td>$end_revision_date</td>";

    //end Status
    echo "<td>$end_status</td>";

    echo "<td><a class='btn btn-primary' target='_blank' rel='noopener noreferrer' href='../endorsment_tab.php?p_id={$end_id}'>View endorsment</a></td>";
    
    echo "<td><a href='endorsments.php?source=edit_endorsment&p_id={$end_id}'>Edit</a></td>"; //the & divide values
   
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this endorsment?');\" 
            href='endorsments.php?delete={$end_id}'>Delete</a></td>";
    echo "</tr>";

    }//while

?>
                </tbody>
                </table>
    </form>


<?php

    if(isset($_GET['delete'])){

        $the_end_id = $_GET['delete'];

        $query = "DELETE FROM endorsments WHERE end_id = {$the_end_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: endorsments.php");
    }



    if(isset($_GET['reset'])){
    
        $the_end_id = $_GET['reset'];
        
        $query = "UPDATE endorsments SET end_views_count = 0 WHERE end_id = $the_end_id  ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: endorsments.php");
        
        
    }


?>