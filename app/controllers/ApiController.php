<?php

class ApiController extends BaseController {

	/**
	 * Contact us page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		if (isset($_POST['tag']) && $_POST['tag'] != '') {
		// get tag
		$tag = $_POST['tag'];
		$response = array("tag" => $tag, "success" => 0, "error" => 0);
		switch ($tag) {
        case 'login':
            // Request type is check Login
            $email = $_POST['email'];
            $password = $_POST['password'];

            // check for user
            $user = $db->getUserByEmailAndPassword($email, $password);
            if ($user != false) {
                // user found
                // echo json with success = 1
                $response["success"] = 1;
                $response["uid"] = $user["id"];
                $response["user"]["first_name"] = $user["first_name"];
                $response["user"]["last_name"] = $user["last_name"];
                $response["user"]["email"] = $user["email"];
                $response["user"]["created_at"] = $user["created_at"];
                $response["user"]["updated_at"] = $user["updated_at"];
                echo json_encode($response);
            } else {
                // user not found
                // echo json with error = 1
                $response["error"] = 1;
                $response["error_msg"] = "Incorrect email or password!";
                echo json_encode($response);
            }

            break;
        case 'register':
            // Request type is Register new user
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // check if user is already existed
            if ($db->isUserExisted($email)) {
                // user is already existed - error response
                $response["error"] = 2;
                $response["error_msg"] = "User already existed";
                echo json_encode($response);
            } else {
                // store user
                $user = $db->storeUser($first_name, $last_name, $email, $password);
                if ($user) {
                    // user stored successfully
                    $response["success"] = 1;
                    $response["uid"] = $user["unique_id"];
                    $response["user"]["first_name"] = $user["first_name"];
                    $response["user"]["last_name"] = $user["last_name"];
                    $response["user"]["email"] = $user["email"];
                    $response["user"]["created_at"] = $user["created_at"];
                    $response["user"]["updated_at"] = $user["updated_at"];
                    echo json_encode($response);
                } else {
                    // user failed to store
                    $response["error"] = 1;
                    $response["error_msg"] = "Error occured in Registartion";
                    echo json_encode($response);
                }
            }

            break;
        case 'search':
            $uid = $_POST['uid'];
            $email = $_POST['email'];
            $pattern = $_POST['pattern'];
            if ($db->isUserExisted($email)) {
                $users = $db->usersByPattern($email, $password);

                if ($users != false) {
                    foreach ($users as $key => $value) {
                        //here prepare the composed JSON
                    }
                } else {
                    $response["error"] = 1;
                    $response["error_msg"] = "No user found!";
                    echo json_encode($response);
                }
            } else {
                $response["error"] = 1;
                $response["error_msg"] = "Incorrect email or password 1!";
                echo json_encode($response);
            }



            break;
        case 'sync':
            echo "SYNC";

            break;
        default:
            break;
    }
	}
}
