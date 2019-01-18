<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Grupo</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
            
        <tbody>    

<?php 
    
    $query = "SELECT * FROM teachers";
    $select_teachers = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_teachers)) {
        $tea_id             = $row['tea_id'];
        $tea_username       = $row['tea_username'];
        $tea_fullname       = $row['tea_firstname'] . ' ' . $row['tea_lastname'];
        $tea_email          = $row['tea_email'];
        $tea_group          = $row['tea_group'];
        
        echo "<tr>";
        echo "<td>$tea_id </td>";
        echo "<td>$tea_username</td>";
        echo "<td>$tea_fullname</td>";
        echo "<td>$tea_email</td>";
        echo "<td>$tea_group</td>";     
        
        // echo "<td><a href='teas.php?change_to_admin={$tea_id}'>Admin</a></td>";
        // echo "<td><a href='teas.php?change_to_sub={$tea_id}'>Subscriber</a></td>";
        echo "<td><a href='teachers.php?source=edit_teacher&edit_teacher={$tea_id}'>Editar</a></td>";
        echo "<td><a href='teachers.php?delete={$tea_id}'>Eliminar</a></td>";
        echo "</tr>";

    }//While loop

?>

    </tbody>
</table>
            
            
<?php


    if(isset($_GET['delete'])){

        if(isset($_SESSION['role'])) {
    
            if($_SESSION['role'] == 'admin') {
    
            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
    
            $query = "DELETE FROM teachers WHERE tea_id = {$the_user_id} ";
            $delete_user_query = mysqli_query($connection, $query);
            header("Location: teachers.php");
    
                }   
    
    
            }
       
        
        }

?>     