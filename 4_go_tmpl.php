<?php
/**
 * Template Name: 4_Go_TMPL
 */


//*******************************************************APS
function WritePar2file( $filename, $parameter ) {   //запись параметров в файл
	$f = fopen( "data/" . $filename, "w" ); // открываем файл, если не существует, пытаемся создать его
	fwrite( $f, $parameter ); // записываем в файл текст
	fclose( $f ); // закрываем

	return;
}

function OutMessagePg( $errmsg, $errcomment, $goto ) {
	echo "<div style='margin: 60px 40px 150px 0; padding: 50px 20px 50px 20px; background: #d6d6d6; border: #888888 4px solid; text-align: center;'>
          <br><h2>$errmsg</h2><br><h3>$errcomment<br><br></h3><b>$goto</b></div>";

	return;

}

// style='margin-left: 5%; width: 90%;  background: #d6d6d6; border: 4px solid; margin-left: auto;  margin-right: auto;
//width: 6em; height: 450px; vertical-align: middle;  width: 50%;
//vertical-align: middle; margin-left: auto;   margin-right: auto; margin-top: auto; margin-bottom: auto;


function CloseDirectPgEntre() {     //закрыть прмой вход на страницу
	if ( empty( $_POST['num'] ) ) {

		OutMessagePg( "Error 403 forbidden...",
			"Недостаточно прав для просмотра/редактирования запрашиваемой страницы.",
			"<a href=http://luchikidobra.ru/go/ class=button>ОК!</a>" );

		$GLOBALS['pflag'] = "1";

		return;

	}
}


function SendMeMail( $subject, $message ) {
	//формируем почтовое сообщение
	// ----------------------------конфигурация-------------------------- //

//	$adminemail = "admin@luchikidobra.ru";  // e-mail админа
//	$date       = date( "d.m.y" ); // число.месяц.год
//	$time       = date( "H:i" ); // часы:минуты:секунды
//	$backurl    = "http://luchikidobra.ru/go";  // На какую страничку переходит после отправки письма

	$to = "<admin@luchikidobra.ru>";

	///			$subject = "Заказ активировать карту . $num (luchikidobra.ru)";

	///			$message = "Заказ с сайта luchikidobra.ru :: Распоряжение Благотворителя:

	///    1. активировть карту №. $num  (номинал $nominal руб.)
	///    2. деньги перечислить в  $fondsel
	///    3. подтвердить платеж на e-Mail: $uemail

	///    ";


	$headers = " ";
//	$headers = "Content - type: text / html; charset = UTF - 8 \r\n";
//	$headers .= "Письмо для: < admin@luchikidobra.ru > \r\n";
//	$headers .= "Адрес для ответа: < hello@luchikidobra.ru > \r\n";

	mail( $to, $subject, $message, $headers );
}

//*******************************************************APS11111


if ( ! defined( 'ABSPATH' ) ) {
	die();
}

global $avia_config;


/*
 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
 */
get_header();


if ( get_post_meta( get_the_ID(), 'header', true ) != 'no' ) {
	echo avia_title();
}

do_action( 'ava_after_main_title' );
?>

