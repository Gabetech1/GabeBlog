<?php

    if(isset($_GET['edit_user'])){
         $the_user_id = $_GET['edit_user'];


        $query = "SELECT * FROM users WHERE user_id= $the_user_id";
        $select_user_query = mysqli_query($connection,$query);
          while($row = mysqli_fetch_assoc($select_user_query)){
           $user_id = $row['user_id'];
           $username = $row['username'];
           $user_password = $row['user_password'];
           $user_firstname = $row['user_firstname'];
           $user_lastname = $row['user_lastname'];
           $user_email = $row['user_email'];
           $user_image = $row['user_image'];
           $user_role = $row['user_role'];

          }
    ?>

    <?php


if(isset($_POST['edit_user'])){

  $user_firstname = escape($_POST['user_firstname']);
  $user_lastname = escape($_POST['user_lastname']);
  $user_role = escape($_POST['user_role']);
  $username = escape($_POST['username']);
  $user_email = escape($_POST['user_email']);
  $user_password = escape($_POST['user_password']);
  $post_date = date('dd-mm-yyyy');

  if(!empty($user_password)){

    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
    $get_user_query = mysqli_query($connection,$query_password);
    confirmQuery($get_user_query);

    $row = mysqli_fetch_array($get_user_query);

    $db_user_password = $row['user_password'];

    if($db_user_password != $user_password){
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    }
  



  $query = "UPDATE users SET ";
    $query .="user_firstname = '{$user_firstname}', ";
    $query .="user_lastname = '{$user_lastname}', ";
    $query .="user_role = '{$user_role}', ";
    $query .="username = '{$username}', ";
    $query .="user_email = '{$user_email}', ";
    $query .="user_password = '{$hashed_password}'";
    $query .="WHERE user_id = {$the_user_id} ";

    $update_user = mysqli_query($connection, $query);

    confirmQuery($update_user);


    echo "User Updated "."<a href='users.php'>View Users</a>";

}

}

}else{
    header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="user_firstname">Firstname</label>
          <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="lastname">Lastname</label>
          <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
      </div>

      <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php
                    if($user_role == "admin"){
                        echo "<option value='subscriber'>subscriber</option>";
                    }
                    else{
                        echo " <option value='admin'>admin</option>";
                    }
            ?>
           
            
        </select>
      </div>

      <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
      </div>
   
    <!-- <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div> -->

      <div class="form-group">
         <label for="email">Email</label>
          <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="pass">Password</label>
         <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password">
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>


</form>
    