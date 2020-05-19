<?php
session_start();

$title = "Login";
include 'header.php';
include 'connect-db.php'; 

if(isset($_POST['uid'],$_POST['pwd']))
{
    $uname = $_POST['uid'];
    $pwd = md5($_POST['pwd']);

    $query = "SELECT * FROM user WHERE username='$uname' AND password='$pwd'";
    $result = mysqli_query($con, $query);
    
    if($result)
    {
        if((mysqli_num_rows($result) == 1))
        {
            $_SESSION['admin'] = $uname;
            header('Location: login.php?status=valid');
        }
        else
        {
            header('Location: login.php?status=invalid');
        }
    }
        
 }
?>

<div id="content">
  <div class="page section">
    <h1>Administrator Login</h1>

    <form id="login" name="login" method="POST" action="login.php" onsubmit="return validate_login();">

      <?php if(isset($_GET['status']) and $_GET['status']==="invalid") { ?>          
          <p class="login-error">Wrong username/password combination. Please Try Again Later</p>
      <?php } ?> 

      <table>
          <tr>
               <th>
                    <label for="uid">Login-ID</label>
               </th>
               <td>
                    <input type="text" name="uid" id="uid">
                    <span class="error" id="ename">* Required </span>
               </td>
          </tr>
          <tr>
               <th>
                     <label for="pwd">Password</label>
               </th>
               <td>
                      <input type="password" name="pwd" id="pwd">
                      <span class="error" id="epwd">* Required </span>
               </td>
          </tr>
          </table>
         

        <input type="submit" value="Login" name="submit" id="submit">
    </form>
  </div>
</div>
   
<?php include 'footer.php'; ?>     