
<?php include("includes/admin_header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/navigation.php"); ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                            <!-- <small> &nbsp;Subheading</small> -->
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-edit"></i>  <a>View All Comments</a>
                            </li>
                        </ol>
                <!-- Category Main Title -->						
			</div>
			
		</div>
		
		<div class="container-fluid">
			<div class="row">
				<?php 

					if (isset($_GET['source'])) {
						$source = $_GET['source'];
					}
					else {
						$source = "";
					}

					switch ($source) {
						case 'add_post':
							include('includes/add_post.php');
							break;

						case 'edit_post':
							include('includes/edit_post.php');
							break;
						
						default:
							include('includes/view_comments.php');
							break;
					}

				?>
			</div>
		</div>

		<hr>

		<footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; Indra Dev CMS | 2020</p>
                </div>
                <div class="col-lg-6">
                    <p class="pull-right">Developed by Indra Dev</p>
                </div>         
            </div>
            <!-- /.row -->
        </footer>
		
<?php include("includes/admin_footer.php") ?>