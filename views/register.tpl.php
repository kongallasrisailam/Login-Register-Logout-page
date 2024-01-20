<?php
if(empty($_SESSION['details']))
{
  ?>
  <h2>Registration</h2>
  <?php if(!empty($_SESSION['register'])) {
      echo "<ul style='color:red'>";
      foreach($_SESSION['register'] as $err)
          echo "<li>".$err."</li>";      
      echo "</ul>";
      $_SESSION['register']=null;
      session_destroy();
  } ?>
      <form action="index.php?path=register" method="post"  name="registrationForm">
      
          <input type="text" placeholder="Enter firstname" name="firstname" required>
        <br>

          <input type="text" placeholder="Enter lastname" name="lastname" required>
          <br>
        
          <input type="text" placeholder="Enter your email" name="email" required>
          <br>
          
        
          <input type="password" placeholder="Create password" name="password" required><br>
        
          <input type="password" placeholder="Confirm password" name="conpassword" required>
        <br>

          <input  type="tel" id="mobile" name="phone" pattern="[0-9]{10}" placeholder="Enter 10-digit mobile number" required><br>

          <select name="gender">
            <option value="">Select-gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">others</option>
          </select><br>

          <input type="date" id="BOD" name="BOD"><br>
        
          <input type="submit" name="register" value="register">  <br>
      </form>
      <a href="index.php?path=login"> login now</a>
<?php
}
else{
  header("Location:index.php");
}




?>

