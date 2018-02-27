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

    .center {

        width: 650px; /* Ширина элемента в пикселах */
        padding: 50px; /* Поля вокруг текста */
        margin: auto; /* Выравниваем по центру */
        background: rgba(214, 214, 214, 0.96);
        text-align: center;
        vertical-align: center;
        margin-top: 50px;
    }

    /* Цвет фона */

</style>

<?php
/**
 * Template Name: 1_GoT_emplate
 */
get_header();
?>




<div class="center">
    <h2>Активация карты "Лучики Добра"</h2><br>


    <table>
        <form name='myform' action=http://luchikidobra.ru/go2 method='post'>
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
                <td><p><input class=knopka type=submit name="subscribe" value="Активировать карту"></td>
                </td>

            </tr>
        </form>
    </table>
</div>
<br><br><br><br><br><br><br><br>

-

<?php get_footer(); ?>


