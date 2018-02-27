<style>
    .wrong {
        margin-top: 5px;
        margin: auto; /* Выравниваем по центру */
        padding: 5px;
        background-color: #F00;
        border: 2px solid #666;
        width: auto;
        color: #000000;
    }

    .wrong1 {
        margin-top: 125px;
        margin-bottom: 200px;
        margin: auto; /* Выравниваем по центру */

        padding: 15px;
        background-color: red;
        border: 8px solid yellow;
        width: 80%% auto;
        text-align: center;
        font-size: 150%;
        color: yellow;
    }

    .sts2 {
        color: #363030;
        margin: auto; /* Выравниваем по центру */
        text-shadow: #000 0px 1px 0px;
    }

    .my-rule {
        margin-top: 125px;
        margin-bottom: 200px;
        margin: auto; /* Выравниваем по центру */

        padding: 15px;
        background-color: red;
        border: 5px solid yellow;
        width: 80%% auto;
        text-align: center;
        font-size: 150%;
        color: yellow;

    }

    .conta1 {
        background-color: #559964;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -300px;
        margin-left: -430px;
        height: 600px;
        width: 860px;
    }

    .center {

        width: 650px; /* Ширина элемента в пикселах */
        padding: 50px; /* Поля вокруг текста */
        margin: auto; /* Выравниваем по центру */
        background: rgba(214, 214, 214, 0.96);
        text-align: center;
        vertical-align: center;
        margin-top: 50px;
        margin-bottom: 150px;
    }

    #centered {
        margin-left: auto;
        margin-right: auto;
        width: 6em /*margin:0 auto;
		width:400px;*/

        padding-top: 90px;
        padding-bottom: 90px;

        margin-top: 100px;

        display: table-cell;
        height: 100px;
        border: 5px solid yellow;
        text-align: center;
        vertical-align: middle;

    a.knopka {
        margin-top: 50px;
        margin-bottom: 200px;
        margin-left: auto;
        margin-right: auto;

        color: #fff; /* цвет текста */
        text-decoration: none; /* убирать подчёркивание у ссылок */
        user-select: none; /* убирать выделение текста */
        background: rgb(212, 75, 56); /* фон кнопки */
        align: center;
        padding: .7em 1.5em; /* отступ от текста */
        outline: none; /* убирать контур в Mozilla */
    }

    a.knopka:hover {
        background: rgb(232, 95, 76);
    }

    /* при наведении курсора мышки */
    a.knopka:active {
        background: rgb(152, 15, 0);
    }

    /* при нажатии */

    a.button7 {
        font-weight: 700;
        color: white;
        text-decoration: none;
        padding: .8em 1em calc(.8em + 3px);
        border-radius: 3px;
        background: rgb(64, 199, 129);
        box-shadow: 0 -3px rgb(53, 167, 110) inset;
        transition: 0.2s;
    }

    a.button7:hover {
        background: rgb(53, 167, 110);
    }

    a.button7:active {
        background: rgb(33, 147, 90);
        box-shadow: 0 3px rgb(33, 147, 90) inset;
    }


</style>

<?php
/**
 * Template Name: 2_GoT_emplate
 * Created by PhpStorm.
 * User: alsibir
 * Date: 27.01.2018
 * Time: 16:27
 */


get_header();


//***********************************************************************************

$num = $_POST['num']; // принимаем данные отправленные POST
$pas = $_POST['pas']; // login и pass - это name полей ввода


//запись параметров в файл
$f = fopen( "data/cn.tmp", "w" ); // открываем файл, если не существует, пытаемся создать его
fwrite( $f, $num ); // записываем в файл текст
fclose( $f ); // закрываем

$f = fopen( "data/ps.tmp", "w" ); // открываем файл, если не существует, пытаемся создать его
fwrite( $f, $pas ); // записываем в файл текст
fclose( $f ); // закрываем

//$numpas = $_POST['num'] . ";" . $_POST['pas']; //собрана строка для поиска

$filename = "data/6.csv";

$arr = file( $filename );

$temp = array( 'status', 'num', 'pas', 'nominal', 'adate', 'tdate', 'uemail', 'unote' );


$i = 0;

