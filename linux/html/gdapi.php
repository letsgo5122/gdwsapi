<?php
include("db.php");
//$act = $_POST['act'];
//$name = $_POST['name'];
//$nick = $_POST['nick'];
//$passwd = $_POST['passwd'];

$act = 'listUser';
$name = 'Ann';

switch ($act) {
  case 'listUser':
    echo listUser($pdo,$name);
    break;
  case 'all':
    echo allUsers($pdo);
    break;
  case 'insert':
    echo insertUser($pdo ,$name,$nick,$passwd);
    break;
  case 'update':
    echo updateUser($pdo,$name,$nick,$passwd);
    break;
  case 'delete':
    echo deleteUser($pdo,$name,$passwd);
    break;
}

function listUser($pdo,$name){
	$list = '';
  try{
	$sql = "SELECT id,name,nick FROM public.user WHERE name = :name" ;
	$stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->execute();
	$result = $stmt->fetchAll();   
	if ($sql==null){return 0;}
	
 	foreach($result as $row)
		{			
			$list .= $row[0].'-'.$row[1].'-'.$row[2].'<br/>';
		} 
	/* foreach($result as $key=>$value)
		{			
			echo $key.$value[1].'<br/>';
		} */

	return $list;
	
  }
  catch(PDOException $e){
	echo 'error'.$e->getMessage();
  }	
}
	
function insertUser($pdo ,$name, $nick, $passwd){
    try{
	$sql = 'INSERT INTO public.user(name,nick,passwd) VALUES(:name,:nick,:passwd)';
    $stmt = $pdo->prepare($sql);
    // pass values to the statement
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':nick', $nick);
    $stmt->bindValue(':passwd', $passwd);
    // execute the insert statement
    $stmt->execute();
    
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	// return generated id
    return $pdo->lastInsertId('user_id_seq');
}
function allUsers($pdo){
	$list = '';
	try{
	$sql = "SELECT * from public.user";
	foreach($pdo->query($sql) as $row)
		{
			//print"<br/>";
			//print $row['id'].'-'.$row['name'].'-'.$row['nick'].'<br/>';
			$list = $list.$row['id'].'-'.$row['name'].'-'.$row['nick'].'<br/>';
		}
	return $list;
	}
	catch(PDOException $e){
		echo 'error'.$e->getMessage();
	}
	
}


	
?>

