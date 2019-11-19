<?php

function get_user_info($username)
{

    $db = new PDO('sqlite:web.db');
        $stmt = $db->prepare('Select * from User where username = :username_wanted');
        $stmt->bindParam(':username_wanted', $username);
        $stmt->execute();
        $user_info = $stmt->fetch(); 
?>
        <ul>
        <li><?= $user_info['username'] ?></li>
        <li><?= $user_info['email'] ?></li>
        <li><?= $user_info['profile_image'] ?></li>
        <li><?= $user_info['birthday'] ?></li>
        <li><?= $user_info['nationality'] ?></li>

    </ul> 
<?php

}

$user_given = $_GET['username'];
get_user_info($user_given);

    get_user_rented($user_given);
    function get_user_rented($username){
        $db = new PDO('sqlite:web.db');
        $stmt = $db->prepare('Select * from Rented JOIN Story where Rented.renter = :username_wanted and Rented.story = Story.id');
        $stmt->bindParam(':username_wanted', $username);
        $stmt->execute();
        $user_info = $stmt->fetchAll(); 
        var_dump($user_info);
    }
?>