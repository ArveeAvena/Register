<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="Images/Riz_Logo.png">
<script src="https://kit.fontawesome.com/81b852f4d6.js" crossorigin="anonymous"></script>
</head>
<body>
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Poppins';
    background-repeat: no-repeat;

        }

        .container{
            padding: 30px;
             border: black solid 2px;
             border-radius: 10px;
             border: #53daf89d 1px solid;
             box-shadow: #53daf844 0px 7px 29px 0px;
             background:linear-gradient( #53daf823, #d7446113);
        }

        

        input {
            padding-inline-start: 10px;
            margin-bottom: 15px;
            height: 25px;
            padding: 5px;
            width: 230px;
            border: rgba(156, 148, 148, 0.671) solid 1px;
        }

        .myButton {
            font-size: 17px;
    padding: 9px 40px 9px 40px;
    background: linear-gradient(45deg, #53daf8b9, #d74461d0);
    font-weight: 500;
    border: none;
    border-radius: 10px;
    color: white;
    cursor: pointer;
    margin-bottom: 0px;
    width: 100%;
    text-decoration: none;

    height: 40px;
        }
        .Share{
    color: #726ae9;
}

.Discover{
   color: #53daf8; 
}
.Rizpeat{
    color: #d74461;
}


    .Text_logo{
    width: 150px; 
    cursor: pointer;
}
@media only screen and (max-width: 700px) {
    .quote_section{
        display: none;

        }

        

        .loginSection{
            width: 70%;
        }

        .container{
            display: flex;
            align-items: center;
            justify-content: center;

            width: 60%;
            position: relative;
            top: 10px;
            
        }

        .Text_logo{
            width: 150px; 
            margin-bottom: 10px;
            cursor: pointer;
            
        }

        .loginButton{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            text-decoration: none;
        }
        
        label{
            font-size: 14px;
            margin-top: 0px;
        }
        
        input{
            padding: 5px;
            width: 100%;
            border: rgba(156, 148, 148, 0.671) solid 1px;
            margin-bottom: 10px;
        }
        
        .forgot_password{
            display: flex;
            justify-content: right;
            font-size: 12px;
            margin-top: 5px;  
            margin-bottom: 30px;
        }

        .login_button{
            font-size: 17px;
            padding: 9px 40px 9px 40px;
            background: linear-gradient(45deg, #53daf8b9, #d74461d0);
            font-weight: 500;
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            margin-bottom: 0px;
            width: 70%;
            
        }
}


    </style>
    <div class="container">
        <?php 
        if(isset($_POST["submit"])) {
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $conf_password = $_POST["conf_password"];
            $password_hash = password_hash(($password), PASSWORD_DEFAULT);

            $errors = array();
            if(empty($email) OR empty($username) OR empty($password) OR empty($password)){
                array_push($errors,"All fields are required");
            } 
            if(!filter_var( $email , FILTER_VALIDATE_EMAIL)) {
                array_push($errors,"Please enter a valid email address");
            }
            if(strlen($password) < 8){
                array_push($errors,"Password must be at least 8 characters long.");
            }
            if ($password !== $conf_password) {
                array_push($errors,"Passwords do not match.");
                }
/*
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);

                if ($rowCount > 0) {
                    array_push($errors,"Email already exist!");
                }
                */
                
                if(count($errors)>0){
                    foreach ($errors as $error){
                        echo "<p class='alert'style='color:red'>$error<br></p>";
                    }
        }
        else {
            require_once "database.php";
            $sql = "INSERT INTO myusers (email, username, password) VALUES (?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt, "sss", $email, $username, $password_hash);
                mysqli_stmt_execute($stmt);
                echo "<p class = 'alert' style='color:green'>User created successfully!</p>";
            }
    }
}
        
    
        ?>
    <form action="index.php" method="post">


    <h2 class="quote"> <span class="Discover">RE</span><span class="Share">GIS</span><span class="Rizpeat">TER</span></h2>

    <div class="myForm">
        <input type="email" class="form-control" name="email" placeholder="Email address"><br>
    </div>
    <div class="myForm">
        <input type="text" class="form-control" name="username" placeholder="Username"><br>
    </div>
    <div class="myForm">
        <input type="password" class="form-control" name="password" placeholder="Create Password"><br>
    </div>
    <div class="myForm">
        <input type="password" class="form-control" name="conf_password" placeholder="Confirm Password"><br>
    </div>
    <div class="myForm_button">
        <input type="submit" class="myButton" value="Register" name="submit">
    </div>
    </form>
    </div>
</body>
</html>