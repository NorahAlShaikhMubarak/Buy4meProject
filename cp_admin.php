<?php
session_start();

$title = "Admin CPanel";
include 'header.php';
include 'connect-db.php';

if(!isset($_SESSION['admin']))
{
	header('Location: error.php');
}

?>
<div id="content">
	<div class="section shirts latest">
		<div class="wrapper">
			<h2>Administrator Control Panel</h2>
            <div style="width: 50%; margin: 0 auto;">
				<ul class="products">
					<li><a href="add-item.php">
						<img src="img/add.jpg">
						<p>Add Items</p>
						</a>
					</li><li>
						<a href="modify-item.php">
						<img src="img/update.jpg">
						<p>Modify Items</p>
						</a>
					</li>								
				</ul>
            </div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>     
