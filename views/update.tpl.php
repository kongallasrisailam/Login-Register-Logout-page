
<?php
if(!empty($_SESSION['details']))
{
?>
<h2>update form</h2>
<form action="index.php?path=profile_update&id=<?php echo $_SESSION['update']['id']?>" method="post"  name="registrationForm">
          <input type="hidden" value="<?php echo $result['id'];?>" name="id">
          <input type="text" value="<?php echo $result['firstname'];?>" name="firstname" required>
        <br>

          <input type="text" value="<?php echo $result['lastname'];?>" name="lastname" required>
          <br>
        
          <input type="text" value="<?php echo $result['email'];?>" name="email" required>
          <br>
          <input  type="tel" id="mobile" name="phone" pattern="[0-9]{10}" value="<?php echo $result['phone'];?>" required><br>

          <select name="gender" >
            <option value="<?php echo $result['gender'];?>"><?php echo $result['gender'];?></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">others</option>
          </select><br>

          <input type="text" id="BOD" name="BOD" value="<?php echo $result['BOD'];?>"><br>
        
          <input type="submit" name="update" value="UPDATE">  <br>
      </form>


<?php
}
else
{
  header("Location:index.php");
}
?>