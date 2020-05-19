<?php

$title = "Item Description";
include 'header.php';
include 'connect-db.php'; 

if(isset($_GET['id']))
{

    $id = $_GET['id'];
    $query = "SELECT * FROM stuff WHERE id=$id";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {

        $stuff = array(
                    'ID' => $row['id'],
                    'name'=>$row['name'],
                    'img'=>$row['img'],
                    'price'=>$row['price']
                    );

    }
}

?>

<div id="content">

<div class="section page">

    <div class="wrapper">

	<div class="shirt-picture">
		<span>
                    <img src="<?php echo $stuff['img']; ?>" alt="<?php echo $stuff['name']; ?>">
		</span>
	</div>
	<div class="shirt-details">

		<h1><span class="price">SAR <?php echo $stuff['price']; ?></span><?php echo $stuff['name']; ?></h1>
        <form action="cart.php" method="GET">
                    <input type="hidden" name="itemid" value="<?php echo $stuff['ID']; ?>"/>
                    <input type="submit" value="Add to Cart" name="submit">
        </form>
	</div>
    </div>
</div>
</div>

<?php include 'footer.php'; ?>