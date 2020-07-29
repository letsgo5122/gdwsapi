<!DOCTYPE html>
<html>
<body>

<?php
include("db.php");
//$action = $_POST('act');
//$name = $_POST['name'];
//$nick = $_POST['nick'];
//$passwd = $_POST['passwd'];




function insertUser($pdo ,$name, $nick, $passwd){
    $sql = 'INSERT INTO public.user(name,nick,passwd) VALUES(:name,:nick,:passwd)';
    $stmt = $pdo->prepare($sql);
        
    // pass values to the statement
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':nick', $nick);
    $stmt->bindValue(':passwd', $passwd);
    // execute the insert statement
    $stmt->execute();
    // return generated id
    return $pdo->lastInsertId('user_id_seq');
}
function listUser($pdo){
	$list = '';
	try{
	$sqlList = "SELECT * from public.user";
	foreach($pdo->query($sqlList) as $row)
		{
			//print"<br/>";
			//print $row['id'].'-'.$row['name'].'-'.$row['nick'].'<br/>';
			$list = $list.$row['id'].'-'.$row['name'].'-'.$row['nick'].'<br/>';
		}
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	return $list;
}
	
	
	
$action = 'list';

switch ($action) {
  case 'list':
    echo listUser($pdo);
    break;
  case 'insert':
    echo insertUser($pdo ,'Insert','ok' ,'1111pas');
    break;
  case 2:
    echo "變數是 2";
    break;
}	
?>

</body>	
</html>
