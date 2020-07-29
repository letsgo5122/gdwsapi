<?php
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];

if(empty($name) || empty($age) || empty($sex)){
    return 'post value is empty';
}

$str = '歡迎來到北京,'.$name;
$str .= '，你今年'.$age.'歲,真長壽';
$str .= ',你是個強壯的'.$sex;

echo $str;
?>