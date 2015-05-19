<?php
/*
Template Name: EBOOK Page
*/
get_header();

	 $downloads=array();
      $download_args = array(
      'post_status' => array('publish'),
      'post_type' => 'download',
      'posts_per_page' =>-1 );
       $downloadPosts = new WP_Query($download_args);
       while($downloadPosts->have_posts()) : $downloadPosts->the_post();    
          $Id=$post->ID;
          $downloads[]=$Id; ?>
          <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
			<div class="edd_download_image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
				</a>
			</div>
			<?php endif; ?>
			<div itemprop="description" class="edd_download_full_content">
				<?php echo apply_filters( 'edd_downloads_content', get_post_field( 'post_content', get_the_ID() ) ); ?>
			</div>

			<!--h3 itemprop="name" class="edd_download_title">
				<a title="<?php the_title_attribute(); ?>" itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3-->

			<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) : ?>
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<div itemprop="price" class="edd_price">
						<?php edd_price( get_the_ID() ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="edd_download_buy_button">
				<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
			</div>

	<?php endwhile; ?>

<?php get_footer(); ?>