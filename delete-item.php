<?php

session_start();

$title = "Delete Item";
include 'header.php'; 
include 'connect-db.php';

if(!isset($_SESSION['admin']))
{
    header('Location: error.php');
}

if(isset($_GET['id']))
{
	$id = $_GET['id'];
        //Create query to select the element you want to delete
	$query1 = "SELECT img FROM stuff WHERE id=$id";
	$result1 = mysqli_query($con, $query1);
	$img = mysqli_fetch_row($result1)[0];
        //Create query to delete the element
	$query = "DELETE FROM stuff WHERE id=$id";
	$result = mysqli_query($con, $query);
	if($result==1)
	{
		//Check if file exist 
		if(file_exists($img))
		{
			unlink($img);
		}

		$status="done";
	}
	else
	{
		$status="notdone";
	}

	header("Location: delete-item.php?status=$status");
}

?>

<div id="content">

<div class="page section">
    <h1>Delete Item</h1>
    <?php if(isset($_GET['status']) && $_GET['status']==="done") { ?>
    <p>Item deleted successfully from the Database</p>
    <?php }else { if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <p>Sorry Item was not deleted</p>
    <?php }else { ?>
    <p>No Item to Delete</p>
    <?php } } ?>

</div>
</div>

<?php include 'footer.php'; ?>





