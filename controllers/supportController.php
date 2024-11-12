<?php
if (isset($_REQUEST["req"])) {
    include "../models/supportModel.php";
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
        case 'support':
            $supportObject = new Support();

            $result = $supportObject->getTokens();
            $tokens = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($tokens, $row);
            }
            $data = base64_encode(serialize($tokens));
        ?>
            <script>
                window.location = "../views/support.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'addToken':
            if (isset($_POST)) {
                $supportObject = new Support();

                //Retrieve user id
                $user_id = $_SESSION['userData']['id'];
                //Retrieve & validate inputs
                $type = $_POST['type'];
                if (preg_match("/[A-Za-z0-9\s.,]{1,256}/", $_POST['description']) == FALSE) {
                    throw new Exception("Error Processing Request");
                } else {
                    $description = $_POST['description'];
                }
                $token_no = time();

                //Operate CRUD
                $id = $supportObject->addToken($token_no, $user_id, $type, $description);
            ?>
                <script>
                    window.location = "supportController.php?req=trackToken";
                </script>
            <?php
                break;
            }

        case 'trackToken':
            if (isset($_POST)) {
                $user_id = $_SESSION['userData']['id'];
                $supportObject = new Support();

                //Operate CRUD
                $result = $supportObject->getTokensByUser($user_id);
                $tokens = [];
                while ($row = mysqli_fetch_row($result)) {
                    array_push($tokens, $row);
                }
                $data = base64_encode(serialize($tokens));
            ?>
                <script>
                    window.location = "../views/supportReq.php?data=<?php echo ($data) ?>";
                </script>
            <?php
                break;
            }

        case "updateToken":
            if (isset($_POST)) {
                $id = $_POST["id"];
                $type = $_POST["type"];
                $fee = $_POST["fee"];
                $status = $_POST["status"];

                //Operate CRUD
                $supportObject = new Support();
                $result = $supportObject->updateToken($id, $type, $fee, $status);
            ?>
                <script>
                    window.location = "supportController.php?req=support";
                </script>
            <?php
                break;
            }

        case 'filterSort':
            //Retrieve & validate data
            $type = $_POST["type"];
            $sort = $_POST["sort"];

            if (preg_match("/[A-Za-z0-9\s]{1,50}/", $_POST["search"]) == FALSE) {
                $search = 0;
            } else {
                $search = $_POST["search"];
            }

            $supportObject = new Support();
            $result = $supportObject->filterSort($type, $sort, $search);

            $tokens = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($tokens, $row);
            }
            $data = base64_encode(serialize($tokens));
            ?>
            <script>
                window.location = "../views/support.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'deleteToken':
            $id = $_REQUEST["id"];
            $supportObject = new Support();

            //Operate CRUD
            $result = $supportObject->deleteToken($id);
        ?>
            <script>
                window.location = "supportController.php?req=support";
            </script>
<?php
            break;
    }
}
