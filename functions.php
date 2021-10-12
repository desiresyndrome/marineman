<?php

// Удаляем лишние теги в шапке WordPress
remove_action('wp_head', 'wp_generator'); remove_action('wp_head', 'wlwmanifest_link'); remove_action('wp_head', 'rsd_link');
 
// отключения обновления ядра WordPress
 add_filter('pre_site_transient_update_core',create_function('$a', "return null;")); wp_clear_scheduled_hook('wp_version_check');


// подключение папки перевода темы
function my_theme_setup(){load_theme_textdomain('ds', get_template_directory() . '/languages');}
add_action('after_setup_theme', 'my_theme_setup'); 


/**********************
** Настройки записей **
**********************/

// миниатюра к записи
add_theme_support('post-thumbnails'); 

// отключение стилей стандартных записей
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');

// настройка стилей
function improved_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<p>,<br>,<h2>,<h1>,<em>');
		$excerpt_length = 32;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, ' ...');
			$text = implode(' ', $words);
		}
	}
	return $text;
} 

// Отключение замены символов
remove_filter('the_content', 'wptexturize'); remove_filter('the_title', 'wptexturize'); remove_filter('comment_text', 'wptexturize'); remove_filter('the_excerpt', 'wptexturize');


// поле «menu_order» для постов
add_action('admin_init', 'posts_order_wpse_91866');
function posts_order_wpse_91866(){add_post_type_support( 'post', 'page-attributes' );}

/******************************
* Загружаемые стили и скрипты *
******************************/

// Подключение CSS и JS
add_action('wp_enqueue_scripts', 'load_style_script');
function load_style_script(){wp_enqueue_style('style', get_template_directory_uri() . '/css/style.min.css');}

// отключаем стили плагинов
add_action('wp_print_styles', 'true_otkljuchaem_stili_css', 100);
function true_otkljuchaem_stili_css(){wp_deregister_style('contact-form-7'); wp_deregister_style('wp-pagenavi');}

// Подключаем jquery
function my_scripts_method(){wp_deregister_script('jquery-core'); wp_register_script('jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'); wp_enqueue_script('jquery');}
add_action('wp_enqueue_scripts', 'my_scripts_method');

// поддержка Меню 
register_nav_menu('header-nav','Главное меню');

// Отключение ненужных пунктов Админки
function remove_menus(){remove_menu_page('edit-comments.php');}
add_action('admin_menu', 'remove_menus');

// Адап. картинок (через класс)
function add_image_responsive_class($content){
	global $post;
	$pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
	$replacement = '<img$1class="$2 img-responsive"$3>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
add_filter('the_content', 'add_image_responsive_class');


// ACF Options page
add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init(){
	if(function_exists('acf_add_options_page')) {
		$option_page = acf_add_options_page(array('page_title' => __('My Socials'), 'menu_title' => __('My Socials'), 'menu_slug' => 'theme-soc-settings', 'capability' => 'edit_posts', 'redirect' => false));
	}
}

// ACF для отдельной категории
add_filter('acf/location/rule_types', 'acf_location_rules_types', 999);
function acf_location_rules_types($choices){
	if (!isset($choices['Terms'])){$choices['Terms'] = array();}
	$choices['Terms']['category_id'] = 'Category Name';
	return $choices;
}

add_filter('acf/location/rule_values/category_id', 'acf_location_rules_values_category');
function acf_location_rules_values_category($choices){
	$taxonomy = 'category';
	$args = array('hide_empty' => false);
	$terms = get_terms($taxonomy, $args);
	if (count($terms)){foreach ($terms as $term){$choices[$term->term_id] = $term->name;}}
	return $choices;
}

add_filter('acf/location/rule_match/category_id', 'acf_location_rules_match_category', 8, 9);
function acf_location_rules_match_category($match, $rule, $options){
if (!isset($_GET['tag_ID']) ||
!isset($_GET['taxonomy']) ||
$_GET['taxonomy'] != 'category'){return $match;}
$term_id = $_GET['tag_ID'];
$selected_term = $rule['value'];
if ($rule['operator'] == '=='){$match = ($selected_term == $term_id);}
elseif ($rule['operator'] == '!='){$match = ($selected_term != $term_id);}
return $match;
}


// contacts form 7 delete span
add_filter('wpcf7_form_elements', function($content){
  $dom = new DOMDocument();
  $dom->preserveWhiteSpace = false;
  $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
  $xpath = new DomXPath($dom);
  $spans = $xpath->query("//span[contains(@class, 'wpcf7-form-control-wrap')]" );
  foreach ($spans as $span) :
    $children = $span->firstChild;
    $span->parentNode->replaceChild( $children, $span );
  endforeach;
  return $dom->saveHTML();
});
add_filter('wpcf7_autop_or_not', '__return_false');// delete br and p


// Сделать Html в 1 строку
class Compress_HTML {
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;
    protected $html;
    public function __construct($html)
    {if (!empty($html)){$this->parseHTML($html);}}
    public function __toString()
    {return $this->html;}
    protected function bottomComment($raw, $compressed){
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw-$compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';}
    protected function minifyHTML($html){
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;
        $html = '';
        foreach ($matches as $token) {
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
            $content = $token[0];
            if (is_null($tag)){
                if ( !empty($token['script']) ){$strip = $this->compress_js;             }
                else if ( !empty($token['style']) )
                {$strip = $this->compress_css;               }
                else if ($content == '<!--wp-html-compression no compression-->')
                {$overriding = !$overriding; continue;}
                else if ($this->remove_comments)
                {if (!$overriding && $raw_tag != 'textarea'){
                    $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);}}
            } else{
                if ($tag == 'pre' || $tag == 'textarea'){$raw_tag = $tag;}
                else if ($tag == '/pre' || $tag == '/textarea')
                {$raw_tag = false;}
                else{if ($raw_tag || $overriding){$strip = false;}else{$strip = true;
                    $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                    $content = str_replace(' />', '/>', $content);}}}
            if ($strip){$content = $this->removeWhiteSpace($content);}
            $html .= $content;}
        return $html;}
    public function parseHTML($html) {
        $this->html = $this->minifyHTML($html);
        if ($this->info_comment){$this->html .= "\n" . $this->bottomComment($html, $this->html);}}
    protected function removeWhiteSpace($str) {
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);
        while (stristr($str, '  ')){$str = str_replace('  ', ' ', $str);}
        return $str;}
}
function wp_html_compression_finish($html){return new Compress_HTML($html);}
function wp_html_compression_start(){ob_start('wp_html_compression_finish');}
add_action('get_header', 'wp_html_compression_start');


