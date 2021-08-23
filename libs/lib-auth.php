<?php

/**----------------------------------------------------------------------------Current user id---------------------------------------------------------------------------- */

function getCurruntUserId()
{
    return 1;
}

/**----------------------------------------------------------------------------Logged in function---------------------------------------------------------------------------- */

function isLoggedIn()
{
    return false;
}

function login(string $email, string $password)
{
    return 1;
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
