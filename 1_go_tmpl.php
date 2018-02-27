
<?php
/**
 * Template Name: 1_Go_TMPL
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


if ( !defined('ABSPATH') ){ die(); }

global $avia_config;

/*
 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
 */
get_header();


if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();

do_action( 'ava_after_main_title' );
?>

<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

    <div class='container'>

        <main class='template-page content  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>

			<?php
			/* Run the loop to output the posts.
			* If you want to overload this in a child theme then include a file
			* called loop-page.php and that will be used instead.
			*/

			$avia_config['size'] = avia_layout_class( 'main' , false) == 'fullsize' ? 'entry_without_sidebar' : 'entry_with_sidebar';
			get_template_part( 'includes/loop', 'page' );
			?>
            <div style="margin: 20px 40px 200px 0px">
                <table>
                    <form name='myform' action=http://luchikidobra.ru/go2 method='post'>
                        <tr>
                            <td>Номер:</td>
                            <td><input type="text" name="num" placeholder="Номер карты (6 цифр)" pattern="[ 0-9]{6}"
                                       title="Номер карты - 6 знаков. Пример: 123456" required maxlength="6"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Код карты:</td>
                            <td><input type="text" name="pas" placeholder="Код карты"
                                       title="Поскоблите карту с обратной стороны, там код карты" required maxlength="15"/>

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
                <br><br><br><br><br><br><br><br>
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
