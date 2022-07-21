<?

$dbHOST = "localhost";
$dbUSER = "root";
$dbPASS = "";
$dbNAME = "test";


$db = mysqli_connect($dbHOST,$dbUSER,$dbPASS,$dbNAME);
mysqli_set_charset($db,'utf8');

if(!$db){
        $file = fopen("sqlLOGERROR.txt","w+");
        fwrite($file, mysqli_error(mysqli_connect($dbHOST,$dbUSER,$dbPASS,$dbNAME))+date('d.m.Y 00:00:00', time())+"\n");
        fclose($file);
exit();}


function SelectUser($id){
    global $db;

    $query = "SELECT * FROM `users` WHERE `id` = '{$id}' "; 

    return mysqli_query($db, $query);
}


function GetAccount(){
    global $db;

    $query = "SELECT * FROM `account` ";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
    $array[] = $row;
    }
    if($array != null)
    return $array;

    return false;
  }

  function GetAllLogs($CurrentPage = 0, $MaxCount){
    global $db;

    $MaxCount = SECURE($MaxCount);
    $CurrentPage = SECURE($CurrentPage);

    $query = "SELECT * FROM `logs` WHERE 1 ORDER BY `id` DESC LIMIT {$CurrentPage}, {$MaxCount}";
    $result = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    return $array;
}	

function GetLogs($CurrentPage = 0, $MaxCount, $login){
    global $db;

    $MaxCount = SECURE($MaxCount);
    $CurrentPage = SECURE($CurrentPage);
    $login = SECURE($login);

    $query = "SELECT * FROM `logs` WHERE `login` = '{$login}' or `id` = '{$login}' ORDER BY `id` DESC LIMIT {$CurrentPage}, {$MaxCount}";
    $result = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    return $array;
}

function profile($login){
    global $db;

    $login = SECURE($login);

    $query = "SELECT COUNT(*) FROM `logs` WHERE `login` = '{$login}'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['COUNT(*)'];
}


function deleteLog($id){
    global $db;

    $id = SECURE($id);

    $query = "DELETE FROM `logs` WHERE `id` = '{$id}' LIMIT 1";

    return mysqli_query($db, $query);

}

function GetUser($info){
    global $db;

    $info = SECURE($info);

    $query = "SELECT * FROM `account` WHERE `id` = '{$info}' or `login` = '{$info}' or `email` = '{$info}' LIMIT 1";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    if($row == null)
        return false;

    return $row;
}

function GetTicketInfo($id){
    global $db;

    $id = SECURE($id);

    $query = "SELECT * FROM `resethwid` WHERE `id` = '{$id}' LIMIT 1";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    if($row == null)
        return false;

    return $row;
}
function GetSettingByName($name){
    global $db;

    $name = SECURE($name);

    $query = "SELECT `value` FROM `settings` WHERE `name` = '{$name}' LIMIT 1";

    $result = mysqli_query($db, $query);
    
    $row = mysqli_fetch_assoc($result);

    if($row == null)
        return false;

    return $row['value'];
}

function GetAllSettings(){
    global $db;

    $query = "SELECT * FROM `settings` WHERE 1";

    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        $array[] = $row;
    }
    return $array;
}

function saveSettings($data){
    global $db;

    foreach ($data as $key => $value) {
        $key = SECURE($key);
        $value = SECURE($value);

        $query = "UPDATE `settings` SET `value` = '{$value}' WHERE `name` = '{$key}' ";
        mysqli_query($db, $query);
    }
    return;
}

function GetAllTickets($CurrentPage = 0, $MaxCount, $sort = null){
    global $db;

    $MaxCount = SECURE($MaxCount);
    $CurrentPage = SECURE($CurrentPage);
    if($sort['value'] != null){
        $sort['sort'] = SECURE($sort['sort']);
        $sort['value'] = SECURE($sort['value']);
        $query = "SELECT * FROM `tickets` WHERE `{$sort['sort']}` = '{$sort['value']}' ORDER BY `id` DESC LIMIT {$CurrentPage}, {$MaxCount}";

    }else{
        $query = "SELECT * FROM `tickets` WHERE 1 ORDER BY `id` DESC LIMIT {$CurrentPage}, {$MaxCount}";
    }

    $result = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    return $array;
}


