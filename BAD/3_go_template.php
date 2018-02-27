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

    a.knopka {
        position: relative;

        top: 50px;
        bottom: 200px;
        left: auto;
        right: auto;

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

</style>


<?php
/**
 * Template Name: 3_GoT_emplate
 */
get_header();
?>

	<h1>Куда направиль Ваши деньги?</h1>
	<p>Ваша карта активирована. На ней обнаружено 1000 рублей.</p>
	<p>Кликните мышью наазвание фонда в который нужно перечислить эти деньги:</p>
	<form method="post">
        <input type="radio" name="voice" value="fond1" checked/> Фонд 1. <b>Подари жизнь</b> (Тяжелобольные дети)<br/>
        <input type="radio" name="voice" value="fond2"/> Фонд 2. <b>Линия жизни</b> (Тяжелобольные дети)<br/>
		<input type="radio" name="voice" value="fond3"/> Фонд 3. Вера (Хосписы, неизлечимо-больные дети)<br/><br/>
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
$nominal = trim( file_get_contents( 'data/nm.tmp' ) ); //Читаем всё содержимое файла в строку


$uemail = $_POST['uemail'];
$unote  = $_POST['unote'];

// echo "<hr><br>*************** num =" . $num . " pas=" . $pas . "***************<br>";
// echo "*************** uemail =" . $_POST['uemail'] . " unote=" . $_POST['unote'] . "***************<br><hr><br>";

$nominal='[В_ЭТОЙ_ВЕРСИИ_НЕ_ВЫВОДИТСЯ]';

$fondsel = '';

if ( isset( $_POST['voice'] ) ) {
	switch ( $_POST['voice'] ) {
		case 'fond1':
			$fondsel = "1.Подари жизнь (Тяжелобольные дети)";
			break;
		case 'fond2':
			$fondsel = "2.Линия жизни (Тяжелобольные дети)";
			break;
		case 'fond3':
			$fondsel = "3. Вера (Хосписы, неизлечимо-больные дети)";
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

	$message = " это Заказ с сайта luchikidobra.ru
                 Распоряжение 111 Благотворителя:
                 
                 =Благотворитель активировал карту\" . $num .  \"
                 =номинал карты $nominal руб следует 
                                - перечислить в \". $fondsel .\"
                 =подтвердить платеж на e-Mail:\". $uemail .\"
                 =Благотворитель оставил сообщение:\". $unote .\"
                 ";


	$headers  = "Content - type: text / html; charset = UTF - 8 \r\n";
	$headers .= "From: От кого письмо < admin@luchikidobra.ru > \r\n";
	$headers .= "Reply - To: hello@luchikidobra . ru\r\n";

	mail($to, $subject, $message, $headers);



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
	$filename = "data/6.csv";

	$arr = file( $filename );

	$temp = array( 'status', 'num', 'pas', 'nominal', 'adate', 'tdate', 'uemail', 'unote' );

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
		$temp['nominal'][ $i ]= $data[3]; //номинал
		$temp['adate'][ $i ]  = $data[4]; //дата активации
		$temp['tdate'][ $i ]  = $data[5]; //дата перевода
		$temp['uemail'][ $i ] = $data[6]; //email
		$temp['unote'][ $i ]  = trim( $data[7] ); //usernote
		// Увеличиваем счётчик
		$i ++;
	}

// Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта
	if ( ! in_array( $num, $temp['num'] ) ) {
		get_header();
		echo "<br><h1>\"Карта с номером $num не зарегистрирована в базе данных.<br></h1>";
		echo "<br><a class=knopka href=\"http://luchikidobra.ru/go\">OK!</a>";
		get_footer();
		die();
	}

// Если пользователь с именем $_POST['name'] обнаружен проверяем правильность введённого пароля
	$index = array_search( $num, $temp['num'] ); //номер элемента
	if ( $pas != $temp['pas'][ $index ] ) {
		get_header();
		echo "<br><h1>Пароль не соответствует логину.<br></h1>";
		echo "<br><a class=knopka href=\"http://luchikidobra.ru/go\">OK!</a>";
		get_footer();
		die();
	}



	get_header();
	echo "Эта пара логин-пароль была обнаружена<br>в строке [" . $index . "], считая от 0<br>";
	echo "<br><a class=knopka href=\"http://luchikidobra.ru/go3\">ПРОДОЛЖИТЬ</a>";
	get_footer();

	$adate = $temp['adate'][ $index ];
	$tdate = $temp['tdate'][ $index ]


//Проверка статуса 1 - "уже активирован"
	if ( $temp['status'][ $index ] == 1 ) {

		get_header();
		echo ( "<br><hr><h1><br>Карта $num уже БЫЛА активирована ранее.</h1><br> 
		       <li>Номинал карты:  $nominal руб.</li> 
		      <li>Дата активации в БД:  $adate</li>
		      <li>Дата компостера в БД: $tdate</li>
		      <li>Стартус В БД: $temp['status'][ $index </li>
		      <br><h1>НИЧЕГО НЕ СДЕЛАНО!<br>Программа завершена!!!!!</h1><br><br>
		      "<a class=knopka  href=\"http://luchikidobra.ru/go\">Нажмите здесь,
		                  для перехода на страницу ввода параметров карты.</a>" );
		<br>";
		get_footer();
	    die();
	    
		exit
	}


//Проверка статуса 2 - "оплачен"
	if ( $temp['status'][ $index ] == 2 ) {
		exit( "<br><hr><h3><br>Эта карта УЖЕ была ЗАКОМПОСТИРОВАНА ранее! </h3>" .
		      "<p>Это значит, что карта когда-то была полностью погашена, а ваши деньги были переданы в фонд.</p><br>" .
		      "<li>Номинал карты: " . $temp['nominal'][ $index ] . " руб.</li>" .
		      "<li>Дата активации в БД: " . $temp['adate'][ $index ] . "</li>" .
		      "<li>Дата компостера в БД: " . $temp['tdate'][ $index ] . "</li>" .
		      "<li>Стартус В БД: " . $temp['status'][ $index ] . "</li>" .
		      "<br><h1>НИЧЕГО НЕ СДЕЛАНО!<br>Программа завершена!!!!!</h1>" .
		      "</li><h2>Попробуйте закомпостировать другую карту!</h2>" .
		      "<a href=\"http://luchikidobra.ru/go\">Нажмите здесь, для перехода на страницу ввода параметров карты.</a>" );
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
		        $temp['nominal'][ $i ] . ";" .
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

<a href=\"http://luchikidobra.ru\">Нажмите здесь, для перехода на главную страницу.</a>";

}

?>

	Copyryght (C) -- 2018г, ООО "Пальчики Бобра"

<?php get_footer(); ?>