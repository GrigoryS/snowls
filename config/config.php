<?php
/*
 Разработчик - Grigory Smirnov. Пишите на grigory_dev@yahoo.com
 2013. С новым Годом вас!


 Developer is Grigory Smirnov. Write to grigory_dev@yahoo.com or grigory_smirnov@mail.ru
 2013. Happy New Year!
*/ 


$config = array();
$config['count'] = 35; // общее количество снежинок
$config['letter'] = '*'; // значок снежинки; можно поставить даже знак доллара ($) :)
$config['speed'] = 1; // скокрость падения снега, обращайтесь осторожно
$config['font'] = 'Times';    // шрифт для снежинок
$config['maxsize'] = 5; //максимальный размер снежинки
$config['minsize'] = 1; //минимальный размер снежинки
$config['zone'] = 1; //1-снежинки на весь экран, 2-снежинки слева, 3-снежинки по центру, 4-снежинки справа
return $config;
?>
