<?php

        if(isset($_POST['checkBoxArray'])) {
            
            foreach($_POST['checkBoxArray'] as $postValueId ){
                
        $bulk_options = $_POST['bulk_options'];
                
                switch($bulk_options) {
                case 'published':
                
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                
        $update_to_published_status = mysqli_query($connection,$query);       
        confirmQuery($update_to_published_status);

                break;        
                    
                    case 'draft':
                
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
                
        $update_to_draft_status = mysqli_query($connection,$query);
                    
        confirmQuery($update_to_draft_status);

                break;
                            
                    case 'delete':
                
        $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
                
        $update_to_delete_status = mysqli_query($connection,$query);
                    
        confirmQuery($update_to_delete_status);
                
                break;

                    case 'clone':

                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                    $select_post_query = mysqli_query($connection, $query);
        
                    while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title         = $row['post_title'];
                    $post_category_id   = $row['post_category_id'];
                    $post_date          = $row['post_date']; 
                    $post_user        = $row['post_user'];
                    $post_status        = $row['post_status'];
                    $post_image         = $row['post_image'] ; 
                    $post_tags          = $row['post_tags']; 
                    $post_content       = $row['post_content'];
                    

                }

                        
            $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_status) ";
                    
            $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

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
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

        </div>
         

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Users</th>
                    <th>Titles </th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <!-- <th>Comments</th> -->
                    <th>Date</th>
                    <th>Vews Count</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
                <tbody>

<?php

                        
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $select_posts = mysqli_query($connection, $query); //Pass the connection and query


    while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    // $post_user   = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    // $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];

    echo "<tr>";
?>

 <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

<?php
    echo "<td>$post_id</td>";

    if(!empty($post_user)) {

        echo "<td>$post_user</td>";


   }

    echo "<td>$post_title</td>";


    $query = "SELECT * FROM posts_categories WHERE post_cat_id = {$post_category_id} ";
    $select_categories_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id =  $row['post_cat_id'];
        $cat_title = $row['post_cat_title'];
        
        echo "<td>{$cat_title}</td>";

    }//While loop


    echo "<td>$post_status</td>";
    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
    echo "<td>$post_tags</td>";
    // echo "<td>$post_comment_count</td>";
    echo "<td>$post_date</td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset the views count of this post?');\" 
    href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
    // echo "<td>{$post_views_count}</td>";
    echo "<td><a class='btn btn-primary' target='_blank' rel='noopener noreferrer' href='../post.php?p_id={$post_id}'>View Post</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>"; //the & divide values
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?');\" 
            href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "</tr>";

    }//while

?>
                   
           
                </tbody>
                </table>
    </form>


<?php

    if(isset($_GET['delete'])){

        $the_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }



    if(isset($_GET['reset'])){
    
        $the_post_id = $_GET['reset'];
        
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_post_id  ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: posts.php");
        
        
    }


?>