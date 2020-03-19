<?php

$prev = date('d/m/o', time() - (24 * 60 * 60)); //записываем в переменную вчерашнюю дату
$now = date('d/m/o');  //записываем в переменную сегодняшнюю дату
/* Выводим данные из ЦБ, переменные вставляем вместо дат */
$xml1 = simplexml_load_file('http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' . $prev . '&date_req2=' . $now . '&VAL_NM_RQ=R01235');
$xml2 = simplexml_load_file('http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' . $prev . '&date_req2=' . $now . '&VAL_NM_RQ=R01239');
$currancy = '';

/* Функция для обработки данных */
function rates($xml, $currancy) {
    foreach ($xml as $val) {   //перебираем итерируемый объект

        $ystrd = date('d.m.o', time() - (24 * 60 * 60));  //создаем переменные для дат в нужном формате
        $td = date('d.m.o');
        if ($val['Date'] == $ystrd) {
            $yesterday = $val->Value;  // и выводим значения
        }
        if ($val['Date'] == $td) {
            $today = $val->Value;
        }

    }

    echo $currancy . ' ' . $today;

    if(strcasecmp($yesterday, $today) > 0) {   //сравниваем полученные значения для вывода динамики кодировок
        echo ↓ . '<br>';
    } else {
        echo ↑ . '<br>';
    }
}

rates($xml1, 'USD');

rates($xml2, 'EUR');


?>

