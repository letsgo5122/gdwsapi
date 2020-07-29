<?php
$dbuser = 'hqqgpftcopqrlp';
$dbpass = '836074106a0a802c47f8287a23f32c9c8f7f4aab9293990d4abc8607a1dbc49a';
$host = 'ec2-3-231-16-122.compute-1.amazonaws.com';
$dbname='d8hsb2dar6scno';
$port="5432";
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$dbuser;password=$dbpass;sslmode=require";
try{
	$pdo = new PDO($dsn);
	if($pdo){
		//echo "Connected to the $dbname database successfully!";
		;
	}
}catch (PDOException $e){
	// Show error message
	echo $e->getMessage();
}

//$sql = "DROP TABLE IF EXISTS public.user";
//$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS public.user(
id serial PRIMARY KEY,
name varchar(40) NOT NULL UNIQUE,
passwd varchar(40) NOT NULL,
nick varchar(40) NOT NULL UNIQUE
)";

$pdo->exec($sql);

?>