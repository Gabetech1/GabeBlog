<?php

    function escape($string){
        
        global $connection;

        return mysqli_real_escape_string($connection, trim($string));
    }


    function users_online(){

            if(isset($_GET['onlineusers'])){
                     global $connection;

                    if(!$connection){
                        
                        session_start();
                        include ("../includes/db.php");

                        $session = session_id();
                        $time = time();
                        $time_out_in_seconds = 05;
                        $time_out = $time - $time_out_in_seconds;
                    
                        $query = "SELECT * FROM users_online WHERE session = '$session'";
                        $send_query = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($send_query);
                        
                    
                        if($count == NULL){
                            $query_2 = "INSERT INTO  users_online(session, time) VALUES('$session','$time')";
                            mysqli_query($connection,$query_2);
                        }
                        else{
                            $query_2 = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
                            mysqli_query($connection,$query_2);
                        }
                        $users_online_query = "SELECT * FROM users_online WHERE time > '$time_out'";
                        $select_users_online = mysqli_query($connection, $users_online_query);
                        echo  $count_users = mysqli_num_rows($select_users_online);
                    }
            }
        
    }

    users_online();


    function confirmQuery($result){
        global $connection;
        if (!$result){
            die("QUERY FAILED. " . mysqli_error($connection));
        }  
    }

     function insert_categories() {

         global $connection;

        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
          //  echo $cat_title;

            if(empty($cat_title)){
                echo "This field should not be empty";
            }
            else{
             //FIND ALL CATEGORIES
                $query = "INSERT INTO categories (cat_title)";
                $query .="VALUES('$cat_title')";
                //echo $query;
                $create_category_query = mysqli_query($connection,$query);

                if(!$create_category_query){
                    die('QUERY FAILED'. mysqli_error($connection));
                }
            }
        } 
     }


     function findAllCategories() {

        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection,$query);
          while($row = mysqli_fetch_assoc($select_categories)){
           $cat_id = $row['cat_id'];
           $cat_title = $row['cat_title'];
       
           echo "<tr>";
           echo "<td>{$cat_id}</td>";
           echo "<td>{$cat_title}</td>";
           echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
           echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
           echo "</tr>";
       }
     }


     function deleteCategories(){
         global $connection;

         if(isset($_GET['delete'])){
            $the_caat_id = $_GET['delete'];
            echo $the_caat_id;
        $query ="DELETE FROM categories WHERE cat_id = {$the_caat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
        }
     }
?>