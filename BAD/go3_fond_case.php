<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Выбор фонда для направления средств</title>
</head>

<body>
<h1>Куда направиль Ваши деньги?</h1>
<p>Ваша карта активирована. На ней обнаружено 1000 рублей.</p>
<p>Кликните мышью наазвание фонда в который нужно перечислить эти деньги:</p>
<form method="post">
    <input type="radio" name="voice" value="fond1" checked/> Фонд 1<br/>
    <input type="radio" name="voice" value="fond2"/> Фонд 2<br/>
    <input type="radio" name="voice" value="fond3"/> Фонд 3<br/><br/>
    <p>Укажите E-mail, если хотите получить платежку (необязательно): </p>
    <p><input type="text" name="uemail"></p>
    <p>Если желаете нам что то сообщить: </p>
    <p><textarea rows="5" cols="45" name="unote"></textarea><br><br></p>
    <input type="submit" value="Отправить лучик доброты!"/><br><br>
</form>

<?php
/**
 * Created by PhpStorm.
 * User: alsibir
 * Date: 27.01.2018
 * Time: 20:30
 */

//чтение параметров карты из файла


$num = trim( file_get_contents( 'data/cn.tmp' ) ); //Читаем всё содержимое файла в строку
$pas = trim( file_get_contents( 'data/ps.tmp' ) ); //Читаем всё содержимое файла в строку


$uemail = $_POST['uemail'];
$unote  = $_POST['unote'];

echo "<hr><br>*************** num =" . $num . " pas=" . $pas . "***************<br>";
echo "*************** uemail =" . $_POST['uemail'] . " unote=" . $_POST['unote'] . "***************<br><hr><br>";

$fondsel = '';

