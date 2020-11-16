
	<div class="col-lg-2">
		<!-- Just some space -->
	</div>
	<div class="col-lg-8">

		<?php 

			if (isset($_GET['p_id'])) {
				$post_id = $_GET['p_id'];
			}

			$query = "SELECT * FROM posts WHERE post_id = $post_id";
	        $show_data_from_posts = mysqli_query($connection, $query);

	        while ($row = mysqli_fetch_assoc($show_data_from_posts)) {
	            
	            $post_id 			 =  $row['post_id'];
	            $post_title     	 =  $row['post_title'];
	            $post_user    	 	 =  $row['post_user'];
	            $post_category_id	 =  $row['post_category_id'];
	            $post_date      	 =  $row['post_date'];
	            $post_image     	 =  $row['post_image'];
	            $post_content    	 =  $row['post_content'];
	            $post_tags	    	 =  $row['post_tags'];
	            $post_status    	 =  $row['post_status'];
	            $post_comment_count  =  $row['post_comment_count'];

	        }

	        if (isset($_POST['update'])) {
	        	
	        	$updated_post_title			=	mysqli_real_escape_string($connection, $_POST['title']);
	        	$updated_post_category_id	=	$_POST['post_category_id'];
	        	$updated_post_user			=	mysqli_real_escape_string($connection, $_POST['post_user']);
	        	$updated_post_status		=	$_POST['post_status'];

	        	$updated_post_image			=	$_FILES['image']['name'];
	        	$updated_post_image_temp	=	$_FILES['image']['tmp_name'];

	        	$updated_post_tags			=	mysqli_real_escape_string($connection, $_POST['post_tags']);
	        	$updated_post_content		=	mysqli_real_escape_string($connection, $_POST['post_content']);

	        	move_uploaded_file($updated_post_image_temp, "../images/$post_image");

	        	if (empty($post_image)) {
	        		
	        		$query = "SELECT * FROM posts WHERE post_id = $post_id";
	        		$select_image = mysqli_query($connection, $query);

	        		if (!$select_image) {
	        			die("Query Failed! " . mysqli_error($connection));
	        		}

	        		while ($row = mysqli_fetch_array($select_image)) {
	        			$post_image = $row['post_image'];
	        		}

	        	}

	    		$query  = "UPDATE posts SET ";
	    		$query .= "post_title = '$updated_post_title', ";
	    		$query .= "post_category_id = '$updated_post_category_id', ";
	    		$query .= "post_date = now(), ";
	    		$query .= "post_user = '$updated_post_user', ";
	    		$query .= "post_status = '$updated_post_status', ";
	    		$query .= "post_tags = '$updated_post_tags', ";
	    		$query .= "post_content = '$updated_post_content', ";
	    		$query .= "post_image = '$updated_post_image' ";
	    		$query .= "WHERE post_id = '$post_id'";

	    		$update_query = mysqli_query($connection, $query);
	    		if (!$update_query) {
	    			die("Query Failed! " . mysqli_error($connection));
	    		} else {
			    		echo "<div class='alert alert-success' role='alert'>
									Success! Your post is <a href='posts.php' class='alert-link'>edited</a>.
							  </div>";
		        }

	        }

		?>

		<form action="" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<label for="post-title">Post Title: &nbsp;</label>
				<input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title" id="post-title">
			</div>

			<div class="form-group">
				<label for="post-category">Category: &nbsp;</label>
				<select name="post_category_id" id="post-category">

					<option selected hidden>Select</option>

					<?php 

						$query = "SELECT * FROM categories";
						$show_categories_in_select_tag = mysqli_query($connection, $query);
						if (!$show_categories_in_select_tag) {
							die("Query Failed! " . mysqli_error($connection));
						}
						while ($row = mysqli_fetch_assoc($show_categories_in_select_tag)) {
							$category_id 	= $row['cat_id'];
							$category_title = $row['cat_title'];
							echo "<option value='$category_id'>" . $category_title . "</option>";
						}

					?>

				</select>
			</div>

			<div class="form-group">
				<label for="post-author">Post Author: &nbsp;</label>
				<select name="post_user" id="post-author">

					<option selected hidden>Select</option>

					<?php 

						$user_query = "SELECT * FROM users";
						$select_users = mysqli_query($connection, $user_query);
						if (!$select_users) {
							die("Query Failed! " . mysqli_error($connection));
						}
						while ($row = mysqli_fetch_assoc($select_users)) {
							$user_id 	= $row['user_id'];
							$username 	= $row['username'];
							echo "<option value='$username'>" . $username . "</option>";
						}

					?>

				</select>
			</div>

			<div class="form-group">
				<label for="post-status">Post Status: &nbsp;</label>
				<select name="post_status" id="post-status">

					<?php 

						echo "<option>" . $post_status . "</option>";

						if ($post_status == 'published') {
							echo "<option value='draft'>Draft</option>";
						} else {
							echo "<option value='published'>Published</option>";
						}

					?>

				</select>
			</div>

			<div class="form-group">
				<label for="post-image">Post Image: &nbsp;</label><br>
				<img src="../images/<?php echo $post_image; ?>" width="200" class="img-thumbnail" style="margin-bottom: 10px;">
				<br><input type="file" name="image" id="post-image">
			</div>

			<div class="form-group">
				<label for="post-tags">Post Tags: &nbsp;</label>
				<input type="text" class="form-control" value="<?php echo $post_tags; ?>" name="post_tags" id="post-tags">
			</div>

			<div class="form-group">
				<label for="post-content">Post Content: &nbsp;</label>
				<textarea class="form-control" name="post_content" id="post-content" rows="10" style="resize: none;"><?php echo $post_content; ?></textarea>
			</div>

			<div class="form-group">
				<input class="btn btn-primary" type="submit" name="update" value="UPDATE">
			</div>

		</form>

	</div>
		<div class="col-lg-2">
		<!-- Just some space -->
	</div>