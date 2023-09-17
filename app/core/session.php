<?php
//https://www.php.net/manual/ru/session.configuration.php
// время жизни сессии
ini_set('session.gc_maxlifetime', 1800);
// время жизни куки
ini_set('session.cookie_lifetime', 1800);
/*
session.gc_divisor в сочетании с session.gc_probability определяет вероятность запуска функции сборщика мусора (gc, garbage collection) при каждой инициализации сессии. Вероятность рассчитывается как gc_probability/gc_divisor, то есть 1/100 означает, что функция gc запускается в одном случае из ста, или 1% при каждом запросе. session.gc_divisor по умолчанию имеет значение 100.
*/
ini_set('session.gc_divisor', 1);
session_name('token');

if (isset($_COOKIE['token'])) {
  session_start();
}