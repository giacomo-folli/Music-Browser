<?php

session_start();

//get page number
$page_number = $_GET['page'] ?? 1;
$page_number = (int) $page_number;
if($page_number < 1)
    $page_number = 1;

function is_logged_in():bool
{
    if(!empty($_SESSION['USER']) && is_array($_SESSION['USER']))
	{
		return true;
	}

	return false;
}

function is_admin():bool
{
    if(!empty($_SESSION['USER']) && is_array($_SESSION['USER']))
	{
		if($_SESSION['USER']['role'] == 'admin')
            return true;
	}

	return false;
}

function add_page_view($song_id)
{
    $query = "UPDATE songs SET views = views + 1 WHERE id = '$song_id' LIMIT 1";
    query($query);

    $row = query("SELECT * FROM songs WHERE id = '$song_id' LIMIT 1"); //calculate popularity
    if(!empty($row))
    {
        $now = time();
        $days = round(($now - strtotime($row[0]['date'])) / (3600*24));

        $popularity = 0;    
        if($days > 0)
            $popularity = ($row[0]['views'] + $row[0]['downloads']) / $days;

        query("UPDATE songs SET popularity = '$popularity' WHERE id = '$song_id' LIMIT 1");
    }
}

function add_song_download($song_id)
{
    $query = "UPDATE songs SET downloads = downloads + 1 WHERE id = '$song_id'";
    query($query);

    $row = query("SELECT * FROM songs WHERE id = '$song_id' LIMIT 1"); //calculate popularity
    if(!empty($row))
    {
        $now = time();
        $days = round(($now - strtotime($row[0]['date'])) / (3600*24));

        $popularity = 0;    
        if($days > 0)
            $popularity = ($row[0]['views'] + $row[0]['downloads']) / $days;

        query("UPDATE songs SET popularity = '$popularity' WHERE id = '$song_id' LIMIT 1");
    }
}

function auth($row)
{
	$_SESSION['USER'] = $row;
}

function get_image($path) 
{
    if(file_exists($path ?? ''))
        return $path;
    return "assets/images/13.jpg";
}

function user($key)
{
    if(!empty($_SESSION['USER'][$key]))
        return $_SESSION['USER'][$key];

    return '';
}  

function get_role()
{
    if(user('role') == 'music')
        return '';
    return '_user';
}

function esc($str) 
{  
    return htmlspecialchars($str);
}

function redirect(string $url)
{
    header("Location:$url.php");
    die;
}

function message($message = '', $delete = false)
{
    if(!empty($message)){
        $_SESSION['message'] = $message;
    } else {
        if (!empty($_SESSION['message'])) {
            $msg = $_SESSION['message'];

            if ($delete) 
                unset($_SESSION['message']);                
            return $msg;
        }
    }
    return '';
}

function old_value($key, $default = ""){
    
    if(!empty($_POST[$key]))
        return $_POST[$key];

    return $default;
}

function query($query) 
{
    //conn variable is defined in connection.php
    global $conn;

    $result = mysqli_query($conn, $query);
	if(!is_bool($result))
	{
		if(mysqli_num_rows($result) > 0)
		{
			$rows = [];
			while($row = mysqli_fetch_assoc($result))
			{
				$rows[] = $row;
			}

			return $rows;
		}
	}

	return false; 
}

function create_table() {
    $query = "
            CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user` varchar(30) NOT NULL,
            `first_name` varchar(30) NOT NULL,
            `last_name` varchar(30) NOT NULL,
            `email` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            `role` varchar(6) NOT NULL,
            `date` datetime NOT NULL,
            PRIMARY KEY (`id`),
            KEY `USR` (`user`),
            KEY `email` (`email`),
            KEY `date` (`date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ";

    $query = "
            CREATE TABLE `songs` (
            `ID` int(11) NOT NULL AUTO_INCREMENT,
            `USR_ID` varchar(11) NOT NULL,
            `file` varchar(1024) NOT NULL,
            `image` varchar(1024) NOT NULL,
            `title` varchar(100) NOT NULL,
            `views` int(11) DEFAULT 0 NOT NULL,
            `downloads` int(11) DEFAULT 0 NOT NULL,
            `popularity` int(11) DEFAULT 0 NOT NULL,
            `date` datetime NULL,
            PRIMARY KEY (`ID`),
            KEY `US_IDR` (`USR_ID`),
            KEY `date` (`date`),
            KEY `views` (`views`),
            KEY `downloads` (`downloads`),
            KEY `popularity` (`popularity`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ";

    query($query);

}
