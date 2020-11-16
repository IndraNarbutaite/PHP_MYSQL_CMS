				
				<?php

					// Function for deleting posts
					delete_from_posts();

				?>

				<?php

					if (isset($_POST['checkboxArray'])) {
						
						foreach ($_POST['checkboxArray'] as $checkbox_post_id) {
							
							$bulk_option_value = $_POST['bulk_options'];

							// Switch case for the selected option.
							switch ($bulk_option_value) {

								// For publishing.
								case 'published':
									
									$query = "UPDATE posts SET post_status = '$bulk_option_value' WHERE post_id = $checkbox_post_id";

									$update_to_published = mysqli_query($connection, $query);
									if (!$update_to_published) {
										die('Sorry! Query failed ' . mysqli_error($connection));
									} else {
										header("Location: posts.php");
									}

									break;
								
								// For drafting.
								case 'draft':
									
									$query = "UPDATE posts SET post_status = '$bulk_option_value' WHERE post_id = $checkbox_post_id";

									$update_to_draft = mysqli_query($connection, $query);
									if (!$update_to_draft) {
										die('Sorry! Query failed ' . mysqli_error($connection));
									} else {
										header("Location: posts.php");
									}

									break;

								// For deleting.
								case 'delete':
									
									$query = "DELETE FROM posts WHERE post_id = $checkbox_post_id";

									$delete_bulk_post = mysqli_query($connection, $query);
									if (!$delete_bulk_post) {
										die('Sorry! Query failed ' . mysqli_error($connection));
									} else {
										header("Location: posts.php");
									}

									break;

								// For cloning.
								case 'clone':
									
									$query = "SELECT * FROM posts WHERE post_id = $checkbox_post_id";
							        $show_data_from_posts = mysqli_query($connection, $query);

							        while ($row = mysqli_fetch_assoc($show_data_from_posts)) {
							            
							            $post_id 			 =  $row['post_id'];
							            $post_title     	 =  $row['post_title'];
							            $post_author    	 =  $row['post_author'];
							            $post_category_id	 =  $row['post_category_id'];
							            $post_date      	 =  $row['post_date'];
							            $post_image     	 =  $row['post_image'];
							            $post_content        =  mysqli_real_escape_string($connection, $row['post_content']);
							            $post_tags	    	 =  $row['post_tags'];
							            $post_status    	 =  $row['post_status'];
							            $post_comment_count  =  $row['post_comment_count'];

							        }

							        $query  = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
	        						$query .= "VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', $post_comment_count, '$post_status')";

	        						$copy_query = mysqli_query($connection, $query);

						        	if (!$copy_query) {
						        		die("Not cloned. Sorry! " . mysqli_error($connection));
						        	} else {
										header("Location: posts.php");
									}

									break;

									case 'reset':
						
										$reset_view_id = $checkbox_post_id;

										$query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $reset_view_id";
										$reset_query = mysqli_query($connection, $query); 
										if (!$reset_query) {
											die("Reset failed! " . mysqli_error($connection));
										} else {
											header("Location: posts.php");
										}

										break;

							}

						}

					}

				?>

				<form action="" method="post">

				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<div id="bulk_options_container">
							<select class="form-control" name="bulk_options" id="">
								<option selected hidden>Select Your Option</option>
								<option value="published">Publish</option>
								<option value="draft">Draft</option>
								<option value="clone">Clone</option>
								<option value="reset">Reset Views</option>
								<option value="delete">Delete</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-xs-6">
						<input type="submit" name="submit" class="btn btn-success" value="Apply">
						&nbsp;&nbsp;&nbsp;
						<a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
					</div>
				</div>

				<hr id="hr-style1">

				<div class="table-responsive">
					<table class="table table-hover table-bordered">

						<thead>
							<th><input type="checkbox" id="selectAllBoxes"></th>
							<th>ID</th>
							<th>USER</th>
							<th>TITLE</th>
							<th>CATEGORY</th>
							<th>STATUS</th>
							<th>IMAGE</th>
							<th>TAGS</th>
							<th>COMMENTS</th>
							<th>VIEWS</th>
							<th>DATE</th>
							<th>POST</th>
							<th>EDIT</th>
							<th>DELETE</th>
						</thead>
						<tbody>
							<?php 

								$query = "SELECT * FROM posts ORDER BY post_id DESC";
				                $show_data_from_posts = mysqli_query($connection, $query);

				                while ($row = mysqli_fetch_assoc($show_data_from_posts)) {
				                    
				                    $post_id 			 =  $row['post_id'];
				                    $post_title     	 =  $row['post_title'];
				                    $post_author    	 =  $row['post_author'];
				                    $post_user			 =  $row['post_user'];
				                    $post_category_id	 =  $row['post_category_id'];
				                    $post_date      	 =  $row['post_date'];
				                    $post_image     	 =  $row['post_image'];
				                    $post_tags	    	 =  $row['post_tags'];
				                    $post_status    	 =  $row['post_status'];
				                    $post_comment_count  =  $row['post_comment_count'];
				                    $post_views_count  =  $row['post_views_count'];

				                    echo "<tr>";

				                    // The checkboxArray[] stores the $post_id of the selected checkbox.
				                    echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value=$post_id></td>";
				                    echo "<td>$post_id</td>";

				                    if (!empty($post_author)) {
				                    	echo "<td>$post_author</td>";
				                    } elseif (!empty($post_user)) {
				                    	echo "<td>$post_user</td>";
				                    }
				                    

				                    echo "<td>$post_title</td>";

				                    $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id'";
									$edit_category_in_table = mysqli_query($connection, $query);

									while ($row = mysqli_fetch_assoc($edit_category_in_table)) {
										$cat_id    = $row['cat_id'];
										$cat_title = $row['cat_title'];
				                	
				                    	echo "<td>$cat_title</td>";
				                	}

				                    echo "<td>$post_status</td>";
				                    echo "<td align='center'><img src=\"../images/$post_image\" width=\"105\"></td>";
				                    echo "<td>$post_tags</td>";
				                    echo "<td>$post_comment_count</td>";
				                    echo "<td>$post_views_count</td>";
				                    echo "<td>$post_date </td>";
				                    echo "<td><a href='../post.php?p_id=$post_id' id='text-link' target='_blank'>View</td>";
				                    echo "<td><a href='posts.php?source=edit_post&p_id=$post_id' id='text-link'>Edit</td>";
				                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete=$post_id' id='text-link'>Delete</a>";
				                    echo "</tr>";

				                }

							?>
						</tbody>
					</table>

				</div>
				</form>