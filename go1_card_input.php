<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма ввода для карт ЛД</title>
</head>

<body>
<!-- В form в атрибуте num указывается номер карты - и в будущем массива -->
<!-- В action название файла обработчика -->
<!-- В method указываем способ передачи post -->
<h1>Активация карты "Лучики Добра"</h1>
<p>Проверка производится по полной базе тестовых карт<br>
<hr>
</p>


<table>
    <form name='myform' action='go2_card_check.php' method='post'>
        <tr>
            <td>Номер:</td>
            <td><input type="text" name="num" placeholder="Номер карты (6 цифр)" pattern="[ 0-9]{6}"
                       title="Номер карты содержит - 6 знаков. Пример: 123456" required maxlength="6"/>
            </td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><input type="text" name="pas" placeholder="Пароль карты"
                       title="Поскоблите карту с обратной стороны, чтобы увидеть пароль" required maxlength="15"/>

        </tr>
        <!--
        <tr>
			<td><span lang="ru">Ваше сообщение:</span></td>
			<td><textarea rows="3" name="unote" cols="41" title="Если желаете, заполните сообщение
				   для администрации сайта (120 символов):"
								 placeholder="Заполните, если есть, что передать администрации (120 символов)"
								 maxlength="120"></textarea>
 		</tr>-->
        <tr>
            <td></td>
            <td><p><input type=submit name="subscribe" value="Активировать карту"></td>
            </td>

        </tr>
    </form>
</table>
<hr>
Copyryght (C) -- 2018г, ООО "Пальчики Бобра"

</body>
</html>