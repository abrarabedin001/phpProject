<?php

	include('config/db_connect.php');

	$id= $password= '';
	$errors = array('id'=>'', 'password' => '' );

	if(isset($_POST['submit'])){


        // check name
		if(empty($_POST['id'])){
			$errors['id'] = 'A id is required';
		} else{
			$id = $_POST['id'];
            // die($title);
            
			if(!preg_match('/^[0-9]+$/', $id)){
				$errors['id'] = 'id must be letters and spaces only';
			}
		}


        // check password
		if(empty($_POST['password'])){
			$errors['password'] = 'A password is required';
		} else{
			$password = $_POST['password'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $password)){
				$errors['password'] = 'password must be letters and spaces only';
			}
		}

	

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
            $id = mysqli_real_escape_string($conn, $_POST['id']);

			$password = mysqli_real_escape_string($conn, $_POST['password']);

			// create sql
			$sql = "Select id from users where id='$id' and password='$password'";
            // die($sql);
            $result = mysqli_query($conn, $sql);
            // echo($result);
            // $printable = mysqli_fetch_array($result);
        
            // fetch the resulting rows as an array
            $printable = mysqli_fetch_all($result,MYSQLI_ASSOC);
            print_r($printable);
            // free result from memory
            if(count($printable)>0){
                header('Location:home.php');
            }
        
            // close connection
            mysqli_close($conn);

			// save to db and check
			if(mysqli_fetch_all($result,MYSQLI_ASSOC)){
				// success
				header('Location:home.php');
			} else {
				echo"something";
				echo 'query error: '. mysqli_error($conn);
			}

			
		}


	} // end POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Log in</h4>
    <form class="white" action="login.php" method="POST">
        
        <label>Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

        <label>Password</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
        <div class="red-text"><?php echo $errors['password']; ?></div>
        
        
        
        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>


    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>