// Меняем метабоксы рубрик на радио кнопки
function tr_new_taxonomy_box(){
	$choosed_taxonomies = array('game', 'category');
	if ( empty($choosed_taxonomies) )
		return;
	foreach ($choosed_taxonomies as $tax_name){
		$taxonomy = get_taxonomy( $tax_name );
		if (!$taxonomy->hierarchical || !$taxonomy->show_ui || empty($taxonomy->object_type))
			continue;
		foreach ($taxonomy->object_type as $post_type){
			remove_meta_box("{$tax_name}div", $post_type, 'side');
			add_meta_box("unique-{$tax_name}-div", $taxonomy->labels->singular_name, 'tr_tax_metabox', $post_type, 'side', 'high', array('taxonomy' => $tax_name));
		}
	}
}
add_action('admin_menu', 'tr_new_taxonomy_box');

function tr_print_radiolist($post_id, $taxonomy){
	$terms = get_terms($taxonomy, array('hide_empty' => false, 'parent'  => 0));
	if (empty($terms))
		return;
	$name = ($taxonomy == 'category') ? 'post_category' : "tax_input[{$taxonomy}]";
	$current_post_terms = get_the_terms($post_id, $taxonomy);
	$current = array();
	if (!empty($current_post_terms)){
		foreach ($current_post_terms as $current_post_term)
			$current[] = $current_post_term->term_id;
	}
	$list = '';
	foreach ($terms as $term){
		$list .= "<li id='{$taxonomy}-{$term->term_id}'>";
		$list .= "<label class='selectit'>";
		$list .= "<input type='radio' name='{$name}[]' value='{$term->term_id}' ".checked( in_array($term->term_id, $current), true, false )." id='in-{$taxonomy}-{$term->term_id}' />";
		$list .= " {$term->name}</label>";
		$list .= "</li>\n";
		$childs = get_terms($taxonomy, array('hide_empty' => false, 'parent'  => $term->term_id));
		if (count($childs) > 0){
			$list .= "<ul class='children'>";
			foreach ($childs as $child){
				$list .= "<li id='{$taxonomy}-{$child->term_id}'>";
				$list .= "<label class='selectit'>";
				$list .= "<input type='radio' name='{$name}[]' value='{$child->term_id}' ".checked( in_array($child->term_id, $current), true, false )." id='in-{$taxonomy}-{$child->term_id}' />";
				$list .= " {$child->name}</label>";
				$list .= "</li>\n";
			}
			$list .= "</ul>";
		}
	}
	echo $list;
}

