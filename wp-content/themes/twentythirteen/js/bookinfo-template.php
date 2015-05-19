<?php
/*
Template Name: BookInfo Page
*/
get_header();?>

 <div class="container">
      <div class="row">
        <div class="bar"></div>
        <div class="card-12">
            <div class="col-md-3 npl">
               <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( 8 ) ) : ?>
							<div class="edd_download_image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php echo get_the_post_thumbnail( 8, 'thumbnail' ); ?>
								</a>
							</div>
						<?php endif; ?>
            </div>
            <div class="col-md-9">
              <span class='tag'>subhead</span>
              <p>December 1, 2014</p>
              <p>
          		<div itemprop="description" class="edd_download_full_content">
  					<?php echo apply_filters( 'edd_downloads_content', get_post_field( 'post_content', 8 ) ); ?>
  				</div>
              </p>
              <div class="col-md-5 npl">
                <!--button class="download"-->
                	<div class="edd_download_buy_button">
						<div id='download'><?php echo edd_get_purchase_link( array( 'download_id' => 8 ) ); ?></div>
					</div>
                <!--/button-->
              <?php //$BookID=get_the_ID();
              //$BookID=(($BookID+5)*2)+14;
              ?>
              </div>
            </div>
      </div>
      <div class="bar"></div>
		  </div>
	</div>
<?php get_footer(); ?>