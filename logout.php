<?php
session_start();

if(isset($_SESSION['admin']))
{
    session_unset();
    session_destroy();
    header("Location: index.php");
}


$title = "Item Description";
include 'header.php';

?>
<div id="content">
	<div class="page section">
	    <h1>Logging Off.........</h1>
	</div>
</div>

<?php include 'footer.php'; ?>