function tr_tax_metabox($post, $box){
	if (!isset($box['args']) || !is_array($box['args']))
		$args = array();
	else
	$args = $box['args'];
	$defaults = array('taxonomy' => 'category');
	extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	$tax = get_taxonomy($taxonomy);
	$name = ($taxonomy == 'category') ? 'post_category' : 'tax_input[' . $taxonomy . ']';
	$metabox = "<div id='taxonomy-{$taxonomy}' class='categorydiv'>";
	$metabox .= "<input type='hidden' name='{$name}' value='0' />";
	$metabox .= "<ul id='{$taxonomy}-tabs' class='category-tabs'>";
	$metabox .= "<li class='tabs'><a href='#{$taxonomy}-all' tabindex='3'>{$tax->labels->all_items}</a></li>";
	$metabox .= "</ul>";
	$metabox .= "<div id='{$name}-all' class='tabs-panel'>";
	$metabox .= "<ul id='{$taxonomy}checklist' class='list:{$taxonomy} categorychecklist form-no-clear'>";
	echo $metabox;
	tr_print_radiolist($post->ID, $taxonomy);
	echo "</ul></div></div>";
}


// Изменить количество записей в категории
function get_posts_5_1_st($query){if (!is_admin() && $query->is_main_query() && is_category(8)) {$query->set( 'posts_per_page', 5 );}}
add_action( 'pre_get_posts', 'get_posts_5_1_st' );

function get_posts_5_2_st($query){if (!is_admin() && $query->is_main_query() && is_category(22)) {$query->set( 'posts_per_page', 5 );}}
add_action( 'pre_get_posts', 'get_posts_5_2_st' );

function get_posts_5_3_st($query){if (!is_admin() && $query->is_main_query() && is_category(23)) {$query->set( 'posts_per_page', 5 );}}
add_action( 'pre_get_posts', 'get_posts_5_3_st' );

// 2
function get_posts_40_1_st($query){if (!is_admin() && $query->is_main_query() && is_category(9)) {$query->set( 'posts_per_page', 40 );}}
add_action( 'pre_get_posts', 'get_posts_40_1_st' );

function get_posts_40_2_st($query){if (!is_admin() && $query->is_main_query() && is_category(20)) {$query->set( 'posts_per_page', 40 );}}
add_action( 'pre_get_posts', 'get_posts_40_2_st' );

function get_posts_40_3_st($query){if (!is_admin() && $query->is_main_query() && is_category(21)) {$query->set( 'posts_per_page', 40 );}}
add_action( 'pre_get_posts', 'get_posts_40_3_st' );

function get_posts_40_4_st($query){if (!is_admin() && $query->is_main_query() && is_category(10)) {$query->set( 'posts_per_page', 40 );}}
add_action( 'pre_get_posts', 'get_posts_40_4_st' );

function get_posts_40_5_st($query){if (!is_admin() && $query->is_main_query() && is_category(24)) {$query->set( 'posts_per_page', 40 );}}
add_action( 'pre_get_posts', 'get_posts_40_5_st' );

function get_posts_40_6_st($query){if (!is_admin() && $query->is_main_query() && is_category(25)) {$query->set( 'posts_per_page', 40 );}}
add_action( 'pre_get_posts', 'get_posts_40_6_st' );
 
 
// Изменить шорткод для WPML
function wpml_shortcode_lang_ISO(){
	$languages = icl_get_languages('skip_missing=0');
	if (function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0&orderby=code&order=desc');
		echo '<ul class="language-chooser">';
		if(!empty($languages)){
			foreach($languages as $l){
				$class = $l['active'] ? ' class="active"' : '';
				if ($class) {
					$langs .=  '<li class="active"><a href="'.$l['url'].'"><span>'.strtoupper ($l['language_code']).'</span></a></li>';
				} else {
					$langs .=  '<li><a href="'.$l['url'].'"><span>'.strtoupper ($l['language_code']).'</span></a></li>';
				}
			}
		}
	}
	return $langs;
}
add_shortcode( 'wpml_custom_lang_ISO', 'wpml_shortcode_lang_ISO' );


