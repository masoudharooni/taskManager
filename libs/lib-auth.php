<?php

/**----------------------------------------------------------------------------Current user id---------------------------------------------------------------------------- */

function getCurruntUserId()
{
    return getLoggedInUser()['id'] ?? 0;
}

/**----------------------------------------------------------------------------Is Logged in function---------------------------------------------------------------------------- */

function isLoggedIn()
{
    return $_SESSION['login'] ?? false;
}

/**----------------------------------------------------------------------------Get Logged in uder function---------------------------------------------------------------------------- */

function getLoggedInUser()
{
    return $_SESSION['login'] ?? null;
}

/**----------------------------------------------------------------------------Get User By Email function---------------------------------------------------------------------------- */

function getUserByEmail(string $email)
{
    global $conn;
    $sql = "SELECT id , username , email , password , creat_at FROM users WHERE email LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->bind_result($id, $username, $emailNow, $password, $created_at);
    $stmt->execute();
    $stmt->fetch();
    $result = [
        'id' => $id,
        'username' => $username,
        'email' => $emailNow,
        'password' => $password,
        'created_at' => $created_at,
        'image' => "https://www.gravatar.com/avatar/" . md5(strtolower(trim($emailNow)))
    ];

    if (!is_null($result['id'])) {
        return $result;
    }
    return null;
}

/**----------------------------------------------------------------------------Logout function---------------------------------------------------------------------------- */

function logout()
{
    unset($_SESSION['login']);
}

/**----------------------------------------------------------------------------Login function---------------------------------------------------------------------------- */

function login(string $email, string $password)
{
    $user = getUserByEmail($email);
    #Cechk email exist
    if (is_null($user)) {
        return false;
    }
    #Check The Password
    if (password_verify($password, $user['password'])) {
        #login true
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}


/**----------------------------------------------------------------------------Is Unique data---------------------------------------------------------------------------- */


function isUnique(string $username, string $email): bool
{
    global $conn;
    $sql = "SELECT COUNT(username) AS usernameCount , COUNT(email) AS eamilCount FROM users WHERE username LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->bind_result($usernameCount, $eamilCount);
    $stmt->execute();
    $stmt->fetch();
    if ($usernameCount > 0 or $eamilCount > 0) {
        return false;
    }
    return true;
}




/**-----------------------------------------REGISTER FUNCTION-----------------------------------------*/


function register($params)
{
    global $conn;
    /**-----------------------------------------User Name Validation-----------------------------------------*/

    $paternUsername = '/^[a-zA-Z0-9]{5,}$/';
    $result = [
        'bool' => null,
        'alert' => null
    ];
    if (!preg_match($paternUsername, $params['username'])) {
        $result['bool'] = false;
        $result['alert'] = "Your User Name not Valid , userName must contains at 5 character without space!";
        return $result;
    }

    /**-----------------------------------------Password Validation-----------------------------------------*/

    if (isset($params['password']) and !empty($params['password']) and $params['password'] == $params['rptpassword']) {
        $password = $params['password'];
        if (strlen($password) <= 8) {
            $result['bool'] = false;
            $result['alert'] = "Your Password Must Contain At 8 Charackter !";
            return $result;
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $result['bool'] = false;
            $result['alert'] = "Your Password Must Contain At least 1 Number!";;
            return $result;
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $result['bool'] = false;
            $result['alert'] = "Your Password Must Contain At least 1 Capital Letter!";
            return $result;
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $result['bool'] = false;
            $result['alert'] = "Your Password Must Contain At least 1 Lowecase Letter!";
            return $result;
        }
    } else {
        $result['bool'] = false;
        $result['alert'] = "Your Password Is Empty Or Not Equil With Reapet Password !";
        return $result;
    }

    /**-----------------------------------------Email Validation-----------------------------------------*/
    if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
        $result['bool'] = false;
        $result['alert'] = "Your Email Not Valid !";
        return $result;
    }

    /**-----------------------------------------username and email is unique-----------------------------------------*/

    if (!isUnique($params['username'], $params['email'])) {
        $result['bool'] = false;
        $result['alert'] = "This Email Or Username Repetitive!";
        return $result;
    }

    /**-----------------------------------------SQL Code-----------------------------------------*/

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username , email , password) VALUES (? , ? , ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $params['username'], $params['email'], $passwordHash);
    if ($stmt->execute()) {
        $result['bool'] = true;
        $result['alert'] = "Registered";
        return $result;
    }
    $result['bool'] = false;
    $result['alert'] = "Not Registered!";
    return $result;
}

/**-----------------------------------------is there the email-----------------------------------------*/

function isThereEmail(string $email): bool
{
    global $conn;
    $sql = "SELECT id FROM users WHERE email LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->bind_result($id);
    $stmt->execute();
    $stmt->fetch();
    if (!is_null($id) and is_numeric($id)) {
        return true;
    }
    return false;
}

/**-----------------------------------------Send Code To User Email For Pass Recovery-----------------------------------------*/

function sendEmail(string $email)
{
    $subject = "Password Recovery";
    $code = rand(100000, 999999);
    $massage = "Enter This Code Inside input of Code in the website ->{$code}";
    $send = mail($email, $subject, $massage);
    if ($send) {
        $sendMassage = "email sended!";
        $result = [
            'massage' => $sendMassage,
            'code'    => $code
        ];
        return $result;
    }
    $sendMassage = "email not sended!";
    $result = [
        'massage' => $sendMassage,
        'code'    => null
    ];
    return $result;
}
/**-----------------------------------------Update Password Recovery-----------------------------------------*/

function updatePass(string $email, string $password)
{
    global $conn;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $passwordHash, $email);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}
/**-----------------------------------------Allow Password Recovery-----------------------------------------*/
function allowPass(string $password): bool
{
    if (strlen($password) <= 8) {
        return false;
    } elseif (!preg_match("#[0-9]+#", $password)) {
        return false;
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        return false;
    } elseif (!preg_match("#[a-z]+#", $password)) {
        return false;
    }
    return true;
}
