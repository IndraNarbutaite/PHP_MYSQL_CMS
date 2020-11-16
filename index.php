
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

                <hr>
                <hr>

            <?php 

                // Pagination query.
                $post_count_query = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_count_query);
                $count = mysqli_num_rows($find_count);

                // Displays number of posts per page.
                $per_page = 5;

                // Round the count to the next highest value.
                $count = ceil($count / $per_page);


                // Pagination math.

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }

                if ($page == "" || $page == 1) {
                    $page_inc = 0;
                } else {
                    $page_inc = ($page * $per_page) - $per_page;
                }

            ?>

            <?php 

                $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_inc, $per_page";
                $show_data_from_posts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($show_data_from_posts)) {
                    
                    $post_id        =   $row['post_id'];
                    $post_title     =   $row['post_title'];
                    $post_user      =   $row['post_user'];
                    $post_date      =   $row['post_date'];
                    $post_image     =   $row['post_image'];
                    $post_status    =   $row['post_status'];
                    $post_content   =   substr($row['post_content'], 0, 500);

            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive img-thumbnail" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <!-- <p><?php // echo $post_content; ?></p><br> -->
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">View Post <span class="glyphicon glyphicon-chevron-right"></span></a>

                <!-- <br><br> -->
                <hr><br>

                <?php

                    }

                ?>

                <hr>

                <!-- Pager -->
                <ul class="pager">
                    
                    <?php 

                        for ($i = 1; $i <= $count; $i++) { 
                            
                            if ($i == $page) {
                                
                                echo "<strong><li><a href='index.php?page=$i' style='font-size: 1.05em;' class = 'active_link'>$i</a></li></strong> ";

                            } else {

                                echo "<strong><li><a href='index.php?page=$i' style='font-size: 1.05em;'>$i</a></li></strong> ";

                            }

                        }

                    ?>

                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        

<!-- Footer -->
<?php include "includes/footer.php"; ?>