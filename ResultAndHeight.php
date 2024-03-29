<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$error = 0;

$one = json_decode(file_get_contents('https://api.blockcypher.com/v1/eth/main'));
$two = json_decode(file_get_contents('https://api.etherscan.io/api?module=proxy&action=eth_blockNumber&apikey=YourApiKeyToken'));
$height = $one->height;
if ($two->result == 'Max rate limit reached, please use API Key for higher rate limit') {
    $error = 1;
} else {
    $result = hexdec($two->result);
}


if (!$error) {
    if ($height > $result) {
        $status = 3;
        $count = $height-$result;
        $text = 'Число Height: '.$height.' больше, нежели число Result: '.$result.'<br>Разница составляет: '.$count;
    } else if ($height < $result) {
        $status = 2;
        $count = $result-$height;
        $text = 'Число Result: '.$result.' больше, нежели число Height: '.$height.'<br>Разница составляет: '.$count;
    } else if ($height == $result) {
        $status = 1;
        $text = 'Числа равны и сравнению не подлежат!<br>Значение: '.$result;
    } else {
        $status = 0;
        $text = 'Ошибка в сравнении чисел!';
    }
} else {
    $text = 'Ошибка при получении чисел! Попробуйте не так часто обновлять страницу!';
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    Итоги сравнения:<br>
    <?= $text?>
</body>
</html>
