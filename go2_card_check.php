<style>
	.wrong {
		margin-top: 5px;
		padding: 5px;
		background-color: #F00;
		border: 2px solid #666;
		width: auto;
		color: #000000;
	}
</style>

<?php

/**
 * Created by PhpStorm.
 * User: alsibir
 * Date: 27.01.2018
 * Time: 16:27
 */

//***********************************************************************************

$num = $_POST['num']; // принимаем данные отправленные POST
$pas = $_POST['pas']; // login и pass - это name полей ввода


//запись параметров в файл
$f = fopen("data/cn.tmp", "w"); // открываем файл, если не существует, пытаемся создать его
fwrite($f, $num); // записываем в файл текст
fclose($f); // закрываем

$f = fopen("data/ps.tmp", "w"); // открываем файл, если не существует, пытаемся создать его
fwrite($f, $pas); // записываем в файл текст
fclose($f); // закрываем

//$numpas = $_POST['num'] . ";" . $_POST['pas']; //собрана строка для поиска

$filename = "data/5.csv";

$arr = file( $filename );

$temp = array( 'status', 'num', 'pas', 'adate', 'tdate', 'uemail', 'unote' );



$i = 0;

if ( empty( $_POST['num'] ) ) {
	exit( "<h1>Error 403 forbidden...</h1> 
    <h4>Недостаточно прав для просмотра/редактирования запрашиваемой страницы</h4>" );  //для прмого входа на страницу
}


foreach ( $arr as $line ) {
	// Разбиваем строку по разделителю ";"
	$data = explode( ";", $line );
	// В массив $temp читаем имена и пароли зарегистрированных посетителей
	//Card_Num;Pas;Status;Activation Date;Transfer Date;Transfer Number

	//файл 5.csv == Status;Num;Pas;aDate;tDate;uEmail;uNote
	$temp['status'][ $i ] = $data[0]; //статус 0:чистая 1:запрос 2:выполнен
	$temp['num'][ $i ]    = $data[1]; //номер карты
	$temp['pas'][ $i ]    = $data[2]; //пароль
	$temp['adate'][ $i ]  = $data[3]; //дата активации
	$temp['tdate'][ $i ]  = $data[4]; //дата перевода
	$temp['uemail'][ $i ] = $data[5]; //email
	$temp['unote'][ $i ]  = trim( $data[6] ); //usernote
	// Увеличиваем счётчик
	$i ++;
}

//Если статус = 1 или 2 -

// Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта
if ( ! in_array( $num, $temp['num'] ) ) {
	exit( "<h1>Карта с указанным номером не зарегистрирована в базе</h1><br><a href=\"go1_card_input.php\">Нажмите здесь, чтобы попробовать еще раз.</a>" );
}

// Если пользователь с именем $_POST['name'] обнаружен проверяем правильность введённого пароля
$index = array_search( $num, $temp['num'] ); //номер элемента
if ( $pas != $temp['pas'][ $index ] ) {
	exit( "Пароль не соответствует логину" );
}

//echo "Эта пара логин-пароль была обнаружена в строке [" . $index . "], считая от 0<br>";
echo "<br><h1>Проверка пройдена успешно,<br></h1>
<p>( совпадение в строке [$index], счёт строк в файле ведётся от [0] )</p>
<a href=\"go3_fond_case.php\">Нажмите здесь, чтобы перечислить средства с карты в фонд.</a>";




////Проверка статуса 0 - "не активирован"
//if ( $temp['status'][ $index ] == 0 ) {
//	exit( "<br>Карта еще НЕ была активирована.
//           <br>Сначала активируйте карту на странице go, отправьте деньги
//                и затем погасите карту компостером!<br><h1>Программа завершена!</h1>" );
//}
//
//
////Проверка статуса 2 - "оплачен"
//if ( $temp['status'][ $index ] == 2 ) {
//	exit( "<br><h1>Эта карта УЖЕ была закомпостирована ранее! </h1><br>
//               <li>Отметка об активации: " . $temp['adate'][ $index ] . "</li>
//	           <li>Отметка от компостера: " . $temp['tdate'][ $index ]
//	      . "</li><h1>Попробуйте закомпостировать другую карту!</h1>" );
//}
//
//
//echo " статус позволяет продолжить. Статус = [" . $temp['status'][ $index ] . "]";
//
////$_POST['num'] = trim($_POST['num']);
////$_POST['pas'] = trim($_POST['pas']);
//$_POST['usernote'] = trim( $_POST['usernote'] );
//

//if(empty($_POST['num'])) exit();
//if ( empty( $_POST['num'] ) ) {
//	exit( 'Поле "Имя" не заполнено' );
//}
//if ( empty( $_POST['pas'] ) ) {
//	exit( 'Поле "Пароль" не заполнено' );
//}
////if(empty($_POST['usernote'])) exit('Введите комментарий');
//
//
////вносим изменения в файл в карту num = $index
//$temp['status'][ $index ] = 2; //статус 0:чистая карта, 1:запрос на перевод, 2:запрос выполнен
////$temp['num'][$index]   = -$temp['num'][$index]; //номер карты
////$temp['pas'][$i]   = $data[1]; //пароль
////$temp['adate'][ $index ] = date("m.d.y"); //дата активации это системная дата
//$temp['tdate'][ $index ] = date( "m.d.y" ); //дата перевода средств (системная)
////$temp['uemail'][$index] = 'ххх@ххх.хх'; //email
////$temp['unote'][$index]  = 'хвалебный текст от юзера';
//
//
//echo "<h1>Закомпостировано!</h1>";
//echo '<h2>Дамп базы данных:</h2>';
////Запись массива в файл
//$f = fopen( $filename, 'w' );  //$fail = fopen($filename,"a");
////в цикле считываем данные из массива и пишем их на экран и в файл
//for ( $i = 0; $i < 10; $i ++ ) {
//	//отправляем на экран
//	echo $temp['status'][ $i ] . ";" .
//	     $temp['num'][ $i ] . ";" .
//	     $temp['pas'][ $i ] . ";" .
//	     $temp['adate'][ $i ] . ";" .
//	     $temp['tdate'][ $i ] . ";" .
//	     $temp['uemail'][ $i ] . ";" .
//	     $temp['unote'][ $i ] . "<br>";
//	//отправляем в файл
//	$line = $temp['status'][ $i ] . ";" .
//	        $temp['num'][ $i ] . ";" .
//	        $temp['pas'][ $i ] . ";" .
//	        $temp['adate'][ $i ] . ";" .
//	        $temp['tdate'][ $i ] . ";" .
//	        $temp['uemail'][ $i ] . ";" .
//	        $temp['unote'][ $i ];
//	fputs( $f, $line . "\n" );
//}
//
////закраваем соединение с файлом
//fclose( $f );

//***********************************************************************************

////session_start();
//$num = $_POST['num']; // принимаем данные отправленные POST
//$pas = $_POST['pas']; // login и pass - это name полей ввода
//$numpas = $_POST['num'] . ";" . $_POST['pas']; //собрана строка для поиска
////$_SESSION["numpas"] = $numpas;  //Передаём данные из сессии
//
//if ($numpas === ";") {echo "<h1>Error 403 forbidden...</h1>
//    <h4>Недостаточно прав для просмотра/редактирования запрашиваемой страницы</h4>";} //для прмого входа на страницу
//
////Записываю данные в файл
////$filename = "card.tmp";
////$fail = fopen($filename,"a");
////$text = $_POST['numpas']."\r\n";
//
////запись параметров карты в файл
//$fail = fopen("carddata.tmp", "w"); // открываем файл, если не существует, пытаемся создать его
//fwrite($fail, $numpas); // записываем в файл текст
//fclose($fail); // закрываем
//
////открытие файла и чтение его в строку
//$contents = '';
//$r = fopen("44.csv", "r");
//if ( $r ) {
//	while ( !feof($r) ) {
//		$contents.= fread($r, 8192);
//	}
//	fclose($r);
//}
//
////echo $contents;  //распечатка файла из буфера
//
//$pos = strpos($contents, $numpas);
//
//if ($_POST["num"] != 0) {
//// используется ===.  Использование == не даст верного результата, так как 'a' в нулевой позиции.
//	if ( $pos === false ) {
////	echo "Строка '$numpas' не найдена в строке '$contents'";
//		echo "В БАЗЕ ДАННЫХ ОТСУТСТВУЕТ КАРТА С УКАЗАННЫМ НОМЕРОМ ИЛИ ПАРОЛЕМ";
//		echo "<br><a href=\"1_card_input.php\">Нажмите, чтобы ввести данные еще раз --></a>";
//	} else {
////	echo "Строка '$numpas' найдена в строке '$contents'";
//		//echo " - обнаружена в позиции $pos";
//



//		echo "<br><h1>Проверка пройдена! Совпадение в позиции $pos<br></h1>
//<a href=\"3_fond_case.php\">Нажмите, чтобы выбрать благополучателя --></a>";
//
//	}
//}

?>









