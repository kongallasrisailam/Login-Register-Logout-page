<?php
include 'database.php';
$conn = mysqli_connect('localhost','root','','srisailam3');
function regivalidation($arr)
{
 // print_r($arr);
 $firstname = $arr['firstname'];
$lastname = $arr['lastname'];
$password = $arr['password'];
$cpassword = $arr['conpassword'];
    $errors =[];
    if(!ctype_alpha($firstname)){
        array_push($errors,"firstname should have only alphabets");
        
      }
    
      if(!ctype_alpha($lastname)){
        array_push($errors,"lastname should have only alphabets");
      }

    if($password == $cpassword)
    {
      if(strlen($password)<=8)
      {
        array_push($errors,"password character sholud be > 8");
      }
      if(!preg_match("@[0-9]@",$password)){
        array_push($errors,"password should atleast one number");
      }
      if(!preg_match("@[A-Z]@",$password)){
        array_push($errors,"password should atleast one capital letter");
      }
      if(!preg_match("@[a-z]@",$password)){
        array_push($errors,"password should atleast one smal letter");
      }
      if(!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',$password)){
        array_push($errors,"password should atleast one special character");
      }
  }
  else{
    
    array_push($errors,"two passwords should match");
  }

  return $errors;
}

function reginserting($arr,$conn)
{
    $reg = [];
    $email = $arr['email'];
  
    $sql = "select * from register where email='$email'";
    $num = mysqli_num_rows(mysqli_query($conn,$sql));
    if($num>0)
    {
      array_push($reg,"this mail is already exist please login");
    }
    else{
        $qry = "INSERT INTO register (firstname, lastname, email, password, gender, BOD, phone) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($qry);
        $stmt->bind_param("sssssss", $arr["firstname"], $arr["lastname"], $email, $arr["password"], $arr["gender"], $arr["BOD"], $arr["phone"]);

        if ($stmt->execute()) {
            $_SESSION['status']="success";
            header('Location:index.php?path=login');
            exit();
        } else  {
            echo "Error: " . $stmt->error;
        }

        
        $stmt->close();
        $conn->close();
    }
    return $reg;
}
function loginvalidation($username,$password,$conn)
{
    session_start();
    $errors =[];
    $sql = "SELECT * FROM register WHERE email='$username' or phone='$username'";

        $query=mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            if (($row['email']===$username || (string)$row['phone'] === $username) && $row['password'] === $password) {
                $_SESSION['details']=$row;
                
                header("Location:index.php");
            } else {
               array_push($errors,"please enter valid password");
            }
        } else {
            array_push($errors,"This mail and phone number is not registered");
           
        }
        return $errors;

}
function logout1()
{
    session_start();
     session_unset();
     session_destroy();
     header("Location:login.php");
}



