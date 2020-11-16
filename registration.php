<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navbar.php"; ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <br>
                <hr id="hr-style">
                <div class="col-xs-6 col-xs-offset-3">

                    <div class="form-wrap">
                        <h1><i class="fa fa-fw fa-edit"></i> Register</h1>
                        <hr id="hr-style">
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                        <?php 
                        

                            if (isset($_POST['submit'])) {
                                
                                $username = mysqli_real_escape_string($connection, $_POST['username']);
                                $email    = mysqli_real_escape_string($connection, $_POST['email']);
                                $password = mysqli_real_escape_string($connection, $_POST['password']);

                                if (!empty($username) && !empty($email) && !empty($password)) {
                                    
                                    $query = "SELECT randSalt FROM users";
                                    $select_randSalt_query = mysqli_query($connection, $query);

                                    if (!$select_randSalt_query) {
                                        die('Sorry! Query failed. ' . mysqli_error($connection));
                                    }

                                    $row  =  mysqli_fetch_assoc($select_randSalt_query);
                                    $salt =  $row['randSalt'];

                                    // Encrypting password.
                                    $password = crypt($password, $salt);

                                    $query  = "INSERT INTO users(username, user_email, user_password, user_role) ";
                                    $query .= "VALUES ('$username', '$email', '$password', 'Subscriber')";

                                    $register_query = mysqli_query($connection, $query);
                                    if (!$register_query) {
                                        die('Sorry! Query failed. ' . mysqli_error($connection));
                                    } else {
                                        echo "<div class='text-center alert alert-success' role='alert'>
                                                    Your registration was <b>successful!</b>
                                              </div>";
                                    }

                                } else {

                                    echo "<div class='text-center alert alert-danger' role='alert'>
                                                <b>Oh Snap!</b> Fill all the fields.
                                          </div>";

                                }

                            }

                        ?>

                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter desired username">
                            </div>
                             <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                             <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Enter new password">
                            </div>
                            <hr id="hr-style">
                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Sign Up">
                        </form>
                     
                    </div>

                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <br><br>
    <hr id="hr-style">

    <!-- Footer -->
    <?php include "includes/footer.php";?>