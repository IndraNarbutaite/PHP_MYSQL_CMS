
<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navbar.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- <h1 class="page-header"> -->
                <h1>
                    #Our-Blogs
                    <small> &nbsp;Team Devs</small>
                </h1>

            <?php 

                if (isset($_GET['cat_id'])) {
                    $caught_cat_id  = $_GET['cat_id'];
                }

                $query = "SELECT * FROM posts WHERE post_category_id = $caught_cat_id ORDER BY post_id DESC";
                $show_data_from_posts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($show_data_from_posts)) {
                    
                    $post_id        =   $row['post_id'];
                    $post_title     =   $row['post_title'];
                    $post_author    =   $row['post_author'];
                    $post_date      =   $row['post_date'];
                    $post_image     =   $row['post_image'];
                    $post_content   =   substr($row['post_content'], 0, 500);;

            ?>

                <hr>
                <hr>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p><br>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <?php } ?>

                <hr>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<!-- Footer -->
<?php include "includes/footer.php"; ?>