<?php
session_start();
$title = "Shopping Cart";
include 'header.php';
include 'connect-db.php';

if(isset($_GET['itemid']))
{
        $item = $_GET['itemid'];
        //STEP 4: CREATE THE QUERY
        $query = "SELECT * FROM stuff WHERE id=$item";

        //STEP 5: RUN THE QUERY
        $result = mysqli_query($con,$query);
        $stuff = array();

        //STEP 6: RETRIEVE VALUES FROM RESULT
        while($row = mysqli_fetch_assoc($result))
        {

        $stuff = array(
                            'ID' => $row['id'],
                            'name'=>$row['name'],
                            'img'=>$row['img'],
                            'price'=>$row['price']
                            );

        }

        if(!isset($_SESSION['cart']))
        {

            $_SESSION['cart'] = array();


            $_SESSION['cart'][$stuff['ID']] = array(

                                    'ID' => $stuff['ID'],
                                    'name'=>$stuff['name'],
                                    'img'=>$stuff['img'],
                                    'price'=>$stuff['price'],
                                    'quantity' => 1


                );
        }
        else
        {
            
            foreach($_SESSION['cart'] as $items) {
                if($items['ID']== $item)
                    $_SESSION['cart'][$stuff['ID']]['quantity'] = (int)$items['quantity'] + 1;
                else
                {
                    $_SESSION['cart'][$stuff['ID']] = array(

                                    'ID' => $stuff['ID'],
                                    'name'=>$stuff['name'],
                                    'img'=>$stuff['img'],
                                    'price'=>$stuff['price'],
                                    'quantity' => 1
                            );
                }
            }
        }


}

if(isset($_POST['update']))
{
    foreach($_POST as $key => $value)
    {
        if($value=='yes')
        {
            unset($_SESSION['cart'][$key]);
        }
        foreach($_SESSION['cart'] as $items) {
            $str = 'q_'.$items['ID'];
            if($str==$key)
                $_SESSION['cart'][$items['ID']]['quantity'] = (int)$value;
        }       
    }       
}

if(isset($_POST['checkout']))
{
    if(isset($_SESSION['cart']))
    {
        unset($_SESSION['cart']);
        session_destroy();
    }
            
}




?>

<div id="content">
<div class="breadcrumb"><a href="stuff.php">Back to Items List</a></div>
<div class="page section">
    <h1>Shopping Cart</h1>
    <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
    <p>There are no items in the cart </p>
    <?php } else { ?>

    <form action="cart.php" method="POST">
    <table id="cart">

                    <tr>
                        <td class="image-col">
                            <label>Items to Buy Now</label>
                        </td>
                        <td class="name-col">
                            
                        </td>
                        <td class="price-col">
                            <label>Price</label>
                        </td>
                        <td class="quantity-col">
                            <label>Quantity</label>
                        </td>
                    </tr>
                
                <?php $total = 0;  
                   foreach($_SESSION['cart'] as $item) { ?>
                    <tr>
                        <td class="image-col">
                             <img width="100" height="100" src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>"/>
                        </td>
                        <td class="name-col">
                             <label class="name"><?php echo $item['name']; ?></label><br/>
                             <span><input type="checkbox" name="<?php echo $item['ID']; ?>" value="yes"/> Delete</span>
                        </td>
                        <td class="price-col">
                            <h3><span class="price">SAR <?php echo $item['price']; ?></span> </h3>
                        </td>
                        <td class="quantity-col">
                            <input type="text" size="2" style="text-align: center" name="<?php echo "q_".$item['ID']; ?>" value="<?php echo $item['quantity']; ?>"/>
                        </td>
                    </tr>
                <?php $total += $item['quantity']*$item['price']; } ?>
                    <tr>
                        <td class="image-col">
                            
                        </td>
                        <td class="name-col" style="text-align: right;">
                            <label>Subtotal</label>
                        </td>
                        <td class="price-col">
                            <h3><span class="price">SAR <?php echo $total; ?></span> </h3>
                        </td>
                        <td class="quantity-col">
                            
                        </td>
                    </tr>
                    
                    
                    
        
    </table>
    <input type="submit" name="update" value="Update Cart" /><br/><br/>
    <input type="submit" name="checkout" value="Proceed to Checkout" />                 
    </form>
    
    <?php } ?>
    
</div>

<?php include('footer.php'); ?> 