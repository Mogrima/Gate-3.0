<?php
//----Перехват и обработка ошибок PHP----
function errors_handler($errno, $errstr, $errfile, $errline){ //Пользовательская функция обработчика ошибок PHP
$errors = array( //Формирования массива констант ошибок
E_WARNING => 'E_WARNING',
E_NOTICE => 'E_NOTICE',
E_CORE_WARNING => 'E_CORE_WARNING',
E_COMPILE_WARNING => 'E_COMPILE_WARNING',
E_USER_ERROR => 'E_USER_ERROR',
E_USER_WARNING => 'E_USER_WARNING',
E_USER_NOTICE => 'E_USER_NOTICE',
E_STRICT => 'E_STRICT',
E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
E_DEPRECATED => 'E_DEPRECATED',
E_USER_DEPRECATED => 'E_USER_DEPRECATED'
);
$date = date ("Y-m-d G:i:s"); //Получение даты и времени возникновения ошибки
$url = $_SERVER['REQUEST_URI']; //Получение URL страницы, при формировании которой произошла ошибка
$error_message = "$date $errors[$errno] $errstr в файле $errfile в $errline строке (URL: $url)\n"; //Сформированное сообщение об ошибке
$max_message = 100; //Максимальное количество сообщений в лог-файле
$filename = 'logs/warning_php.txt'; //Имя файла с директорией
if (file_exists($filename)) { //Если файл существует
$file_data = file($filename); //Считываем данные из файла в массив
if (count($file_data) >= $max_message){ //Если количество элементов в массиве достигает максимального значения
unset($file_data[0]); //Удаляем первый по списку элемент массива
$clean_data = implode("", $file_data); //Преобразуем данные массива в строку
file_put_contents($filename, $clean_data, LOCK_EX); //Записываем преобразованные данные с удаленным сообщением обратно в файл
}
}
file_put_contents($filename, $error_message, FILE_APPEND | LOCK_EX); //Добавляем сообщение об ошибке в лог-файл (в конец файла). Если файла не существует, будет создан
}
set_error_handler('errors_handler'); //Регистрация пользовательской функции
?>