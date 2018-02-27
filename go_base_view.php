<?php
/**
 * Created by PhpStorm.
 * User: alsibir
 * Date: 31.01.2018
 * Time: 16:23
 */


$filename = "data/6.csv";

echo "Распечатка дампа БД";
echo "<pre>" . file_get_contents($filename) . "</pre>";






//echo '<h2>Дамп базы данных:</h2>';
////Вывод на экран
//$f = fopen( $filename, 'w' );  //$fail = fopen($filename,"a");
////в цикле считываем данные из массива и пишем их на экран и в файл
//for ( $i = 0; $i < 119; $i ++ ) {
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




?>

<style>
	.wrong {
		margin-top: 5px;
		padding: 5px;
		background-color: #F00;
		border: 2px solid #666;
		width: auto;
		color: #000000;
	}

	.wrong1 {
		margin-top: 125px;
		margin-bottom: 200px;
		margin-left: 5%;
		margin-right: 5%;

		padding: 15px;
		background-color: red;
		border: 8px solid  yellow;
		width: 80%% auto;
		text-align: center;
		font-size: 150%;
		color: yellow;
	}

	.sts2 {
		color: #363030;
		text-shadow: #000 0px 1px 0px;
	}

	.my-rule {
		margin-top: 125px;
		margin-bottom: 200px;
		margin-left: 5%;
		margin-right: 5%;

		padding: 15px;
		background-color: red;
		border: 5px solid  yellow;
		width: 80%% auto;
		text-align: center;
		font-size: 150%;
		color: yellow;

	}

	a.knopka {
		color: #fff; /* цвет текста */
		text-decoration: none; /* убирать подчёркивание у ссылок */
		user-select: none; /* убирать выделение текста */
		background: rgb(212,75,56); /* фон кнопки */
		padding: .7em 1.5em; /* отступ от текста */
		outline: none; /* убирать контур в Mozilla */
	}
	a.knopka:hover { background: rgb(232,95,76); } /* при наведении курсора мышки */
	a.knopka:active { background: rgb(152,15,0); } /* при нажатии */

</style>