//закрыть прмой вход на страницу
if ( empty( $_POST['num'] ) ) {
	get_header();
	echo "<div class=center><h1>Error 403 forbidden...</h1><br>
          <b>Недостаточно прав для просмотра/редактирования запрашиваемой страницы</b><br><hr>
          <a href=http://luchikidobra.ru/go/ class=button'>Понятно.</a>
          <br><br><hr>
          </div>";


	//<a href=http://luchikidobra.ru/go/ class=button7>Понятно.</a>
//	echo "<a href=http://luchikidobra.ru/go/ class=button7>кнопка</a>";
//	echo "111111<br>";

	get_footer();
	exit();
}


foreach ( $arr as $line ) {
	// Разбиваем строку по разделителю ";"
	$data = explode( ";", $line );
	// В массив $temp читаем имена и пароли зарегистрированных посетителей
	//Card_Num;Pas;Status;Activation Date;Transfer Date;Transfer Number

	//файл 5.csv == Status;Num;Pas;aDate;tDate;uEmail;uNote
	$temp['status'][ $i ]  = $data[0]; //статус 0:чистая 1:запрос 2:выполнен
	$temp['num'][ $i ]     = $data[1]; //номер карты
	$temp['pas'][ $i ]     = $data[2]; //пароль
	$temp['nominal'][ $i ] = $data[3]; //номинал
	$temp['adate'][ $i ]   = $data[4]; //дата активации
	$temp['tdate'][ $i ]   = $data[5]; //дата перевода
	$temp['uemail'][ $i ]  = $data[6]; //email
	$temp['unote'][ $i ]   = trim( $data[7] ); //usernote
	// Увеличиваем счётчик
	$i ++;
}

//Если статус = 1 или 2 -

// Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта
if ( ! in_array( $num, $temp['num'] ) ) {
	get_header();
	echo "<div style=sts2><br><h1>Карта с указанным номером не зарегистрирована в базе<br></h1>";
	echo "<br><a href=\"http://luchikidobra.ru/go\">Нажмите здесь, чтобы попробовать еще раз.</a>";
	//header("Location: http://luchikidobra.ru/err_card/");
	get_footer();
	exit();
}

// Если пользователь с именем $_POST['name'] обнаружен проверяем правильность введённого пароля
$index = array_search( $num, $temp['num'] ); //номер элемента


//Записываем в файл номинал
$f = fopen( "data/nm.tmp", "w" ); // открываем файл, если не существует, пытаемся создать его
fwrite( $f, $nominal ); // записываем в файл текст
fclose( $f ); // закрываем


if ( $temp['status'][ $index ] == 1 ) {
	get_header();
	echo "Карта $num уде была активирована ранее.<br>Повторная активация невозможна!<br>Ничего не сделано.";
	echo "<a href=http://luchikidobra.ru/go/ class=knopka>Понятно.</a><br><br><br>";
	get_footer();
}

if ( $temp['status'][ $index ] == 1 ) {
	get_header();
	echo "Карта $num уде была активирована ранее.<br>Средства перечислены...<br>Повторная активация невозможна!<br>Ничего не сделано.";
	echo "<a href=http://luchikidobra.ru/go/ class=knopka>Понятно.</a><br><br><br>";
	get_footer();
}

if ( $pas != $temp['pas'][ $index ] ) {
	get_header();
	echo "<br><h1>Пароль не соответствует логину<br></h1>";
	echo "<br><a href=\"http://luchikidobra.ru/go\">Нажмите здесь, чтобы попробовать еще раз.</a>";
	get_footer();
	exit();


	//exit( "Пароль не соответствует логину" );
}

//echo "Эта пара логин-пароль была обнаружена в строке [" . $index . "], считая от 0<br>";
get_header();
echo "<br><h1>Проверка пройдена успешно,<br></h1>";
echo "<p>( совпадение в строке [$index], счёт строк в файле ведётся от [0] )</p>";
echo "<a href=\"http://luchikidobra.ru/go3\">Нажмите здесь, чтобы перечислить средства с карты в фонд.</a>";
get_footer();


?>

Copyryght (C) -- 2018г, ООО "Пальчики Бобра"


<?php get_footer(); ?>