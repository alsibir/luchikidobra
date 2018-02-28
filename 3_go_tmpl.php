<?php
/**
 * Template Name: 3_Go_TMPL
 */
get_header();

//style="margin-left: 5%; margin-top: 10%; width: 40%;"
//style="margin-left: 5%;  margin-top: 5%;  margin-bottom: 5%; width: 40%;"
//style="margin-left: 5%; width: 40%;  background: #d6d6d6; border solid"
//<div style="min-width: 260px;
//  max-width: 35%;
//  margin: 10 auto;
//  padding: 10 auto;" >
//  </div>
//margin-left: 5%; width: 50%;


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
            <div style="margin: 20px 10% 200px 0">
                <table>
                    <form name='myform1' action=http://luchikidobra.ru/go4 method="post">
                        <tr>
                            <td colspan="2">
                                <!--             <p>Укажите название фонда в который следует перечислить номинал карты:</p><br/>-->
								<?php
								$nominal = trim( file_get_contents( 'data/nm.tmp' ) ); //Читаем всё содержимое файла в строку
								echo "<h2>На вашей карте:<b> $nominal </b> рублей.</h2>";
								?>

                            </td>

                        </tr>

                        <tr>
                            <td width="25%">
                                <input type="radio" name="voice" value="fond1" checked/>
                                Фонд 1. <a href="https://podari-zhizn.ru/main/" target="_blank" class=knopka><b>Подари
                                    жизнь</b><br>(Тяжелобольные дети)
                            </td>
                            <td width="55%">
                                <p>
                                    Фонд помощи детям с онкогематологическими и иными тяжелыми заболеваниями.
                                    Учреждён в 2006 г. Диной Корзун и Чулпан Хаматовой. Крупнейший благотворительный
                                    фонд России.
                                    <br>
                                    <a href=/https://podari-zhizn.ru" target="_blank">Перейти на сайт фонда</a><br>
                                </p>

                            </td>
                        </tr>


                        <tr>
                            <td>
                                <input type="radio" name="voice" value="fond2"/>
                                Фонд 2. <b>Линия жизни</b><br>(Тяжелобольные дети)
                            </td>
                            <td>
                                <p>
                                    Благотворительный фонд спасиения тяжелобольных детей. Также
                                    занимается формированием культуры благотворительности в России.
                                    На февраль 2018 г., фонд 'Линия жизни' спас более 9600 детей
                                    по всей России. Все поступающие в 'Линию жизни' деньги используются
                                    только на лечение детей. Учрежден в 2008 г.
                                    Действует как программа помощи с 2004 г.
                                    <br>
                                    <a href="http://www.life-line.ru" target="_blank">Перейти на сайт фонда</a><br>


                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="radio" name="voice" value="fond3"/>
                                Фонд 3. <b>Вера</b><br>(Хосписы. Неизлечимо-больные дети)
                            </td>
                            <td>
                                <p>
                                    Фонд помощи хосписам 'Вера' — единственная в России некоммерческая
                                    организация, которая занимается поддержкой хосписов и их пациентов. В фонде
                                    убеждены, что если человека нельзя вылечить, это не значит, что ему нельзя
                                    помочь. Учрежден в 2006 г. и быстро стал центром хосписного движения в стране.
                                    Фонд назван в честь Веры Миллионщиковой, создателя и главного врача Первого
                                    московского хосписа.
                                    <br>
                                    <a href="http://www.hospicefund.ru/" target="_blank">Перейти на сайт фонда</a><br>
                                </p>
                            </td>
                        </tr>


                        </tr>

                        <tr>
                            <td>
                                <input type="radio" name="voice" value="fond4"/>
                                Фонд 4. <b>AdVita</b><br>(Помощь при онкологии)
                            </td>
                            <td>
                                Фонд оказывает помощь медицинским учреждениям,занимающимся лечением
                                онкологических больных, а также адресную помощь детям и взрослым, больным раком.
                                'Гематологи Мира - детям'. Учрежден в 2002 г.
                                <br>
                                <a href="http://www.advita.org/" target="_blank">Перейти на сайт фонда</a><br>

                                </p>
                            </td>
                        </tr>


                        <tr>


                            <td>
                                <input type="radio" name="voice" value="fond5"/>
                                Фонд 5. <b>Фонд "Старость в радость"</b><br>(Помощь инвалидам и
                                        престарелым)
                            </td>
                            <td>
                                <p>
                                    Старость в радость – это благотворительный фонд помощи инвалидам
                                    и пожилым, живущим в домах престарелых. Цель фонда – повышение качества жизни
                                    пожилых людей в домах престарелых и ивалидов. Учрежден в 2011 г.
                                    Существует как движение с 2007 г.
                                    <br>
                                    <a href="https://starikam.org/" target="_blank">Перейти на сайт фонда</a><br>
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <input type="radio" name="voice" value="fond6"/>
                                Фонд 6. <b>Милосердие</b><br>(Адресная помощь
                                нуждающимся)
                            <td>

                                <p>
                                    Православная служба помощи «Милосердие» собирает средства для
                                    проектов службы и на адресные просьбы о помощи. В службу «Милосердие»
                                    входит целый ряд юридических лиц, совместно реализующих 27 социальных
                                    проектов. Миссия службы – помогать наиболее нуждающимся и бедствующим,
                                    облегчать страдания, улучшать качество жизни подопечных.
                                    Учреждена в 2005 г. Ранее, с 1991 г., действовала как сестричество.
                                    <br>
                                    <a href=https://miloserdie.help/ rel="external">Перейти на сайт фонда</a>

                                </p>
                            </td>
                        </tr>



                        <tr>
                            <td>Укажите <b>е-mail</b> (необязательно):
                            </td>
                            <td><input type="text" name="uemail" placeholder="Ваш е-mail, получить квитанцию.">
                            </td>
                        </tr>


                        <!-- <tr>
						   <td>Ваши <b>комментарии</b> (необязательно):</td>
						   <td><textarea rows="5" cols="45" name="unote"
										 placeholder="Это поле заполнять не обязательно"></textarea>
					   </tr>

					   <tr>
						   <td><span lang="ru">Ваше сообщение:</span></td>
						   <td><textarea rows="3" name="unote" cols="41" title="Если желаете, заполните сообщение
								  для администрации сайта (120 символов):"
												placeholder="Заполните, если есть, что передать администрации (120 символов)"
												maxlength="120"></textarea>
						</tr>-->


                        <tr>
                            <td>

                            </td>
                            <td>
                                <input class=knopka type="submit" value="Отправить Лучики Добра!"><br>
                                <br><br>
                            </td>
                        </tr>


                    </form>
                </table>

            </div>
            <!--end content-->
        </main>

		<?php

		//get the sidebar
		$avia_config['currently_viewing'] = 'page';
		get_sidebar();

		?>

    </div><!--end container-->

</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>




