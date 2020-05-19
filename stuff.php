<?php

$title = "Stuff";
include 'header.php'; 

include 'connect-db.php';

//STEP 4: CREATE THE QUERY
$query = "SELECT * FROM stuff";

//STEP 5: RUN THE QUERY
$result = mysqli_query($con,$query);
$stuff = array();

//STEP 6: RETRIEVE VALUES FROM RESULT
while($row = mysqli_fetch_assoc($result))
{

$stuff[$row['id']] = array(
                    'ID' => $row['id'],
                    'name'=>$row['name'],
                    'img'=>$row['img'],
                    'price'=>$row['price']
                    );

}

?>

<div id="content">

<div class="page shirts section">
    <div class="wrapper">
        <h1>My Full Catalog of Stuff</h1>
        <ul class="products">
            <?php foreach($stuff as $i) {?>
           <li>
                <a href="item.php?id=<?php echo  $i['ID']; ?>">                
                <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['name']; ?>"/>
                <p>View Details</p>
                </a>
            </li>
            <?php } ?>
            
        </ul>    
    </div>    
 </div>
</div>
<?php include 'footer.php'; ?>
