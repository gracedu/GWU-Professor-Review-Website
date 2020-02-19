<?php
session_start();

require_once('TCommon.php');
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'change_password':
            changePassword();
            break;
        case 'user_register':
            userRegister();
            break;
        case 'user_login':
            userLogin(TCommon::$TYPE_USER);
            break;
        case 'out':
            logOut();
            break;
        case 'create_property':
            create_property();
            break;
        case 'del_property':
            del_property();
            break;
        case 'add_professor':
            add_professor();
            break;
        case 'review':
            review();
            break;
        default:
            break;
    }
}

function changePassword() {
    $oldPassword = trim($_POST["oldPassword"]);
    $newPassword1 = trim($_POST["newPassword1"]);
    $newPassword2 = trim($_POST["newPassword2"]);

    $sql = "SELECT password FROM user WHERE userName LIKE '" . $_SESSION["NAME"] . "'";
    $oldPasswordHash = TCommon::getOneColumn($sql);

    if(TCommon::isEmpty($oldPassword) || TCommon::isEmpty($newPassword1) || TCommon::isEmpty($newPassword2)) {
        $r["error"] = "Please fill in all fields";
    }
    else if(md5($oldPassword) != $oldPasswordHash) {
        $r["error"] = "Old password is incorrect";
    }
    else if($newPassword1 != $newPassword2) {
        $r["error"] = "New passwords do not match";
    }
    else {
        $sql = "UPDATE user SET password = '" . md5($newPassword1) . "' WHERE userName LIKE '" . $_SESSION["NAME"] . "'";
        TCommon::execSql($sql);
        $r["info"] = "Password successfully changed!";
        $r["success"] = true;
    }

    echo json_encode($r);
}

function review(){
    $classID = initClassByName($_POST["className"],$_POST["profID"]);
    $studentID = $_POST['studentID'];
    $profID = $_POST['profID'];
    $homework = $_POST['homework'];
    $test = $_POST['test'];
    $helpful = $_POST['helpful'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $exec = "INSERT INTO `reviews`( `studentID`, `classID`, `profID`,  `HW`, `TEST`, `HELPFUL`, `OVERALL`, `comment`) VALUES ($studentID, $classID, $profID, $homework, $test,$helpful,$rating,'$comment')";
    TCommon::execSql($exec);
    $r['success'] = true;
    $r['info'] = "review success";
    echo json_encode($r);
}

function initClassByName($name , $pid){
    $query = "SELECT * FROM classes where className='$name' AND profID = $pid";
    $item = TCommon::getOne($query);
    if ( $item==false ) {
        $exec = "INSERT INTO classes (profID ,className) values ($pid ,'$name')";
        TCommon::execSql($exec);
    }
    $item = TCommon::getOne($query);
    return $item["classID"];
}

//
function userRegister()
{
    $r["success"] = false;
    $name = $_POST["name"];
    $studentID = $_POST["studentID"];
    $pwd = trim($_POST["pwd"]);
    $pwd1 = trim($_POST["pwd_a"]);
    $email = $_POST["email"];
    $passValidation = true;

    // Database tables
    $userTbl = "user";

    if (TCommon::isEmpty($studentID) || TCommon::isEmpty($name) || TCommon::isEmpty($pwd) || TCommon::isEmpty($pwd1) || TCommon::isEmpty($email)){
         $r["error"] = "Please fill in all fields";
         $passValidation = false;
    }

    else if(strlen($studentID) != 9) {
        $r["error"] = "GWid must be 9 characters";
        $passValidation = false;
    }

    else if($studentID[0] != 'G') {
        $r["error"] = "GWid must begin with 'G'";
        $passValidation = false;
    }

    //这里的G没去判断，到时候再查怎么写
    else if(!filter_var(substr($studentID, 1), FILTER_VALIDATE_INT)) {
        $r["error"] = "GWid must begin with 'G' and be followed by 8 digits";
        $passValidation = false;
    }

    else if(substr($email, -8) != "@gwu.edu"){
        $r["error"] = "Email must end with @gwu.edu";
         $passValidation = false;
    }

    else if ($pwd1 != $pwd) {
        $r["error"] = "Passwords do not match";
        $passValidation = false;
    }
  
    else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "demo";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn -> connect_error) {
            $r["error"] = "Error connecting to database";
            $passValidation = false;
        }
        else {
            // Check for unique GWid
            $sql = "SELECT * FROM user WHERE studentID LIKE '" . $studentID . "'";
            $result = $conn -> query($sql);
            if (mysqli_num_rows($result) > 0) {
                $r["error"] = "GWid already associated with registered account";
                $passValidation = false;
            }

            // Check for unique email
            if($passValidation) {
                $sql = "SELECT * FROM user WHERE email LIKE '" . $email . "'";
                $result = $conn -> query($sql);
                if (mysqli_num_rows($result) > 0) {
                    $r["error"] = "Email already associated with registered account";
                    $passValidation = false;
                }
            }

            // Check for unique username
            if($passValidation) {
                $sql = "SELECT * FROM user WHERE userName LIKE '" . $name . "'";
                $result = $conn -> query($sql);
                if (mysqli_num_rows($result) > 0) {
                    $r["error"] = "Username already taken. Please choose another one";
                    $passValidation = false;
                }
            }
        }

        // No errors detected. Create account.
        if($passValidation) {
            $sql = "INSERT INTO user (studentID, email, userName, password, createDate) VALUES ('" . $studentID . "', '" . $email . "', '" . $name . "', '" . md5($pwd) . "', CURRENT_TIMESTAMP)";

            if($conn -> query($sql) === TRUE) {
                TCommon::setSession('NAME', $name);
                $r["info"] = "Account created successfully!";
                $r["success"] = true;
            }
            else {
                $r["error"] = "Error creating account: " . $sql . "<br>" . $conn -> error;
            }
        }
    }

    echo json_encode($r);
}


