<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="hilltimes_favicon.png" type="image/x-icon">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hill Times Books</title>

    <!-- Bootstrap -->
    <link href="wp-content/themes/twentythirteen/css/bootstrap.css" rel="stylesheet">
    <link href="wp-content/themes/twentythirteen/css/custom_styles.css" rel="stylesheet">
    <link href="wp-content/themes/twentythirteen/css/edd.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Header Section -->
    <div class="top_bar">
      <?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
    </div>
    <div class="container">
      <div class="row header">
              <div class="col-md-5 col-sm-12 col-xs-12">
                <a href="http://www.hilltimes.com/HT-books/"><img src="wp-content/themes/twentythirteen/images/logo.png"/></a>
              </div>
              <div class="col-md-7 col-sm-12 col-xs-12 users">
                <?php
                  $current_user = wp_get_current_user();
                  if(!empty($current_user->user_login))
                  {
                  echo '<b>'.'Welcome, ' . $current_user->user_login . '</b>'; ?> &nbsp; &nbsp;
                  <a href="<?php echo wp_logout_url(); ?>">Logout</a>

                  <?php } ?>
                  <?php if ( !is_user_logged_in() ) {  ?> 

                  <a href="<?php echo get_page_link(73); ?>">Login </a>
                  <?php }?>
                  <!--a href="<?php echo wp_login_url( home_url() ); ?>" title="Login"><?php wp_login_form(); ?>Login</a-->
                  <a href="#">Contact Us </a>
                <!--a href="#">Search <img src="wp-content/themes/hilltimes-master/images/search-icon.png"/></a>
                <a href="#">Sections <img src="wp-content/themes/hilltimes-master/images/nav-icon.png"/> </a-->
              </div>
      </div>
      <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">About Hill Times Books</a></li>
            <li><a href="mailto:events@hilltimes.com?Subject=Contact%20Us" target="_top">Contact Us</a></li>
            <li><a href="#" target="_top">Your Books</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    </div>

    <!-- End Header -->
    <!-- Top Section -->
    