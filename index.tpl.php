<?php
if(!empty($_SESSION['details']))
    {
        $arr = $_SESSION['details'];
   ?>     
       
    <h3 style='color:green'> wellcome to home ur email id is <?php echo  $arr['email'];?> </h3>
    <ul>
    <?php 
    $_SESSION['update']=$arr;
      foreach($arr as $keys => $values)
            {
                if($keys!=='password'){
                    echo "<li>$keys ".":". " $values</li>";
                }
            }
    ?>
    </ul>
    <a href="index.php?path=logout" >logout</a><br>
    <a href="index.php?path=profile_update">update details</a>

<?php
   

    }
    else{
        header('location:index.php?path=login');
    }
?>