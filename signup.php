<?php

	include('config/db_connect.php');

	$id=$email=$username = $name = $username = $password= '';
	$errors = array('id'=>'','name'=>'','username'=>'','email' => '', 'password' => '', 'created_at'=>'' , 'updated_at'=>'' );

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

        // check name
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

        // check userName
		if(empty($_POST['username'])){
			$errors['username'] = 'A username is required';
		} else{
			$username = $_POST['username'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
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
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			// create sql
			$sql = "INSERT INTO users(id,name,username,email,password) VALUES($id,'$name','$username','$email','$password')";
            // die($sql);

			// save to db and check
			if(mysqli_query($conn, $sql)){
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
    <h4 class="center">Sign up</h4>
    <form class="white" action="signup.php" method="POST">
        
        <label>Id</label>
        <input type="text" name="id" value="<?php echo htmlspecialchars($id) ?>">
        <div class="red-text"><?php echo $errors['id']; ?></div>

        <label>Your Email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
        <div class="red-text"><?php echo $errors['name']; ?></div>

        <label>User Name</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
        <div class="red-text"><?php echo $errors['username']; ?></div>

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