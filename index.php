<?php
session_start();
require_once("database.php");
require_once("router.php");


function login($postData,$conn) {
    //print_r($postData);
    if(isset($postData['login'])) {
        $sql = "SELECT * FROM register WHERE email='{$postData['username']}' or phone='{$postData['username']}'";

        $query=mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            if (($row['email']===$postData['username'] || (string)$row['phone'] === $postData['username']) && $row['password'] === $postData['password']) {
                $_SESSION['details']=$row;
                header('Location:index.php');
                die();
            } else {
               $_SESSION['login']="please enter valid password";
               
               
            }
            
        } else {
            $_SESSION['login']="this email or phone not registered";
            
        }
    }

    include_once("views/login.tpl.php");
}
function register($postData, $conn) {
    
    // print_r($postData)."<br>";
    // echo $_SERVER['REQUEST_METHOD'];
    include_once("validation.php");

    
    if (!empty($_POST)) {
        
        $errors = regivalidation($postData);
        $_SESSION['register'] = $errors;

       
        if (empty($errors)) {
            $reg = reginserting($postData, $conn);
            if (!empty($reg)) {
                $_SESSION['register'] = $reg;
            }
        }
    }

    // Include the template file
    include_once("views/register.tpl.php");
}


function index() {
    

    include_once("views/index.tpl.php");
}

function logout()
{
     session_unset();
     session_destroy();
     header("Location:index.php");
}
function profileUpdate($postdata,$conn)
{
    

    $sql2 = "SELECT * FROM register WHERE id='{$_GET['id']}'";
    $result =mysqli_fetch_assoc(mysqli_query($conn, $sql2));
    
    if(!empty($_POST))
    {
        
        $id=$postdata['id'];
        $firstname=$postdata['firstname'];
        $lastname=$postdata['lastname'];
        $email = $postdata['email'];
        $phone = $postdata['phone'];
        $gender = $postdata['gender'];
        $bod = $postdata['BOD'];
        $sql = "UPDATE register SET firstname='$firstname', lastname='$lastname',    email='$email', phone='$phone', gender='$gender', BOD='$bod' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            $affected_rows = mysqli_affected_rows($conn);
            
            $result =mysqli_fetch_assoc(mysqli_query($conn, $sql2));
          
            if ($affected_rows > 0) {
                $_SESSION['details']=null;
                $_SESSION['details']=$result;
                
                 header("Location:index.php");
                 die();
            } else {
                echo "No rows were updated.";
                header("Location:index.php") ;
            }
            
        } else {
            echo "Query execution error " ;
        }
    
        
   }
   else{
        include_once("views/update.tpl.php");
   }
}




