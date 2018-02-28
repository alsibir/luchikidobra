<?php
/**
 * Template Name: 2_Go_TMPL
 * Created by PhpStorm.
 * User: alsibir
 * Date: 27.01.2018
 * Time: 16:27
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

// style='margin-left: 5%; width: 90%; margin-left: auto; margin-right: auto;
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


			<?php
			//echo "<h2>Запись на PHPв контейнере main</h2>";


			// принимаем и сохраняем в файлы данные отправленные POST login и pass - это name полей ввода

			$pflag = 0; //флаг для подавления ненужных солобщений

			$num = $_POST['num'];
			$pas = $_POST['pas'];
			WritePar2file( "cn.tmp", $num );
			WritePar2file( "ps.tmp", $pas );

			//запрещаем прямой вход на эту страницу
			CloseDirectPgEntre();


			$filename = "data/7.tmm";
			$arr      = file( $filename );
			$temp     = array( 'status', 'num', 'pas', 'nominal', 'adate', 'tdate', 'uemail' );
			$i        = 0;

			foreach ( $arr as $line ) {            // Разбиваем строку по разделителю ";"
				$data = explode( ";", $line );
// В массив $temp читаем имена и пароли зарегистрированных посетителей
//Card_Num;Pas;Status;Activation Date;Transfer Date;Transfer Number
//файл 6.csv == Status;Num;Pas;aDate;tDate;uEmail;uNote
				$temp['status'][ $i ]  = $data[0]; //статус 0:чистая 1:запрос 2:выполнен
				$temp['num'][ $i ]     = $data[1]; //номер карты
				$temp['pas'][ $i ]     = $data[2]; //пароль
				$temp['nominal'][ $i ] = $data[3]; //номинал
				$temp['adate'][ $i ]   = $data[4]; //дата активации
				$temp['tdate'][ $i ]   = $data[5]; //дата перевода
				$temp['uemail'][ $i ]  = $data[6]; //email
				//$temp['unote'][ $i ]   = trim( $data[7] ); //usernote
// Увеличиваем счётчик
				$i ++;
			}


			if ( ! in_array( $num, $temp['num'] ) and $pflag == 0 ) {
				$pflag = 1;

				OutMessagePg( "Ошибка номера:",
					"Введен неверный номер карты.",
					"<a href='http://luchikidobra.ru/go' class=button>ОК!</a>" );
			}


			// Если пользователь с именем $_POST['name'] обнаружен проверяем правильность введённого пароля
			$index = array_search( $num, $temp['num'] ); //это номер элемента в массиве
			//$nominal = array_search( $nominal, $temp['nominal'] );
			$nominal = $temp['nominal'][ $index ];
			$st = $temp['status'][ $index ];

			//Сохраняем в файле номинал карты
			WritePar2file( "nm.tmp", $nominal );



			if ( $pas != $temp['pas'][ $index ] and $pflag == 0 ) {
				$pflag = 1;

				OutMessagePg( "Ошибка пароля:",
					"Введен неверный пароль карты.",
					"<a href='http://luchikidobra.ru/go' class=button>ОК!</a>" );
			}


			//Если статус = 1 - // Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта

			if ( $temp['status'][ $index ] == 1 and $pflag == 0 ) {
				$pflag = 1;

				OutMessagePg( "КАРТА АКТИВИРОВАНА РАНЕЕ:",
					"Невозможно повторно активировать карту №$num",
					"<a href='http://luchikidobra.ru/go' class=button>ОК!</a>" );
			}


			//Если статус = 2 - // Если в массиве $temp['num'] нет введённого логина - останавливаем работу скрипта
			if ( $temp['status'][ $index ] == 2 ) {
				$pflag = 1;

				OutMessagePg( "КАРТА АКТИВИРОВАНА ПРЕЖДЕ:",
					"Средства с этой карты были перечислены в фонд.<br>Невозможно повторно активировать №$num.",
					"<a href='http://luchikidobra.ru/go' class=button>ОК!</a>" );
			}


			if ( $pflag == 0 ) {
				$pflag = 1;

				OutMessagePg( "Ура, всё получилось!",
					"Ваша карта теперь активирована,<br>осталось выбрать, кому выслать Лучики Добра.",
					"<a href='http://luchikidobra.ru/go3' class=button>ОК!</a>" );

			}

			///APS *********************************************


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
