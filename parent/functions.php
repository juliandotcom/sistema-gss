<?php


/*
    ecape function to clean strings for SQL Injection
*/
function  escape($string) {
    global $connection;
    
        mysqli_real_escape_string($connection, trim($string));
    
}


/*
confirmQuery function
*/
function confirmQuery($result){
    global $connection;

    if(!$result){
        die("QUERY FAILED: " . mysqli_error($connection));
    }
}//confirmQuery()


function insert_categories(){

global $connection;

if(isset($_POST['submit'])) {
        
    //The variable store the submited value
    $cat_title = $_POST['cat_title'];


    //If the value is empty show error message
    if($cat_title == "" || empty($cat_title)) {
        echo "This field should not be empty";

    } else {

    }//Else

    //Query to insert category to the database
    $query = "INSERT INTO categories(cat_title) ";
    $query .= "VALUE('{$cat_title}')";

    //Send the query to mysqli
    $create_category_query = mysqli_query($connection, $query);

    //Check if the query was successful
    if(!$create_category_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}//isset if

}//insert_category()


function findAllCategories(){
global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query); //Pass the connection and query


    while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];  
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";

    }
}//findAllCategories()


function deleteCategories(){
global $connection;
    //DELETE QUERY
    if(isset($_GET['delete'])){

        //Same as $cat_id but with different name
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        
        //Refresh the page
        header("Location: categories.php");

    }

}//deleteCategories()








?>