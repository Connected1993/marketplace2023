<?php
declare(strict_types=1);
// __DIR__ - содержит путь к текущей папки этого файла
// файл в который будут записываться ошибки
ini_set('error_log', __DIR__ . '/' . date('Y-m-d') . '-error.log');
// включаем логирование всех ошибок
//https://snipp.ru/php/php-errors
error_reporting(E_ALL);
// отключаем вывод ошибок на экран для того, чтобы они записывались в журнал
ini_set('display_errors','0');