// AJAX
function true_filter_function1(){
    ?>
    <?php
    $posFF = $_POST['posFF'];
    $vesFF = $_POST['vesFF'];
    $natFF = $_POST['natFF'];
    $args = array('post_status' => 'publish', 'posts_per_page' => 20, 'post_type' => 'post', 'category_name' => 'vacancies','orderby' => 'menu_order','order' => 'ASC' );
    if($posFF || $vesFF || $natFF){
        $args['meta_query'] = array(
                'relation' => 'AND',
            );
    }
    if($posFF){
        $args['meta_query'][] =
            array(
                'key' => 'va-rank',
                'value' => $posFF
            );
    }
    if($vesFF){
        $args['meta_query'][] =
            array(
                'key' => 'va-vessel',
                'value' => $vesFF
            );
    }
    if($natFF){
        $args['meta_query'][] =
            array(
                'key' => 'va-nationality',
                'value' => $natFF,
                'compare' => 'LIKE'
            );
    }

// query_posts( $args );
    $query = new WP_Query($args);
    ?>
    <div class="gl-job-item-wrapp">
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post();?>

            <div class="gl-job-item-block <?php the_field('va-pin') ?>"><div class="gl-job-item-inner"><div class="gl-job-item-leftside"><div class="gl-job-item-leftside-top"><h3 class="gl-job-item-title"><?php the_field('va-rank') ?></h3><p class="gl-job-item-type"><?php _e('Type of vessel','ds'); ?>: <?php the_field('va-vessel') ?></p><p class="gl-job-item-nat"><?php _e('Nationality','ds'); ?>: <?php the_field('va-nationality') ?></p></div><div class="gl-job-item-leftside-bottom"><div class="gl-job-item-price"><span><?php the_field('va-price') ?></span></div><div class="gl-job-item-word"><span><?php the_field('va-world') ?></span></div><div class="gl-job-item-time"><span><?php the_field('va-time') ?></span></div></div></div><div class="gl-job-item-rightside"><!--<div class="gl-job-item-data"><span><?php echo get_the_date('M. d, Y'); ?></span></div> --><div class="gl-job-item-buttons"><a href="javascript:void(0)" class="gl-job-item-button1 click-pop" data-title-sert="<?php the_title(); ?>"><span><?php _e('Apply now','ds'); ?></span></a><a href="<?php the_permalink(); ?>" class="gl-job-item-button2"><span><?php _e('Read more','ds'); ?></span></a></div></div></div></div>

        <?php endwhile; ?>
        </div>
        <?php if ($query->max_num_pages > 1): ?>

            <div class="blog-pagination-tag"><div class="gl-job-item-buttons">
                    <a id="pagin" href="javascript:void(0)" data-page-c="1" data-page-m="<?php echo $query->max_num_pages; ?>" class="gl-job-item-button1" style="max-width: 170px; margin: auto"><span>More</span></a>
                    <?php
                    ?>
                </div></div>

        <?php endif; ?>
    <?php wp_reset_postdata(); else: ?>

        <p style="margin-top: 15px; text-align: center"><?php esc_html_e( 'Nothing Found', 'ds' ); ?></p>

    <?php endif;?>
    <?php
    die();
}
add_action('wp_ajax_myfilter1', 'true_filter_function1');
add_action('wp_ajax_nopriv_myfilter1', 'true_filter_function1');

function true_filter_function2(){
    ?>
    <?php
    $posFF =  $_POST['posFF'];
    $vesFF =  $_POST['vesFF'];
    $natFF =  $_POST['natFF'];
    $current =  $_POST['current'];
    $paded = $current+1;
    $args = array('post_status' => 'publish','posts_per_page' => 20,'post_type' => 'post','category_name' => 'vacancies','paged' => $paded,'orderby' => 'menu_order','order' => 'ASC' );
    if($posFF || $vesFF || $natFF){
        $args['meta_query'] = array(
            'relation' => 'AND',
        );
    }
    if($posFF){
        $args['meta_query'][] =
            array(
                'key' => 'va-rank',
                'value' => $posFF
            );
    }
    if($vesFF){
        $args['meta_query'][] =
            array(
                'key' => 'va-vessel',
                'value' => $vesFF
            );
    }
    if($natFF){
        $args['meta_query'][] =
            array(
                'key' => 'va-nationality',
                'value' => $natFF,
                'compare' => 'LIKE'
            );
    }

// query_posts( $args );
    $query = new WP_Query( $args );
    ?>
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post();?>

         <div class="gl-job-item-block <?php the_field('va-pin') ?>"><div class="gl-job-item-inner"><div class="gl-job-item-leftside"><div class="gl-job-item-leftside-top"><h3 class="gl-job-item-title"><?php the_field('va-rank') ?></h3><p class="gl-job-item-type"><?php _e('Type of vessel','ds'); ?>: <?php the_field('va-vessel') ?></p><p class="gl-job-item-nat"><?php _e('Nationality','ds'); ?>: <?php the_field('va-nationality') ?></p></div><div class="gl-job-item-leftside-bottom"><div class="gl-job-item-price"><span><?php the_field('va-price') ?></span></div><div class="gl-job-item-word"><span><?php the_field('va-world') ?></span></div><div class="gl-job-item-time"><span><?php the_field('va-time') ?></span></div></div></div><div class="gl-job-item-rightside"><!--<div class="gl-job-item-data"><span><?php echo get_the_date('M. d, Y'); ?></span></div> --><div class="gl-job-item-buttons"><a href="javascript:void(0)" class="gl-job-item-button1 click-pop" data-title-sert="<?php the_title(); ?>"><span><?php _e('Apply now','ds'); ?></span></a><a href="<?php the_permalink(); ?>" class="gl-job-item-button2"><span><?php _e('Read more','ds'); ?></span></a></div></div></div></div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); else: ?>

        <p style="margin-top: 15px; text-align: center"><?php esc_html_e( 'Nothing Found', 'ds' ); ?></p>

    <?php endif;?>
    <?php
    die();
}
add_action('wp_ajax_myfilter2', 'true_filter_function2');
add_action('wp_ajax_nopriv_myfilter2', 'true_filter_function2');

