
<nav class="navbar navbar-inverse navbar-fixed-top animated fadeIn" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-uppercase" href="index.php" style="font-weight: bold;">Indra Dev CMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

                <!-- PHP for displaying the categories dynamically for the database -->
                <!-- <?php 

                    $query = "SELECT * FROM categories";
                    $show_data_from_categories = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($show_data_from_categories)) {
                        $cat_title = $row['cat_title'];

                ?>

                <li>
                    <a href="#" class="text-uppercase"><?php echo $cat_title; ?></a>
                </li>

                <?php } ?> -->

                <li>
                    <a href="registration.php" class="text-uppercase" style="font-size: 1.15em; font-weight: bold;">Sign Up</a>
                </li>

                <li>
                    <a href="admin" class="text-uppercase" style="color: #f5f5f5; padding: 7px 15px 0px 8px;"><button class="btn btn-primary" type="submit" style="margin: 0px;"> &nbsp;ADMIN</button></a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
    
</nav>