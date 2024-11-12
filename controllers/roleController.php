<?php
if (isset($_REQUEST["req"])) {
    include "../models/roleModel.php";
    include "../models/moduleModel.php";
    include "../models/moduleRoleModel.php";
    include "../services/session.php";
    $req = $_REQUEST["req"];

    if (!isset($_SESSION['userData'])) {
?>
        <script>
            window.location = "authController.php?req=login";
        </script>
        <?php
        throw new Exception("Error Processing Request", 1);
    }

    switch ($req) {
        case 'roles':
            $roleObject = new Role();
            $result = $roleObject->getRoles();
            $roles = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($roles, $row);
            }
            $_SESSION['roles'] = $roles;

            $moduleObject = new Module();
            $result = $moduleObject->getModulesAll();
            $modules = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($modules, $row);
            }
            $_SESSION['modules'] = $modules;

            $moduleRoleObject = new ModuleRole();
            $result = $moduleRoleObject->getModuleRoleAll();
            $moduleRole = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($moduleRole, $row);
            }
            $_SESSION['moduleRole'] = $moduleRole;
        ?>
            <script>
                window.location = "../views/roles.php";
            </script>
            <?php
            break;

        case 'updateRole':
            if (isset($_POST)) {
                $role_id = $_POST['id'];
                $moduleRoleObject = new ModuleRole();
                $result = $moduleRoleObject->deleteModules($role_id);
                $modules = $_SESSION['modules'];
                foreach ($modules as $module) {
                    if (isset($_POST[str_replace(" ", "_", $module[1])])) {
                        $module_id = $module[0];
                        $result = $moduleRoleObject->addModule($role_id, $module_id);
                    }
                }
            ?>
                <script>
                    window.location = "roleController.php?req=roles";
                </script>
<?php
                break;
            }
    }
}