function true_filter_function3(){
    ?>
    <?php
    $typeFF =  $_POST['typeFF'];
    $args = array('post_status' => 'publish','posts_per_page' => 40,'post_type' => 'post','category_name' => 'ships','orderby' => 'menu_order','order' => 'ASC');
    if($typeFF){
        $args['meta_query'] = array(
            'relation' => 'AND',
        );
    }
    if($typeFF){
        $args['meta_query'][] =
            array(
                'key' => 's-vessel-type',
                'value' => $typeFF
            );
    }

// query_posts( $args );
    $query = new WP_Query( $args );
    ?>

    <div class="all-ships-block-wrapp">

    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post();?>

<div class="one-ship"><div class="one-ship-item"><p><?php the_field('s-name') ?></p></div><div class="one-ship-item"><p><?php the_field('s-vessel-type') ?></p></div><div class="one-ship-item"><p><?php the_field('s-imo') ?></p></div><div class="one-ship-item"><a href="<?php the_permalink(); ?>"><span><?php _e('View','ds'); ?></span></a></div></div>

        <?php endwhile; ?>
        <?php else: ?>

        <p style="margin-top: 15px; text-align: center"><?php esc_html_e( 'Nothing Found', 'ds' ); ?></p>

    <?php endif;?>
    </div>

    <?php if ($query->max_num_pages > 1): ?>

        <div class="blog-pagination-tag"><div class="gl-job-item-buttons">
                <a id="pagin-s" href="javascript:void(0)" data-page-c="1" data-page-m="<?php echo $query->max_num_pages; ?>" class="gl-job-item-button1" style="max-width: 170px; margin: auto"><span>More</span></a>
                <?php
                ?>
            </div></div>

    <?php endif; ?>
    <?php
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_myfilter3', 'true_filter_function3');
add_action('wp_ajax_nopriv_myfilter3', 'true_filter_function3');

function true_filter_function4(){
    ?>
    <?php
    $typeFF =  $_POST['typeFF'];
    $current =  $_POST['current'];
    $paded = $current+1;
    $args = array('post_status' => 'publish','posts_per_page' => 40,'post_type' => 'post','category_name' => 'ships','paged' => $paded,'orderby' => 'menu_order','order' => 'ASC');
    if($typeFF){
        $args['meta_query'] = array(
            'relation' => 'AND',
        );
    }
    if($typeFF){
        $args['meta_query'][] =
            array(
                'key' => 's-vessel-type',
                'value' => $typeFF
            );
    }

// query_posts( $args );
    $query = new WP_Query( $args );
    ?>
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post();?>

<div class="one-ship"><div class="one-ship-item"><p><?php the_field('s-name') ?></p></div><div class="one-ship-item"><p><?php the_field('s-vessel-type') ?></p></div><div class="one-ship-item"><p><?php the_field('s-imo') ?></p></div><div class="one-ship-item"><a href="<?php the_permalink(); ?>"><span><?php _e('View','ds'); ?></span></a></div></div>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); else: ?>

        <p style="margin-top: 15px; text-align: center"><?php esc_html_e( 'Nothing Found', 'ds' ); ?></p>

    <?php endif;?>
    <?php
    die();
}
add_action('wp_ajax_myfilter4', 'true_filter_function4');
add_action('wp_ajax_nopriv_myfilter4', 'true_filter_function4');

// gtm.js - файл кодом Google Tag Manager (noscript) после тэга body
add_action( 'wp_body_open', 'gtm_init', 10 );
function gtm_init(){
  ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6D56HD"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
  <?php
}
 
?>