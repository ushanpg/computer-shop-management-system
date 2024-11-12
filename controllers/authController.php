<?php
if (isset($_REQUEST["req"])) {
    include "../models/loginModel.php";
    include "../models/roleModel.php";
    include "../models/moduleModel.php";
    $req = $_REQUEST["req"];

    switch ($req) {
        case 'login':
            $data = base64_encode(serialize($_COOKIE));
?>
            <script>
                window.location = "../views/login.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case "loginConfirm":
            //Retrieve data
            if (isset($_POST)) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                //Validate inputs
                if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                    throw new Exception("Invalid email format");
                }

                if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}/", $password) == FALSE) {
                    throw new Exception("Invalid password format");
                };

                //Operate CRUD
                $password = md5($password);
                $loginObject = new Login();
                $user = $loginObject->loginUser($email, $password)->fetch_assoc();

                if (!isset($user['id'])) {
            ?>
                    <script>
                        window.location = "authController.php?req=login";
                        alert("Credentials error: The username and password does not match!");
                    </script>
                <?php
                    throw new Exception();
                }

                if ($user['status'] != 1) {
                ?>
                    <script>
                        window.location = "authController.php?req=login";
                        alert("Ur account is disabled. Please contact us for more information.");
                    </script>
                <?php
                    throw new Exception();
                }

                $roleObject = new Role();
                $role = $roleObject->getRoleByUser($user['id'])->fetch_assoc();

                $moduleObject = new Module();
                $modules =  $moduleObject->getModulesByUser($role['id']);
                $userModules = [];
                while ($row = mysqli_fetch_row($modules)) {
                    array_push($userModules, $row);
                }

                session_start(); //Start a session

                //Create the remember me cookie
                if (isset($_POST["rememberMe"])) {
                    setcookie("email", $_POST['email'], time() + 606024 * 30);
                    setcookie("password", $_POST['password'], time() + 606024 * 30);
                } else {
                    setcookie("email", "", time() - 606024 * 30);
                    setcookie("password", "", time() - 606024 * 30);
                }

                $_SESSION["userData"] = $user;
                $_SESSION["userRole"] = $role;
                $_SESSION["userModules"] = $userModules;

                if ($role['id'] == 7) {
                ?>
                    <script>
                        window.location = "../index.php";
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        window.location = "authController.php?req=dashboard";
                    </script>
            <?php
                }
            }
            break;

        case 'dashboard':
            ?>
            <script>
                window.location = "../views/dashboard.php";
            </script>
        <?php
            break;

        case "logout":
            session_start();
            session_destroy();
        ?> <script>
                window.location = "../index.php"
            </script>
<?php
            break;
    }
}