function acceptTicket($id, $login ,$accepted){
    global $db;

    $id = SECURE($id);
    $login = SECURE($login);
    $accepted = SECURE($accepted);

    $query = "UPDATE `tickets` SET `status`= 'accept' , `accepted` = '{$accepted}' WHERE `id` = '{$id}'";
    mysqli_query($db, $query);


    $query = "UPDATE `users` SET `binding` = NULL WHERE `login` = '{$login}' LIMIT 1";

    return mysqli_query($db, $query);
}

function declineTicket($id, $login){
    global $db;

    $id = SECURE($id);
    $login = SECURE($login);

    $query = "UPDATE `tickets` SET `status`= 'decline' ,`accepted` = '{$login}' WHERE `id` = '{$id}'";

    return mysqli_query($db, $query);
}

function deleteTicket($id){
    global $db;

    $id = SECURE($id);

    $query = "DELETE FROM `tickets` WHERE `id` = '{$id}'";

    return mysqli_query($db, $query);
}

function GetAllUsers($CurrentPage = 0, $MaxCount = false){
    global $db;

    $MaxCount = SECURE($MaxCount);
    $CurrentPage = SECURE($CurrentPage);


    if($MaxCount != false){
        $query = "SELECT * FROM `users` WHERE 1 ORDER BY `id` DESC LIMIT {$CurrentPage}, {$MaxCount}";
    }else{$query = "SELECT * FROM `users` WHERE 1";}

    $result = mysqli_query($db, $query);
    if ($result === false){
        $array[] = "error";
    }else{
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }
    }
    
    return $array;
}


function deleteUser($id){
    global $db;

    $id = SECURE($id);

    $query = "DELETE FROM `users` WHERE `id` = '{$id}' LIMIT 1";

    return mysqli_query($db, $query);
}


function saveUser($massive){

    global $db;

    $id = SECURE($massive['id']);
    $login = SECURE($massive['login']);
    $email = SECURE($massive['email']);
    $password = md5(SECURE($massive['password']));
    $binding = SECURE($massive['binding']);
    $subscription = strtotime(SECURE($massive['subscription']));
    $class = SECURE($massive['class']);
    $date_register = strtotime(SECURE($massive['date_register']));
    $info = SECURE($massive['info']);

    if($massive['password']){
        $query = "UPDATE `users` SET
        `login`= '{$login}',
        `email`= '{$email}',
        `password`= '{$password}',
        `binding`= '{$binding}',
        `subscription`= '{$subscription}',
        `class`= '{$class}',
        `date_register`= '{$date_register}'
        `info`= '{$info}'
        WHERE `id` = '{$id}' ";
    }else{
        $query = "UPDATE `users` SET
        `login`= '{$login}',
        `email`= '{$email}',
        `binding`= '{$binding}',
        `subscription`= '{$subscription}',
        `class`= '{$class}',
        `date_register`= '{$date_register}'
        `info`= '{$info}'
        WHERE `id` = '{$id}' ";
    }

    return mysqli_query($db, $query);
}
function CheckUser($login, $password){
    global $db;

    $login = SECURE($login);
    $password = md5(SECURE($password));

    $query = "SELECT * FROM `account` WHERE (`mail` = '{$login}' or `Name` = '{$login}') and `Password` = '{$password}' LIMIT 1";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    if($row != null)
        return $row;

    return false;
}
function GiveInfo($id){
    global $db;

    $id = SECURE($id);

    $query = "SELECT * FROM `account` WHERE `id` = '{$id}' or `Name` = '{$id}' or `mail` = '{$id}' LIMIT 1";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);

    if($row != null){return $row;}
    if($row == null){return false;}
}

function setclassUser($id){
    global $db;

    $id = SECURE($id);
    $action = GiveInfo($id);

    if($action['class'] == "banned"){
        $query = "UPDATE `users` SET `class`= 'user' WHERE `id` = '{$id}' or `login` = '{$id}' LIMIT 1";
    }else{
        $query = "UPDATE `users` SET `class`= 'banned' WHERE `id` = '{$id}' or `login` = '{$id}' LIMIT 1";
    }return mysqli_query($db, $query);
}
function register($login, $email, $password, $referer, $ipuser){
    global $db;


    $login = SECURE($login);
    $email = SECURE($email);
    $referer = SECURE($referer);
    $password = md5(SECURE($password));
    $date_register = date("d.m.Y");
    $ip = $ipuser;

    $query = "INSERT INTO `account`(`Name`, `Password`, `mail`, `datareg`, `ipreg`, `statusres`, `referal`)
    VALUES ('{$login}', '{$password}', '{$email}', '{$date_register}', '{$ip}', '0', '{$referer}')";

    return mysqli_query($db, $query);
}

