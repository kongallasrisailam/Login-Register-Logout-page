
<h2>This is Login Template FIle</h2>
<?php
if(empty($_SESSION['details']))
{
    if(!empty($_SESSION['login'])) {
        echo "<ul style='color:red'>";
            echo "<li>".$_SESSION['login']."</li>";      
        echo "</ul>";
    } ?>
    <form action="index.php?path=login" method="POST">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password">
    <input type="submit" name="login" value="Login">
    </form>
    <a href="index.php?path=register">register now</a>
<?php
}
else{
    header("Location:index.php");
}
//session_destroy();
?>