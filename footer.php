<div class="footer">

		<div class="wrapper">

			<ul>		
				<li><a href="http://twitter.com/">Twitter</a></li>
				<li><a href="https://www.facebook.com/">Facebook</a></li>
                                
                                <?php if(!isset($_SESSION['admin'])) { ?>
                                	<li><a href="login.php">Login</a></li>
                                <?php } else { ?>
                                	<li><a href="cp_admin.php">Admin_Panel</a></li> 
                                    <li><a href="logout.php">Logout</a></li> 
                                 <?php } ?>
			</ul>

			<p>&copy;2013 Buy 4m Me</p>

		</div>
	
	</div>

</body>
</html>