<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

    <div class='container'>

        <main class='template-page content  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper( array(
			'context'   => 'content',
			'post_type' => 'page'
		) ); ?>>

			<?php
			/* Run the loop to output the posts.
			* If you want to overload this in a child theme then include a file
			* called loop-page.php and that will be used instead.
			*/

			$avia_config['size'] = avia_layout_class( 'main', false ) == 'fullsize' ? 'entry_without_sidebar' : 'entry_with_sidebar';
			get_template_part( 'includes/loop', 'page' );
			?>

            <!--<h2>Запись в HTML в контейнере main</h2>-->
            <!--end content-->


			<?php ///APS4 *********************************************
			///
			///
			///
			$pflag    = 0; //флаг для подавления ненужных сообщений
			$fondsel  = '';
			$filename = "data/7.csv";


			//чтение параметров карты из файла
			$num     = trim( file_get_contents( 'data/cn.tmp' ) ); //Читаем всё содержимое файла в строку
			$pas     = trim( file_get_contents( 'data/ps.tmp' ) ); //Читаем всё содержимое файла в строку
			$nominal = trim( file_get_contents( 'data/nm.tmp' ) ); //Читаем всё содержимое файла в строку


			$uemail = $_POST['uemail'];
			//	$unote  = $_POST['unote'];

			//для почтовой подпрограммы
			$adminemail = "admin@luchikidobra.ru";  // e-mail админа
			$date       = date( "d.m.y" ); // число.месяц.год
			$time       = date( "H:i" ); // часы:минуты:секунды
			//	$backurl    = "http://luchikidobra.ru/go";  // На какую страничку переходит после отправки письма

			//		echo "<hr>num= $num *** pas= $pas *** nominal=$nominal руб *** pflag=$pflag<br>uemail=$uemail <hr>";

			///		CloseDirectPgEntre(); //закрываем пустой вход


			if ( isset( $_POST['voice'] ) ) {
				switch ( $_POST['voice'] ) {
					case 'fond1':
						$fondsel = "1.Подари_жизнь";
						break;
					case 'fond2':
						$fondsel = "2.Линия_жизни";
						break;
					case 'fond3':
						$fondsel = "3.Вера";
						break;
					case 'fond4':
						$fondsel = "4.AdVita";
						break;
					case 'fond5':
						$fondsel = "5.Старость в радость";
						break;
					case 'fond6':
						$fondsel = "6.Милосердие";
						break;
				}


				$arr = file( $filename );

				$temp = array( 'status', 'num', 'pas', 'nominal', 'adate', 'tdate', 'uemail' );

				$i = 0;

				foreach ( $arr as $line ) {

					$data = explode( ";", $line ); // Разбиваем строку по разделителю ";"

					// В массив $temp читаем имена и пароли зарегистрированных посетителей
					//Card_Num;Pas;Status;Activation Date;Transfer Date;Transfer Number

					//файл 5.csv == Status;Num;Pas;aDate;tDate;uEmail;uNote
					$temp['status'][ $i ]  = $data[0]; //статус 0:чистая 1:запрос 2:выполнен
					$temp['num'][ $i ]     = $data[1]; //номер карты
					$temp['pas'][ $i ]     = $data[2]; //пароль
					$temp['nominal'][ $i ] = $data[3]; //номинал
					$temp['adate'][ $i ]   = $data[4]; //дата активации
					$temp['tdate'][ $i ]   = $data[5]; //дата перевода
					$temp['uemail'][ $i ]  = trim( $data[6] ); //email
					//	$temp['unote'][ $i ]   = trim( $data[7] ); //usernote
					// Увеличиваем счётчик
					$i ++;
				}


				//$nominal = $temp['nominal'][ $index ];


				// Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта

				if ( ! in_array( $num, $temp['num'] ) and $pflag == 0 ) {

					OutMessagePg( "Ошибка номера карты", "Введен неверный номер карты № $num.",
						"<a href='http://luchikidobra.ru/go'  class=button>ОК!</a>" );
					SendMeMail( "Ошибка номера карты",
						"luchikidobra :: введен неверный номер карты $num :: отказ в авторизации." );

					$pflag = 1;

				}


				// Если пользователь с именем $_POST['name'] обнаружен, проверяем правильность введённого пароля

				$index = array_search( $num, $temp['num'] ); //номер элемента


				if ( $pas != $temp['pas'][ $index ] and $pflag == 0 ) {

					OutMessagePg( "Ошибка пароля карты", "Введен неверный пароль карты № $num . ",
						" < a href = 'http://luchikidobra.ru/go'  class=button > ОК!</a > " );
					SendMeMail( "Ошибка пароля карты",
						"luchikidobra :: введен неверный пароль карты $num ." );

					$pflag = 1;

				}


				//Проверка статуса 1 - "уже активирован"

				if ( $temp['status'][ $index ] == 1 and $pflag == 0 ) {

					OutMessagePg( "Карта $num была активирована ранее. ",
						"Введите данные другой карты.",
						"<a href = 'http://luchikidobra.ru/go'  class=button > ОК!</a > " );

					SendMeMail( "Ошибка :: Повторная активация карты со статусом 1 № $num  ( luchikidobra . ru )",
						"Ошибка :: Введен верный логин и пароль для карты со статусом 1  карта № $num ( luchikidobra . ru ) " );

					$pflag = 1;

				}


				//Проверка статуса 2 - "уже оплачен"

				if ( $temp['status'][ $index ] == 2 and $pflag == 0 ) {

					OutMessagePg( "Карта $num была активирована ранее, средства были перечислены в фонд.",
						"Введите данные другой карты.",
						"<a href = 'http://luchikidobra.ru/go'  class=button > ОК!</a > " );

					SendMeMail( "Ошибка :: Повторная активация карты со статусом 2 № $num  ( luchikidobra . ru )",
						"Ошибка :: Введен верный логин и пароль для карты со статусом 2 карта №$num ( luchikidobra . ru )" );

					$pflag = 1;
				}


				$adate  = $temp['adate'][ $index ];
				$tdate  = $temp['tdate'][ $index ];
				$status = $temp['status'][ $index ];


				//	echo " статус=0 позволяет продолжить. Статус = [" . $temp['status'][ $index ] . "]<br>//";

				//$_POST['num'] = trim($_POST['num']);
				//$_POST['pas'] = trim($_POST['pas']);
				//$_POST['usernote'] = trim( $_POST['usernote'] );


				//вносим изменения в файл БД в карту num = $index
				$temp['status'][ $index ] = 1; //меняем 0на1 - статус 0:чистая карта, 1:запрос на перевод, 2:запрос выполнен
				//$temp['num'][$index]   = -$temp['num'][$index]; //номер карты
				//$temp['pas'][$i]   = $data[1]; //пароль
				$temp['adate'][ $index ] = date( "m.d.y" ); //дата активации это системная дата
				//$temp['tdate'][ $index ] = date( "m.d.y" ); //дата перевода средств (системная)
				$temp['uemail'][ $index ] = trim( $_POST['uemail'] ); //email пользователя
				//	$temp['unote'][ $index ]  = trim( $_POST['unote'] ); //сообщение пользователя


				//Запись массива в файл и на экран
				$f = fopen( $filename, 'w' );  //$fail = fopen($filename,"a");
				//в цикле считываем данные из массива и пишем их на экран и в файл


				//119
				//Сосчитаем число строк в файле
				//$cnt = count( file( "data/7.csv" ) );
				///$lineCount = count( file( $filename ) );
				///
				//echo "<br>число строк в файле $cnt<br>";


				//$bloggood = file( $filename );
				//$cnt = count( $bloggood );
                $cnt = 110;
				//echo "<br>Количество строк в файле: " . $cnt . "<br>";


				for ( $i = 0; $i < ( $cnt ); $i ++ ) {
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
					        $temp['uemail'][ $i ];
					//	        $temp['unote'][ $i ];//
					fputs( $f, $line . "\n" );
				}

				fclose( $f ); //закрыть соединение с файлом

			}


			if ( $pflag == 0 ) {

				$pflag = 1;

				SendMeMail( "Активировать карту $num :: luchikidobra.ru",
					"Распоряжение Благотворителя luchikidobra.ru.

            1. Активировть карту № $num (номинал $nominal руб.)
            2. Деньги перечислить в  $fondsel 
            3. Подтвердить платеж по eMail: $uemail 
                " );

				OutMessagePg( "Ваше распоряжение об активации карты успешно отправлено.",
					"<br>Пожалуйста, помогите нам стать лучше, - пройдите опрос, он займет не более 3 минут, но очень нам поможет.",
					"<a href='https://docs.google.com/forms/d/e/1FAIpQLScpmOgrnUYGbTjPXpVxR7GvyMCvCUjyFi3XiNqHAHcolGLzyA/viewform' class=button>Пройти опрос.</a>" );

			}
			///APS4 *********************************************
			?>


        </main>

		<?php
		//echo "<p>В сайдбаре может размещаться полезный текст...</p>";

		//get the sidebar
		$avia_config['currently_viewing'] = 'page';
		get_sidebar();

		?>

    </div><!--end container-->

</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>

