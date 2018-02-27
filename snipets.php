<?php
/**
 * Created by PhpStorm.
 * User: alsibir
 * Date: 27.01.2018
 * Time: 10:13
 */

//Печать массивов



echo "<br><br><h1>$arr</h1><br>";
print_r($arr);
echo "<br><br><h1>$temp</h1><br>";
print_r($temp);

echo '<br>Печать массива temp с изменениями<pre>';
//print_r($temp);
echo '</pre>';
//echo "Число элементов в массиве ".count($temp);






//echo '===================================<br>';
//for ($i = 0; $i < 6; $i++)
//{
//	for ($j=0; $j <6; $j++)
//	{
//		echo ' | '.$temp[$i][$j];
//	}
//	echo '<br />';
//}
//echo "Число элементов в массиве ".count($temp);




//$i = 0;
//$data = "";
//foreach($arr as $line) {
//	$data    = implode( ";", $line );
//	$data    = "";
//	$data[0] = $temp['num'][ $i ]; //номер
//	$data[1] = $temp['pas'][ $i ]; //пароль
//	$data[2] = $temp['status'][ $i ]; //статус
//	$data[3] = $temp['adate'][ $i ]; //дата
//	$data[4] = $temp['tdate'][ $i ]; //дата
//	$data[5] = $temp['uemail'][ $i ]; //email
//	$data[6] = $temp['unote'][ $i ]; // trim($data[6])
//
//}

//echo "<br><br><br><br>data<br>".$data[i];

//foreach($arr as $key => $value) {
////$array = array('num','pas','status','adate','tdate','uemail','unote');
//	$comma_separated = implode( ";", $temp[$key] );
//
//	echo $comma_separated. "<br>"; // lastname,email,phone
//}



//*********************************************************************

//Сегодня я хочу показать как можно хранить массив в файле. Идея очень простая:
// сериализуем массив — приводим его к виду строки, потом записываем в файл.
// Получить массив обратно также просто — получаем строку из файла и обратно п
//риводим ее к виду массива. Для преобразования массива в строку и обратно
// будем использовать две php функции — serialize и unserialize.

//Приступим к коду, он оформлен в виде двух функций и подробно прокомментирован:
//Сегодня я хочу показать как можно хранить массив в файле. Идея очень простая:
// сериализуем массив — приводим его к виду строки, потом записываем в файл.
// Получить массив обратно также просто — получаем строку из файла и обратно
// приводим ее к виду массива. Для преобразования массива в строку и обратно
// будем использовать две php функции — serialize и unserialize.

//Приступим к коду, он оформлен в виде двух функций и подробно прокомментирован:

/**
 * Запись массива в файл
 */
function writeArrayInFile($testArray){
	$serArray = serialize($testArray); // преобразовываем массив в строку
	$file = fopen ("array123.txt","w+"); // открываем файл, если надо то создаем
	fputs($file, $serArray); // записываем в него строку
	fclose($file); // закрываем файл
}

/**
 * Чтение массива из файл
 */
function readArrayInFile($fileName){
	$file = fopen($fileName, 'r'); // открываем файл
	$str = "";
// считываем все из файла
	while (($buffer = fgets($file, 128)) !== false) {
		$str .= $buffer;
	}
	$array = unserialize($str); // преобразовываем строку в массив
	return $array;
}








//И пример использования:

// пример использования
$testArray = array(1, 2, 3, 'five', 'six'); // тестовый массив
writeArrayInFile($temp); // записываем в файл
//$array = readArrayInFile('array.txt'); // чтение из файла






//*************************************************************************

$arr = file($filename);
$i = 0;
//$temp = array();
//foreach($arr as $line)
//{
//	// Разбиваем строку по разделителю ";"


//	$data = implode(";",$temp);
//	echo "+++++++DATA";
print_r($data);

//	// В массив $temp помещаем имена и пароли
//	// зарегистрированных посетителей
//	//Card_Num;Pas;Status;Activation Date;Transfer Date;Transfer Number
//
//	//файл 33.csv == Num;Pas;Status;aDate;tDate;uEmail;uNote


//	$temp['num'][$i]   = $data[0]; //номер карты
//	$temp['pas'][$i]   = $data[1]; //пароль
//	$temp['status'][$i] = $data[2]; //статус 0:чистая 1:запрос 2:выполнен
//	$temp['adate'][$i] = $data[3]; //дата активации
//	$temp['tdate'][$i] = $data[4]; //дата перевода
//	$temp['uemail'][$i] = $data[5]; //email
//	$temp['unote'][$i]   = trim($data[6]); //usernote
//	// Увеличиваем счётчик
//	$i++;
//}
//
//
//// ПРИМЕР
//$array = $temp;
//// еще одно значение добавим таким способом
//$array[] = 'Супер значение';
//
//$array = $temp;

//$ar=['a','b','c','d','e'];
$f=fopen('test1.php','a');
foreach($array as $k=>$v){fwrite($f, $array[$k]."\n");}


echo '<br>ПРИМЕР<pre>';
print_r($array);
echo '</pre>ПРИМЕР закончен';


/**
 * void object2file - функция записи объекта в файл
 *
 * @param mixed value - объект, массив и т.д.
 * @param string filename - имя файла куда будет произведена запись данных
 * @return void
 *
 */
function object2file($value, $filename)
{
	$str_value = serialize($value);

	$f = fopen($filename, 'w');
	fwrite($f, $str_value);
	fclose($f);
}


/**
 * mixed object_from_file - функция восстановления данных объекта из файла
 *
 * @param string filename - имя файла откуда будет производиться восстановление данных
 * @return mixed
 *
 */
function object_from_file($filename)
{
	$file = file_get_contents($filename);
	$value = unserialize($file);
	return $value;
}




// запишем массив в файл
object2file($array, 'array.txt');
// в файл array.txt будет записана следующая информация:
// serialize $array
// a:5:{i:1;s:19:"Номер один";s:3:"two";i:2;s:5:"three";s:24:"Это номер три";i:4;i:4;i:5;s:27:"Супер значение";}

echo '<br><br><br>*************************************************<pre>';
print_r(object_from_file('array.txt'));
echo '</pre>';

