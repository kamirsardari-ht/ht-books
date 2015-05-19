<?php
/*
Template Name: BookInfo Page
*/
get_header();
$BookId=get_query_var( 'BookId' );

//$BookId=(($BookID-14)/2)-5;
?>

 <div class="container">
      <div class="row">
        <div class="bar"></div>
        <div class="card-12">
            <div class="col-md-3 npl">
               <?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $BookId ) ) : ?>
							<div class="edd_download_image">
                <?php $new_feature_image = wp_get_attachment_url( get_post_thumbnail_id($BookId) );?>
								<!--a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"-->
									<?php //echo get_the_post_thumbnail( $BookId, 'thumbnail' ); ?>
                  <img src="<?php echo $new_feature_image;?>" width='300' height='auto'>
								<!--/a-->
							</div>
						<?php endif; ?>
            </div>
            <div class="col-md-9">
              <span class='tag'>subhead</span>
              <p><?php echo get_field( "book_published_date", $BookId );?></p>
              <p>
          		<div itemprop="description" class="edd_download_full_content">
  					<?php echo apply_filters( 'edd_downloads_content', get_post_field( 'post_content', $BookId ) ); ?>
  				</div>
              </p>
              <p>
              	<?php if ( ! edd_has_variable_prices( $BookId ) ) : ?>
        					<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        						<div itemprop="price" class="edd_price">
        							<?php //edd_price( $BookId ); ?>
        						</div>
        					</div>
				      <?php endif; ?>
              </p>
              <div class="col-md-5 npl">
                <!--button class="download"-->
                	<div class="edd_download_buy_button">
                     
                    
						<?php 
            //var_dump($edd_options);
            $edd_options["add_to_cart_text"]="Add pdf to Cart"; ?>
            <div class="col-md-12">
                <div class="card-5">
                  <?php echo edd_get_purchase_link( array( 'download_id' => $BookId ) ); ?>
                </div>
            </div>
            <div class="bar"></div>
            <?php $title=get_the_title( $BookId );
           
             $HCid=array();
                  $args = array(
                    'post_status' => array('publish'),
                    'post_type'  => 'download',
                    'download_category' => 'hard copy',
                    'posts_per_page' =>-1
                      );

                 
                   $HCpost = new WP_Query($args);
                 
                   while($HCpost->have_posts()) : $HCpost->the_post();
                          $ID=$post->ID;
                         $HCtitle=$post->post_title;
                         if($HCtitle==$title)
                           $HCid[]=$ID;    
                   endwhile;  
                   //var_dump($HCid);
                   $edd_options["add_to_cart_text"]="Add Hard copy to Cart"; ?>
                   <div class="col-md-12">
                      <div class="card-5">
                        <?php echo edd_get_purchase_link( array( 'download_id' => $HCid[0] ) ); ?>
                      </div>
                    </div>
                    <div class="bar"></div>
                    <?php 
                    $HCPDFid=array();
                    $args = array(
                      'post_status' => array('publish'),
                      'post_type'  => 'download',
                      'download_category' => 'pdf-hard-copy',
                      'posts_per_page' =>-1
                        );

                   $HCPDFpost = new WP_Query($args);
                 
                   while($HCPDFpost->have_posts()) : $HCPDFpost->the_post();
                          $ID=$post->ID;
                         $HCPDFtitle=$post->post_title;
                         if($HCPDFtitle==$title)
                           $HCPDFid[]=$ID;    
                   endwhile;

                    ?>
                    <div class="col-md-12">
                      <div class="card-5">
                        <a  class="button blue edd-submit" href="<?php echo get_field( "amazon_link", $BookId ); ?>">go to amazon</a>
                      </div>
                    </div>
                    <div class="bar"></div>
                    
					</div>
                <!--/button-->
              <?php //$BookID=get_the_ID();
              //$BookID=(($BookID+5)*2)+14;
              ?>
              </div>
            </div>
      </div>
      <div class="bar"></div>
      <div class="card-12">
            <div class="col-md-3 npl">
            </div>
            <?php
              $table_of_content=get_field( "table_of_contents", $BookId );
              $review=get_field( "reviews", $BookId );
            ?>
            <div class="col-md-9">
              <?php if(!empty($table_of_content)) {?>
             	  <h2>Table of Contents / More Info</h2>		
                <p>
                	<?php echo get_field( "table_of_contents", $BookId );?>
                </p>
              <?php } ?>
              <?php if(!empty($review)) {?>
                <h2>Reviews</h2>
                <p>
                	<?php echo get_field( "reviews", $BookId );?>
                </p>
              <?php } ?>
            </div>
      </div>
		  </div>
	</div>
<?php get_footer(); ?>