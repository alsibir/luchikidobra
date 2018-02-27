<h1>Компостер "Пальчики Бобра"</h1>
<b>Применяется сразу после перечисления средств оплаты.</b><br>
Действие: добавит в базу отметку о выполнении транзакции.<br>
Поменяет статус на 2=завершено и добавит дату транзакции.<br><br>
<hr>
<!-- -->
<table>
    <form method=post>
        <tr>
            <td>Номер:</td>
            <td><input type="text" name="num" placeholder="Номер карты (6 цифр)" pattern="[ 0-9]{6}"
                       title="Номер карты содержит - 6 знаков. Пример: 123456" required maxlength="6"/></td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><input type="password" name="pas" placeholder="Пароль карты"
                       title="Поскоблите карту с обратной стороны, чтобы увидеть пароль" required maxlength="15"/></td>
        </tr>
        <tr>
            <td><span lang="ru">Текст:</span></td>
            <td>
                <!-- длинна строки maxlength="45"
                                             <textarea rows="8" name="usernote" cols="41" maxlength="45"></textarea>
                                                                                                           -->
                <p><input type=submit value='Отправить'></td>
        </tr>
    </form>
</table>
<hr>


<?php
/**
 * Created by PhpStorm.
 * User: alsibir
 * Date: 27.01.2018
 * Time: 16:04
 */


$filename = "data/6.csv";

$arr = file( $filename );

$temp = array( 'status', 'num', 'pas', 'nominal', 'adate', 'tdate', 'uemail', 'unote' );

$num = $_POST['num'];
$pas = $_POST['pas'];

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
	$temp['nominal'][ $i ]= $data[3];
	$temp['adate'][ $i ]  = $data[4]; //дата активации
	$temp['tdate'][ $i ]  = $data[5]; //дата перевода
	$temp['uemail'][ $i ] = $data[6]; //email
	$temp['unote'][ $i ]  = trim( $data[7] ); //usernote
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


//Проверка статуса 0 - "не активирован"
if ( $temp['status'][ $index ] == 0 ) {
	exit( "<br>Карта еще НЕ была активирована.
           <br>Сначала активируйте карту на странице go, отправьте деньги 
                и затем погасите карту компостером!<br><h1>Программа завершена!</h1>" );
}


//Проверка статуса 2 - "оплачен"
if ( $temp['status'][ $index ] == 2 ) {
	exit( "<br><h1>Эта карта УЖЕ была закомпостирована ранее! </h1><br>
               <li>Отметка об активации: " . $temp['adate'][ $index ] . "</li> 
	           <li>Отметка от компостера: " . $temp['tdate'][ $index ]
	      . "</li><h1>Попробуйте закомпостировать другую карту!</h1>" );
}


echo " статус позволяет продолжить. Статус = [" . $temp['status'][ $index ] . "]";

//$_POST['num'] = trim($_POST['num']);
//$_POST['pas'] = trim($_POST['pas']);
$_POST['usernote'] = trim( $_POST['usernote'] );


//if(empty($_POST['num'])) exit();
if ( empty( $_POST['num'] ) ) {
	exit( 'Поле "Имя" не заполнено' );
}
if ( empty( $_POST['pas'] ) ) {
	exit( 'Поле "Пароль" не заполнено' );
}
//if(empty($_POST['usernote'])) exit('Введите комментарий');


//вносим изменения в файл в карту num = $index
$temp['status'][ $index ] = 2; //статус 0:чистая карта, 1:запрос на перевод, 2:запрос выполнен
//$temp['num'][$index]   = -$temp['num'][$index]; //номер карты
//$temp['pas'][$i]   = $data[1]; //пароль
//$temp['adate'][ $index ] = date("m.d.y"); //дата активации это системная дата
$temp['tdate'][ $index ] = date( "m.d.y" ); //дата перевода средств (системная)
//$temp['uemail'][$index] = 'ххх@ххх.хх'; //email
//$temp['unote'][$index]  = 'хвалебный текст от юзера';


echo "<h1>Закомпостировано!</h1>";
echo '<h2>Дамп базы данных:</h2>';
//Запись массива в файл
$f = fopen( $filename, 'w' );  //$fail = fopen($filename,"a");
//в цикле считываем данные из массива и пишем их на экран и в файл
for ( $i = 0; $i < 119; $i ++ ) {
	//отправляем на экран
	echo $temp['status'][ $i ] . ";" .
	     $temp['num'][ $i ] . ";" .
	     $temp['pas'][ $i ] . ";" .
	     $temp['nominal'][ $i ] . ";" .
	     $temp['adate'][ $i ] . ";" .
	     $temp['tdate'][ $i ] . ";" .
	     $temp['uemail'][ $i ] . ";" .
	     $temp['unote'][ $i ] . "<br>";
	//отправляем в файл
	$line = $temp['status'][ $i ] . ";" .
	        $temp['num'][ $i ] . ";" .
	        $temp['pas'][ $i ] . ";" .
	        $temp['nominal'][ $i ] . ";" .
	        $temp['adate'][ $i ] . ";" .
	        $temp['tdate'][ $i ] . ";" .
	        $temp['uemail'][ $i ] . ";" .
	        $temp['unote'][ $i ];
	fputs( $f, $line . "\n" );
}

//закраваем соединение с файлом
fclose( $f );


?>