function ResetPassword($login, $password){
    global $db;

    $login = SECURE($login);
    $password = md5(SECURE($password));

    $query = "UPDATE `account` SET `Password`= '{$password}' WHERE `Name` = '{$login}' LIMIT 1";

    return mysqli_query($db, $query);
}

function DeleteLogByLogin($login){
    global $db;

    $login = SECURE($login);

    $query = "DELETE FROM `logs` WHERE `login` = '{$login}'";

    return mysqli_query($db, $query);
}
  function GetAccountSearch($search){
    global $db;

    $search = SECURE($search);

    $query = "SELECT * FROM `account` WHERE `Name` = '{$search}' or `mail` = '{$search}' or `ipreg` = '{$search}' or `id` = '{$search}' ";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
    $array[] = $row;
    }
    if($array != null)
    return $array;

    return false;
  }

function UpdateUser($id){
    global $db;

    $id = htmlspecialchars(mysqli_escape_string($db, $id));

    $query = "UPDATE `account` SET `privilege`= 'user' WHERE `id` = '{$id}'";

    return mysqli_query($db, $query);
}

function Resetdata($id){
    global $db;

    $id = htmlspecialchars(mysqli_escape_string($db, $id));

    $query = "DELETE FROM `account` WHERE `id` = '{$id}' LIMIT 1";

    return mysqli_query($db, $query);
}

function createSmartyRsArray($result){
	if (!$result) return false;
	$smartyRs = array();    
	while  ($row = mysqli_fetch_assoc($result))
	{
		$smartyRs[] = $row;
	}
	return $smartyRs;
}




function SECURE($string){
	global $db;

	$string = htmlspecialchars(mysqli_escape_string($db, $string));

	return $string;
}


function TableCount ($Table = null, $sort = null){
	global $db;
	if($Table == null){return false;}

	$Table = SECURE($Table);

	if($sort['value']){
		$sort['sort'] = SECURE($sort['sort']);
		$sort['value'] = SECURE($sort['value']);
		$query = "SELECT COUNT(*) FROM $Table WHERE `{$sort['sort']}` = '{$sort['value']}'";
	}else{
		$query = "SELECT COUNT(*) FROM $Table WHERE 1";
	}

	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);

	return $row['COUNT(*)'];
}

// function QUERY($query, $one = 0){
// 	global $db;

// 	$one = SECURE($one);

// 	$result = mysqli_query($db, $query);

// 	if(!$result){
// 		return file_put_contents('mysqli.txt', date('d.m.Y H:i:s') . ' - ' . mysqli_error($db) . "\r\n" , FILE_APPEND);
// 	}

// 	if($one == 1){

// 		while ($row = mysqli_fetch_assoc($result)) {
// 			$array[] = $row;
// 		}

// 		if($array != null)
// 			return $array;

// 		return false;

// 	}else{
// 		$result = mysqli_fetch_assoc($result);
// 	}

// 	if($result != null)
// 		return $result;

// 	return false;
// }

function QUERY($query){
	global $db;

	$query = SECURE($query);

	$result = mysqli_query($db, $query);

    file_put_contents('mysqli.txt', date('d.m.Y H:i:s') . ' Request - ' . $query . "\r\n" , FILE_APPEND);

    file_put_contents('mysqli.txt', date('d.m.Y H:i:s') . ' Respond - ' . $result . "\r\n" , FILE_APPEND);

	if(!$result){
		return file_put_contents('mysqli.txt', date('d.m.Y H:i:s') . ' - ' . mysqli_error($db) . "\r\n" , FILE_APPEND);
	}

	if($result != null)
		return $result;

	return false;
}


function percent($all, $need){

	return ceil((100 * $need) / $all);
}
