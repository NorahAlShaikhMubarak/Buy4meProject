<?php
session_start();

$title = "Add Item";
include 'header.php';
include 'connect-db.php';

if(!isset($_SESSION['admin']))
{
    header('Location: error.php');
}


if(isset($_POST['add']))
{


    $id = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];


    $filename = $_FILES['image']['name'];
    $tmp  = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $type = $_FILES['image']['type'];

    //STEP 1: Construct the Destination Path
    $path = "img/stuff/";
    $path = $path.basename($filename);

    //CHECK FILE TYPE FROM EXTENSION
    $accepted = array('png','jpg','jpeg','gif');
    $ext_array = explode(".", $path);
    $extension = end($ext_array);
    $result = in_array($extension,$accepted);

    //STEP 2: CHECK 3 FACTORS: SIZE, TYPE and ERROR
    if($size <= 500000 && ($result==1) && ($error==0))
    {
       
        //STEP 3: Move the uploaded file
        $out = move_uploaded_file($tmp, $path);        
        
        if($out==1)
        {
            //STEP 4: Create the Query
            $query = "INSERT INTO stuff (id, name, img, price) VALUES ($id, '$name', '$path', $price)";

            //STEP 5: Run the Query
            $res = mysqli_query($con, $query);        

            //STEP 6: Check the result
            if($res==1)
            {
                $status = "done";
            }
            else
            {
                $status = "notdone";
            }
        }
    }
    else
    {
        $status="notdone";
    }

    header("Location: add-item.php?status=$status");
    exit();
}
?>

<div id="content">
<div class="breadcrumb"><a href="cp_admin.php">Back to Control Panel</a></div>
<div class="page section">
    <h1>Add Item</h1>
    
    <?php if(isset($_GET['status']) && $_GET['status']==="done") { ?>   
    <p>Item added successfully to the Database</p>
    <?php } else {if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <p>Sorry Item was not added</p>
    <?php } else { ?>
                <form id="contact" name="add" method="POST" action="add-item.php" enctype="multipart/form-data">

                    <table>
                        <tr>
                            <th>
                                <label for="pid">Product-ID*</label>
                            </th>
                            <td>
                                <input type="text" name="pid" id="pid">
                                
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="name">Product Name*</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="image">Upload Image</label>
                            </th>
                            <td>
                                <input type="file" name="image" id="image">
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="price">Price*</label>
                            </th>
                            <td>
                                <input type="text" name="price" id="price">
                                
                            </td>
                        </tr>                    
                    </table>
                    <input type="submit" value="Add" name="add" id="add"/>

                </form>
           <?php } } ?>
</div>
</div>
<?php include 'footer.php'; ?>