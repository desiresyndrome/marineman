	<?php if(get_field('ts-slide', apply_filters( 'wpml_object_id', 10, 'page', TRUE))): ?><div class="gl-main-slider-wrap wraper-100"><div class="gl-main-slider"><?php while(the_repeater_field('ts-slide', apply_filters( 'wpml_object_id', 10, 'page', TRUE))): ?><div><div class="my-cover" style="background-image: url(<?php the_sub_field('ts-img'); ?>);"><div class="gl-main-slider-text wraper-1240"><p><?php the_sub_field('ts-text'); ?></p></div></div></div><?php endwhile; ?></div></div><?php endif; ?>