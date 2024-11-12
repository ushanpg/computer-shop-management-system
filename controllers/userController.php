<?php
if (isset($_REQUEST["req"])) {
    include "../models/userModel.php";
    include "../models/loginModel.php";
    include "../models/roleModel.php";
    include "../services/session.php";
    $req = $_REQUEST["req"];

    switch ($req) {
        case 'signup':
?>
            <script>
                window.location = "../views/signup.php";
            </script>
            <?php
            break;

        case "signupConfirm":
            //Retrieve data
            if (isset($_POST)) {
                $email = strtolower($_POST['email']);
                $password = $_POST['password'];
                $first_name = strtolower($_POST['first_name']);
                $last_name = strtolower($_POST['last_name']);
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $nic = strtolower($_POST['nic']);
                $phone = strtolower($_POST['phone']);

                //Validate inputs
                $loginObject = new Login();

                if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                    throw new Exception("Invalid email format");
                } else {
                    $emailAvail = $loginObject->checkEmail($email);
                    $result = $emailAvail->fetch_assoc();
                    if ($result['COUNT(*)'] != 0) {
            ?>
                        <script>
                            window.location = "authController.php?req=login";
                            alert("U have already registered! Please Log-in");
                        </script>
                <?php
                        throw new Exception();
                    }
                }

                if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}/", $password) == FALSE) {
                    throw new Exception("Invalid password format");
                };

                if (preg_match("/[a-z]{1,50}/", $first_name) == FALSE) {
                    throw new Exception("Invalid first name format");
                };

                if (preg_match("/[a-z]{1,50}/", $last_name) == FALSE) {
                    throw new Exception("Invalid last name format");
                };

                if (preg_match("/[0-1]{1,1}/", $gender) == FALSE) {
                    throw new Exception("Invalid gender format");
                };

                list($year, $month, $day) = explode('-', $dob);
                if (checkdate($month, $day, $year) == FALSE) {
                    throw new Exception("Invalid date format");
                }

                if (preg_match("/[0-9]{9,12}[vxn]{0,1}/", $nic) == FALSE) {
                    throw new Exception("Invalid NIC format");
                };

                if (preg_match("/[0-9]{10,10}/", $phone) == FALSE) {
                    throw new Exception("Invalid phone no. format");
                };

                //  upload image          
                if ($_FILES["img"]["name"] != "") {

                    if ($_FILES['img']['size'] > 5242880) {
                        throw new Exception("The image file is too big!");
                    }
                    if ($_FILES['img']['size'] < 100) {
                        throw new Exception("The image file is corrupt!");
                    }
                    $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
                    if (($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif") != true) {
                        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF image files are allowed.");
                    }

                    $image = $_FILES["img"]["name"];
                    $image = "" . time() . "." . $ext;
                    $destination = "../images/user/$image";
                    move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
                } else {
                    if ($gender == 0) {
                        $image = "default.png";
                    }
                    if ($gender == 1) {
                        $image = "default2.png";
                    }
                }

                // Operate CRUD           
                $userObject = new User();
                $user_id = $userObject->signup($first_name, $last_name, $gender, $dob, $nic, $phone, $image);
                $hash = md5($password);

                $loginObject->addLogin($email, $hash, $user_id);

                ?>
                <script>
                    window.location = "authController.php?req=login";
                    alert("The new account created successfully. Please Log-in.");
                </script>
            <?php
            }

            break;

        case "user":
            $roleObject = new Role();
            $result = $roleObject->getRoles();
            $roles = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($roles, $row);
            }
            $_SESSION['roles'] = $roles;

            $userObject = new User();
            $result = $userObject->getUsers();
            $users = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($users, $row);
            }
            $data = base64_encode(serialize($users));
            ?>
            <script>
                window.location = "../views/users.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'addUser':
            $roleObject = new Role();
            $result = $roleObject->getRoles();
            $roles = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($roles, $row);
            }
            $data = base64_encode(serialize($roles));
        ?>
            <script>
                window.location = "../views/addUser.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case "addUserConfirm":
            //Retrieve data
            if (isset($_POST)) {
                $email = strtolower($_POST['email']);
                $password = $_POST['password'];
                $first_name = "Staff";
                $last_name = "User";
                $image = "staff.png";
                $role_id = $_POST['role'];

                //Validate inputs
                $loginObject = new Login();

                if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                    throw new Exception("Invalid email format");
                } else {
                    $emailAvail = $loginObject->checkEmail($email);
                    $result = $emailAvail->fetch_assoc();
                    if ($result['COUNT(*)'] != 0) {
            ?>
                        <script>
                            alert("The email have already registered! Please use another.");
                            history.back();
                        </script>
                <?php
                        throw new Exception();
                    }
                }

                if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}/", $password) == FALSE) {
                    throw new Exception("Invalid password format");
                };

                //Operate CRUD           
                $userObject = new User();
                $user_id = $userObject->addUser($first_name, $last_name, $image, $role_id);
                $hash = md5($password);

                $loginObject->addLogin($email, $hash, $user_id);

                ?>
                <script>
                    window.location = "userController.php?req=user";
                    alert("The new account created successfully.");
                </script>
            <?php
            }
            break;

        case "updateStatus":
            $id = $_REQUEST["id"];
            $status = $_REQUEST["status"];

            $userObject = new User();
            $result = $userObject->updateStatus($id, $status);
            ?>
            <script>
                window.location = "userController.php?req=user";
            </script>
        <?php
            break;

        case "editUser":
            $id = $_REQUEST["id"];
            $userObject = new User();
            $result = $userObject->editUser($id)->fetch_assoc();
            $data = base64_encode(serialize($result));

        ?>
            <script>
                window.location = "../views/editUser.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case "updateUser":
            //Retrieve data
            if (isset($_POST)) {
                $id = $_POST['id'];
                $email = strtolower($_POST['email']);
                $first_name = strtolower($_POST['first_name']);
                $last_name = strtolower($_POST['last_name']);
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $nic = strtolower($_POST['nic']);
                $phone = strtolower($_POST['phone']);
                $image = $_POST['currImage'];

                //Validate inputs
                $loginObject = new Login();

                if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                    throw new Exception("Invalid email format");
                } else {
                    $emailAvail = $loginObject->checkEmail($email);
                    $result = $emailAvail->fetch_assoc();
                    if ($result['COUNT(*)'] > 1) {
            ?>
                        <script>
                            history.back();
                            alert("Invalid email. Please use another.");
                        </script>
                <?php
                        throw new Exception();
                    }
                }

                if (preg_match("/[a-z]{1,50}/", $first_name) == FALSE) {
                    throw new Exception("Invalid first name format");
                };

                if (preg_match("/[a-z]{1,50}/", $last_name) == FALSE) {
                    throw new Exception("Invalid last name format");
                };

                if (preg_match("/[0-1]{1,1}/", $gender) == FALSE) {
                    throw new Exception("Invalid gender format");
                };

                list($year, $month, $day) = explode('-', $dob);
                if (checkdate($month, $day, $year) == FALSE) {
                    throw new Exception("Invalid date format");
                }

                if (preg_match("/[0-9]{9,12}[vxn]{0,1}/", $nic) == FALSE) {
                    throw new Exception("Invalid NIC format");
                };

                if (preg_match("/[0-9]{10,10}/", $phone) == FALSE) {
                    throw new Exception("Invalid phone no. format");
                };

                //Upload image          
                if ($_FILES["img"]["name"] != "") {

                    if ($_FILES['img']['size'] > 5242880) {
                        throw new Exception("The image file is too big!");
                    }
                    if ($_FILES['img']['size'] < 100) {
                        throw new Exception("The image file is corrupt!");
                    }
                    $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
                    if (($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif") != true) {
                        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF image files are allowed.");
                    }

                    $image = "" . time() . "." . $ext;
                    $destination = "../images/user/$image";
                    move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
                }

                //Operate CRUD     
                $userObject = new User();
                $userObject->updateUser($id, $first_name, $last_name, $gender, $dob, $nic, $phone, $image);
                ?>
                <script>
                    history.back();
                    alert("The changes has been saved successfully.");
                </script>
            <?php
                break;
            }

        case 'updatePassword':
            $user_id = $_REQUEST["id"];

            ?>
            <script>
                window.location = "../views/updatePassword.php?user_id=<?php echo ($user_id) ?>";
            </script>
            <?php
            break;

        case 'updatePasswordConfirm':
            if (isset($_POST)) {
                //Retrieve & validate data
                $user_id = $_POST["user_id"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["confirmPassword"];

                if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}/", $password) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                if ($confirmPassword != $password) {
            ?>
                    <script>
                        alert("The new password & confirm fields does not match. Check again for typos.");
                        history.back();
                    </script>
                <?php
                    throw new Exception("Error Processing Request");
                }

                $password = md5($password); //Generate Hash

                //Operate CRUD
                $loginObject = new Login();
                $result = $loginObject->updatePassword($user_id, $password);
                ?>
                <script>
                    alert("The password of user account has updated successfully.");
                    history.back();
                </script>
<?php
                break;
            }
    }
}