function userLogin()
{
    $passValidation = true;
    $name = $_POST["name"];
    $pwd = trim($_POST["pwd"]);

    if(TCommon::isEmpty($name) || TCommon::isEmpty($pwd)) {
        $r["error"] = "Please fill in all fields";
        $passValidation = false;
    }
    else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "demo";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn -> connect_error) {
            $r["error"] = "Error connecting to database";
            $passValidation = false;
        }
        else {
            // Check credentials
            $sql = "SELECT * FROM user WHERE userName LIKE '" . $name . "' AND password LIKE '" . md5($pwd) . "'";
            $result = $conn -> query($sql);
            if (mysqli_num_rows($result) == 0) {
                $r["error"] = "Login credentials failed";
                $passValidation = false;
            }
            else {
                TCommon::setSession('NAME', $name);
                $r["info"] = "Login successful!";
                $r["success"] = true;
            }
        }
    }

    echo json_encode($r);
}


function logOut()
{
    $url = "../index.php";
    unset($_SESSION["NAME"]);
    TCommon::headerTo($url);
}


function getLoginUserName()
{
    if (TCommon::sessionExisted("NAME")) {
        return $_SESSION["NAME"];
    } else {
        return FALSE;
    }
}

function listProfessorByName(){
    $pro_name  = isset($_GET['pro_name'])?$_GET['pro_name']:"";
    $class_name  = isset($_GET['class_name'])?$_GET['class_name']:"";
    if(TCommon::isEmpty($pro_name) && TCommon::isEmpty($class_name) ){
        return false;
    }
    $query = "select * from `professors` where";
    if(!TCommon::isEmpty($pro_name)){
        $query.= " profName='$pro_name'";
    }
    if(!TCommon::isEmpty($class_name)){
        
        if(strstr($query,"profName")){
            $query.=" OR ";
        }
        $query.= " profID in (select profID from classes where className = '$class_name')";
    }
    // echo $query;
    return TCommon::getAll($query);
}

function getProfInfo(){
    $id = $_GET['id'];
    $query = "select * from `professors` where profID = $id ";
    $pro =  TCommon::getOne($query);
    return $pro;
}

function listReviewsByProfID(){
    $id = $_GET['id'];
    $query = "select r.* ,c.className ,u.userName from `reviews` r 
    left join classes c 
    on r.classID = c.classID
    left join user u 
    on u.studentID = r.studentID
    where r.profID =  $id
    order by date DESC
    limit 50";
    return TCommon::getAll($query);
}


function add_professor(){
    $r["success"] = false;
    $name = $_POST["name"];
    $department = $_POST["department"];
//    $age = $_POST["age"];
//    $sex = $_POST["sex"];

    $passValidation = true;
    $sql = "select count(*) from  professors where profName='$name' and department ='$department'";
    if ($passValidation && 0 != TCommon::getOneColumn($sql)) {
        $r["error"] = "info depulicated";  
        $passValidation = false;
    }
    // create
    if($passValidation){
        $sqlInsert = "insert into professors (profName , department, age,sex)
        values('$name','$department',1,1)";
        if (TCommon::execSql($sqlInsert)) {
            $r['success'] = true;
            $r['info'] = "$name added success";
        }
    }
    echo json_encode($r);
}