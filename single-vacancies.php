 <?php
/*
Template Name: Single
*/
?>
<?php get_header(); ?>
<?php $category = get_the_category(); $term = get_term($category[0]->cat_ID);?>

<div class="wrapper">

	<?php include 'head.php';?><div class="header-padding"></div>	

	<main class="content">

		<div class="single-vacancies-wrap wraper-100"><div class="single-vacancies-flex wraper-1240">
			<div class="single-vacancies-job-block"><div class="single-vacancies-job-inner"><h2 class="single-vacancies-job-title"><?php _e('INFO ABOUT THE JOB','ds'); ?></h2>
				<div class="single-vacancies-job-top"><h2><?php the_field('va-rank') ?></h2><p><?php _e('on','ds'); ?> <?php the_field('va-vessel') ?></p></div>
				<div class="single-vacancies-job-data"><div class="single-vacancies-job-price"><span><?php _e('','ds'); ?><?php the_field('va-price') ?></span></div><div class="single-vacancies-job-word"><span><?php the_field('va-world') ?></span></div><div class="single-vacancies-job-time"><span><?php the_field('va-time') ?></span></div></div>
				<!-- <div class="single-vacancies-job-item"><table border="0" class="single-vacancies-job-item-inner"><tr><td><?php _e('Posted date','ds'); ?></td><td><?php echo get_the_date('M. d, Y'); ?></td></tr><tr><td><?php _e('Expiry date','ds'); ?></td><td><?php the_field('va-expiry-date') ?></td></tr></table></div> -->
				<div class="single-vacancies-job-desc"><h2 class="single-vacancies-job-desc-title"><?php _e('Job Description','ds'); ?></h2><div class="single-vacancies-job-desc-text"><?php the_field('va-description') ?></div></div>
				<div class="single-vacancies-job-item"><h2><?php _e('Conditions of Employment','ds'); ?></h2><table border="0" class="single-vacancies-job-item-inner"><tr><td><?php _e('Duration of contract','ds'); ?></td><td><?php the_field('va-time') ?></td></tr><tr><td><?php _e('Salary','ds'); ?></td><td><?php the_field('va-price') ?></td></tr></table></div>
				<div class="single-vacancies-job-item"><h2><?php _e('Vessel information','ds'); ?></h2><table border="0" class="single-vacancies-job-item-inner"><tr><td><?php _e('Vessel','ds'); ?></td><td><?php the_field('va-vessel') ?></td></tr><tr><td><?php _e('DWT/GRT','ds'); ?></td><td><?php the_field('va-dwtgrt') ?></td></tr><tr><td><?php _e('Year of build','ds'); ?></td><td><?php the_field('va-year') ?></td></tr><tr><td><?php _e('Flag','ds'); ?></td><td><?php the_field('va-flag') ?></td></tr><tr><td><?php _e('Trading Area','ds'); ?></td><td><?php the_field('va-world') ?></td></tr><tr><td><?php _e('Crew','ds'); ?></td><td><?php the_field('va-crew') ?></td></tr><tr><td><?php _e('Engine','ds'); ?></td><td><?php the_field('va-engine') ?></td></tr></table></div>
				<div class="single-vacancies-job-item"><h2><?php _e('Requirements','ds'); ?></h2><table border="0" class="single-vacancies-job-item-inner"><tr><td><?php _e('Nationality','ds'); ?></td><td><?php the_field('va-nationality') ?></td></tr><tr><td><?php _e('Age limit','ds'); ?></td><td><?php the_field('va-age') ?></td></tr><tr><td><?php _e('English (TOSE)','ds'); ?></td><td><?php the_field('va-tose') ?></td></tr><tr><td>US VISA</td><td><?php the_field('va-us') ?></td></tr><tr><td><?php _e('Marlins','ds'); ?></td><td><?php the_field('va-marlins') ?></td></tr><tr><td><?php _e('CV for a seagoing','ds'); ?></td><td><a href="mailto:<?php the_field('va-cv') ?>"><?php the_field('va-cv') ?></a></td></tr></table></div>
				<div class="single-vacancies-job-copy"><button id="copyButton"><span><?php _e('Copy Link','ds'); ?></span><input id="copyTarget" value="<?php echo get_permalink(); ?>" type="text"></button></div>
			</div></div>
			<div class="single-vacancies-form-block"><div class="single-vacancies-form-inner"><h2 class="single-vacancies-form-title"><?php _e('APPLY FOR THIS JOB','ds'); ?></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php echo do_shortcode('[contact-form-7 id="1168" title="Single Vacancy" html_id="feedback-form1" html_class="feedback-form placeholder_dark"]') ?>
				<?php endwhile; ?><?php endif; ?>
			</div></div>
		</div></div>

	</main>

	<footer class="footer-wrap wraper-100"><div class="footer-block wraper-1240"><div class="breadcrumbs"><ul itemscope itemtype="http://schema.org/BreadcrumbList"><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="<?php _e('/','ds'); ?>"><span itemprop="name">Marine MAN</span><meta itemprop="position" content="0"></a></span></li>
		<?php 
		$category = get_the_category(); 
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span><a itemprop="item" href="'.get_category_link($category[0]->cat_ID).'"><span itemprop="name">'.get_cat_name($category[0]->cat_ID).'</span><meta itemprop="position" content="1"></a></span></li>';
		?>
		<li><span><span><?php the_title(); ?></span></span></li></ul></div><?php include 'footer.php';?></div></footer><?php include 'footer-after.php';?>

	</div>

	<script src="<?php bloginfo('template_directory'); ?>/scripts/nav.jquery.min.js"></script>
	<script>
		document.getElementById("copyButton").addEventListener("click",function(){copyToClipboard(document.getElementById("copyTarget"))});
		function copyToClipboard(elem){var targetId="_hiddenCopyText_";var isInput=elem.tagName==="INPUT"||elem.tagName==="TEXTAREA";var origSelectionStart,origSelectionEnd;if(isInput){target=elem;origSelectionStart=elem.selectionStart;origSelectionEnd=elem.selectionEnd}else{target=document.getElementById(targetId);if(!target){var target=document.createElement("textarea");target.style.position="absolute";target.style.left="-9999px";target.style.top="0";target.id=targetId;document.body.appendChild(target)}target.textContent=elem.textContent}var currentFocus=document.activeElement;target.focus();target.setSelectionRange(0,target.value.length);var succeed;try{succeed=document.execCommand("copy")}catch(e){succeed=false}if(currentFocus&&typeof currentFocus.focus==="function"){currentFocus.focus()}if(isInput){elem.setSelectionRange(origSelectionStart,origSelectionEnd)}else{target.textContent=""}return succeed}
	</script>
	<script>$('#fileFF').change(function(){if($('html:lang(en)').length){if($(this).val()!='')$(this).prev().text('CV Added');else $(this).prev().text('Attach CV')}else if($('html:lang(ru)').length){if($(this).val()!='')$(this).prev().text('CV Добавлено');else $(this).prev().text('Прикрепть CV')}else if($('html:lang(pl)').length){if($(this).val()!='')$(this).prev().text('CV Dodany');else $(this).prev().text('Dołączać CV')}});</script>
	<script src="<?php bloginfo('template_directory'); ?>/scripts/my.js"></script>

	<?php wp_footer(); ?>
</body>
</html>