if ( isset( $_POST['voice'] ) ) {
	switch ( $_POST['voice'] ) {
		case 'fond1':
			$fondsel = "фонд1111";
			break;
		case 'fond2':
			$fondsel = "фонд2222";
			break;
		case 'fond3':
			$fondsel = "фонд3333";
			break;
	}

	echo '<hr><br>********Вы выбрали*****==' . $fondsel . "приступаем к активации карты " . $num . "<br>";


// ----------------------------конфигурация-------------------------- //

	$adminemail = "admin@luchikidobra.ru";  // e-mail админа

	$date = date( "d.m.y" ); // число.месяц.год

	$time = date( "H:i" ); // часы:минуты:секунды

	$backurl = "1_card_input.php";  // На какую страничку переходит после отправки письма


	$to = "<admin@luchikidobra.ru>";
//	$to .= "mail2@example.com>";

	$subject = "это Заказ с сайта luchikidobra.ru :: активировать карту" . $num;

	$message = " <p>это Заказ с сайта luchikidobra.ru</p> <br>
                 <h1>Распоряжение 111 Благотворителя: </h1> <br>
                 <ul>
                 <li> =Благотворитель активировал карту\" . $num .  \"</li> <br><br>
                 <li>=сумму 1000р следует перечислить  в \". $fondsel .\"</li> <br><br>
                 <li> =подтвердить платеж на e-Mail:\". $uemail .\"</li> <br><br>
                 <li>=Благотворитель оставил сообщение:\". $unote .\" </li> <br>
                 </ul>";


	$headers  = "Content - type: text / html; charset = UTF - 8 \r\n";
	$headers .= "From: От кого письмо < admin@luchikidobra . ru > \r\n";
	$headers .= "Reply - To: hello@luchikidobra . ru\r\n";

	mail($to, $subject, $message, $headers);

	 //function mail_utf8 ($to, $subject = '(No subject)', $message = '', $from)
	 //{ $header = 'MIME-Version: 1.0' . "\n" . 'Content-type: text/plain; charset=UTF-8' . "\n" .
	 //'From: Yourname <' . $from . " > \n"; mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=',
	 //$message, $header); } mail_utf8('xxx@xxx.xx','Тема','Сообщение','Заголовок');
	 // Функция отправляет utf-8, но, конечно, нужно допилить для ваших целей.


//---------------------------------------------------------------------- //


// Принимаем данные с формы
//	$email = $_POST['uemail'];
//	$msg = $_POST['unote'];

//
//// Проверяем валидность e-mail
//
//	if ( ! preg_match( " |^( [ a - z0 - 9_\.\-]{
//		1,20})@( [ a - z0 - 9\.\-]{
//		1,20})\.( [ a - z ]{2,4})|is",
//		strtolower( $email ) ) ) {
//
//		echo
//		" < b>Вернитесь </b > <a
//href='javascript:history.back(1)'><B>назад</B></a>. Вы
//указали неверные данные в адресе почты!";
//
//	} else {
//






//	$msg = "
//  =сумму 1000р следует перечислить  в $fondsel
//  =подтвердить платеж на e-Mail: $uemail ]
//  =Благотворитель оставил сообщение: $unote";
//
//
//	// Отправляем письмо админу
//
//	//mail( "$adminemail", "$date $time Сообщение от $name", "$msg" );
//
//
//	if ( mail( "$adminemail","Заказ с сайта luchikidobra.ru :: активировать карту",
//		"карта № " . $num . " E-mail Клиента: " . $uemail . "  From: help@luchikidobra.ru \r\n" . $msg ) ) {
//		echo "<br><br>******сообщение успешно отправлено на адрес: " . $adminemail . "<br>";
//	} else {
//		echo "<br><br>******возникли ошибки при отправке на адрес: " . $adminemail . "<br>";
//	}
//




//}







// Сохраняем в базу данных

//$f = fopen("message.txt", "a+");
//
//fwrite($f," \n $date $time Сообщение от $name");
//
//fwrite($f,"\n $msg ");
//
//fwrite($f,"\n ---------------");
//
//fclose($f);


// Изменяем данные в БД - status = 1, adata = сегодня, вписать uemail и unote
	$filename = "data/5.csv";

	$arr = file( $filename );

	$temp = array( 'status', 'num', 'pas', 'adate', 'tdate', 'uemail', 'unote' );

	$i = 0;

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

// Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта
	if ( ! in_array( $num, $temp['num'] ) ) {
		exit( "Карта с указанным номером не зарегистрирована в базе" );
	}

// Если пользователь с именем $_POST['name'] обнаружен проверяем правильность введённого пароля
	$index = array_search( $num, $temp['num'] ); //номер элемента
	if ( $pas != $temp['pas'][ $index ] ) {
		exit( "Пароль не соответствует логину" );
	}

	echo "Эта пара логин-пароль была обнаружена в строке [" . $index . "], считая от 0<br>";


//Проверка статуса 1 - "уже активирован"
	if ( $temp['status'][ $index ] == 1 ) {
		exit( "<br><hr><h1><br>Карта УЖЕ БЫЛА активирована ранее.</h1><br>" .
		      "<li>Дата активации в БД: " . $temp['adate'][ $index ] . "</li>" .
		      "<li>Дата компостера в БД: " . $temp['tdate'][ $index ] . "</li>" .
		      "<li>Стартус В БД: " . $temp['status'][ $index ] . "</li>" .
		      "<br><h1>НИЧЕГО НЕ СДЕЛАНО!<br>Программа завершена!!!!!</h1>" .
		      "<a href=\"go1_card_input.php\">Нажмите здесь, для перехода на страницу ввода параметров карты.</a>" );
	}


//Проверка статуса 2 - "оплачен"
	if ( $temp['status'][ $index ] == 2 ) {
		exit( "<br><hr><h3><br>Эта карта УЖЕ была ЗАКОМПОСТИРОВАНА ранее! </h3>" .
		      "<p>Это значит, что карта когда-то была полностью погашена, а ваши деньги были переданы в фонд.</p><br>" .
		      "<li>Дата активации в БД: " . $temp['adate'][ $index ] . "</li>" .
		      "<li>Дата компостера в БД: " . $temp['tdate'][ $index ] . "</li>" .
		      "<li>Стартус В БД: " . $temp['status'][ $index ] . "</li>" .
		      "<br><h1>НИЧЕГО НЕ СДЕЛАНО!<br>Программа завершена!!!!!</h1>" .
		      "</li><h2>Попробуйте закомпостировать другую карту!</h2>" .
		      "<a href=\"go1_card_input.php\">Нажмите здесь, для перехода на страницу ввода параметров карты.</a>" );
	}

	echo " статус=0 позволяет продолжить. Статус = [" . $temp['status'][ $index ] . "]<br>//";

//$_POST['num'] = trim($_POST['num']);
//$_POST['pas'] = trim($_POST['pas']);
	//$_POST['usernote'] = trim( $_POST['usernote'] );

//вносим изменения в файл в карту num = $index
	$temp['status'][ $index ] = 1; //меняем 0на1 - статус 0:чистая карта, 1:запрос на перевод, 2:запрос выполнен
//$temp['num'][$index]   = -$temp['num'][$index]; //номер карты
//$temp['pas'][$i]   = $data[1]; //пароль
	$temp['adate'][ $index ] = date( "m.d.y" ); //дата активации это системная дата
//$temp['tdate'][ $index ] = date( "m.d.y" ); //дата перевода средств (системная)
	$temp['uemail'][ $index ] = trim( $_POST['uemail'] ); //email пользователя
	$temp['unote'][ $index ]  = trim( $_POST['unote'] ); //сообщение пользователя


//Запись массива в файл и на экран
	$f = fopen( $filename, 'w' );  //$fail = fopen($filename,"a");
//в цикле считываем данные из массива и пишем их на экран и в файл
	for ( $i = 0; $i < 119; $i ++ ) {
		//отправляем на экран
//		echo $temp['status'][ $i ] . ";" .
//		     $temp['num'][ $i ] . ";" .
//		     $temp['pas'][ $i ] . ";" .
//		     $temp['adate'][ $i ] . ";" .
//		     $temp['tdate'][ $i ] . ";" .
//		     $temp['uemail'][ $i ] . ";" .
//		     $temp['unote'][ $i ] . "<br>";
		//отправляем в файл
		$line = $temp['status'][ $i ] . ";" .
		        $temp['num'][ $i ] . ";" .
		        $temp['pas'][ $i ] . ";" .
		        $temp['adate'][ $i ] . ";" .
		        $temp['tdate'][ $i ] . ";" .
		        $temp['uemail'][ $i ] . ";" .
		        $temp['unote'][ $i ];//
		fputs( $f, $line . "\n" );
	}

//закраваем соединение с файлом
	fclose( $f );
	echo "<h1>Изменения в базу внесены!</h1><br/><h2>Для просмотра Дампа базы используйте метод, указанный <br/>
              в карточке 'Тестирование бета-версии программы go'</h2>";
	echo "<br><h1>Ваше распоряжение об активации карты успешно передано<br></h1>

<a href=\"index.php\">Нажмите здесь, для перехода на главную страницу.</a>";

}

?>