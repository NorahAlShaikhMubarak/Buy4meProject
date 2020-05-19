
<?php
session_start();

$title = "Update Item";
include 'header.php'; 
include 'connect-db.php';

if(!isset($_SESSION['admin']))
{
    header('Location: error.php');
}

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

if(isset($_POST['update']))
{
        $id = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];

        //IF the user uploaded a new image
        if(!empty($_FILES['image']['name']))
        {
             
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
                    $query = "UPDATE stuff SET name='$name', img = '$path', price=$price WHERE id=$id";                  
                }
            }
            else
            {
                $status="notdone";
            }
        }
        else   //IF no new image is uploaded from the update form
        {
           
            $out = 1;
            $query = "UPDATE stuff SET name='$name', price=$price WHERE id=$id";  
        }

        if($out==1)
        {
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
        else
        {
            $status="notdone";
        }                

        header("Location: update-item.php?status=$status");
}
?>

<div id="content">
   <div class="breadcrumb"><a href="cp_admin.php">Back to Control Panel</a></div>
   <div class="page section">
    <h1>Update Item</h1>
    
   <?php if(isset($_GET['status']) && $_GET['status']==="done") { ?>   
    <p>Item updated successfully in the Database</p>
    <?php } else {if(isset($_GET['status']) && $_GET['status']==="notdone") { ?>
    <p>Sorry Item was not updated</p>
    <?php } else { ?>
    
                <form id="update" name="update" method="POST" action="update-item.php" enctype="multipart/form-data">

                    <table>
                        <tr>
                            <th>
                                <label for="pid">Product-ID</label>
                            </th>
                            <td>
                                <input type="text" name="pid" readonly="readonly" id="pid" value="<?php echo $stuff['ID']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="name">Product Name</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name" value="<?php echo $stuff['name']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="image">Upload Image</label>
                            </th>
                            <td>
                                <img width="100" height="100" src="<?php echo $stuff['img']; ?>"/>
                                <input type="file" name="image" id="image">
                                <input type="hidden" name="imageret" value="<?php echo $stuff["img"] ?>" > 
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="price">Price</label>
                            </th>
                            <td>
                                <input type="text" name="price" id="price" value="<?php echo $stuff['price']; ?>">
                            </td>
                        </tr>                    
                    </table>
                    <input type="submit" value="Update" name="update">

                </form>
        <?php } } ?>
    </div>
</div>

<?php include 'footer.php'; ?>