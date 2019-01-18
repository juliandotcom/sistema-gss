<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    
            <tbody>    

<?php 
    
    $query = "SELECT * FROM parents";
    $select_parents = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_parents)) {
        $par_id             = $row['par_id'];
        $par_username       = $row['par_username'];
        $par_fullname       = $row['par_firstname'] . ' ' . $row['par_lastname'];
        $par_email          = $row['par_email'];
        
        echo "<tr>";
        
        echo "<td>$par_id </td>";
        echo "<td>$par_username</td>";
        echo "<td>$par_fullname</td>";
        echo "<td>$par_email</td>";     
        
        // echo "<td><a href='pars.php?change_to_admin={$par_id}'>Admin</a></td>";
        // echo "<td><a href='pars.php?change_to_sub={$par_id}'>Subscriber</a></td>";
        echo "<td><a href='parents.php?source=edit_parent&edit_parent={$par_id}'>Edit</a></td>";
        echo "<td><a href='parents.php?delete={$par_id}'>Delete</a></td>";
        echo "</tr>";

    }//While loop


?>

            </tbody>
            </table>
            
            
<?php

if(isset($_GET['change_to_admin'])) {
    
    $the_par_id = $_GET['change_to_admin'];
    
    $query = "UPDATE parents SET par_role = 'admin' WHERE par_id = $the_par_id   ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: parents.php");
     
}





if(isset($_GET['change_to_sub'])){
    
    $the_user_id = $_GET['change_to_sub'];
    
    $query = "UPDATE parents SET par_role = 'subscriber' WHERE user_id = $the_user_id   ";
    $change_to_sub_query = mysqli_query($connection, $query);
    header("Location: users.php");   
}



    if(isset($_GET['delete'])){

        if(isset($_SESSION['user_role'])) {
    
            if($_SESSION['user_role'] == 'admin') {
    
            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
    
            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_user_query = mysqli_query($connection, $query);
            header("Location: users.php");
    
                }   
    
    
            }
       
        
        }

?>     