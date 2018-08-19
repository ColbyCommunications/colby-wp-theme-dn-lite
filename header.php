<?php
/**
 * Header.php
 *
 * @package colby/darenorthward
 */

?><!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, user-scalable=0" />
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico">

<?php wp_head(); ?>
<?php if ( is_front_page() || is_home() ) : ?>
<meta property="og:title" content="Dare Northward" />
<meta property="og:url" content="https://darenorthward.colby.edu" />
<meta property="twitter:site" content="@colbycollege" />
<meta property="og:image" content="https://darenorthward.colby.edu/wp-content/uploads/2017/10/ZFJF_3657zzz_CROP.jpg" />
<meta property="twitter:image" content="https://darenorthward.colby.edu/wp-content/uploads/2017/10/ZFJF_3657zzz_CROP.jpg" />
<?php endif; ?>

<title>
	<?php echo esc_html( wp_title( '|', true, 'right' ) ?: get_bloginfo( 'name' ) . ' |' ); ?> Colby College
</title>

<body class="<?php echo esc_attr( is_admin_bar_showing() ? 'admin-bar' : '' ); ?>">


<?php
/**
 * Fires just after the opening HTML body tag.
 */
do_action( 'darenorthward__start_body' );

/**
 * Fires just before the opening main tag.
 */
do_action( 'darenorthward__before_main' );

/**
 * Filters the classes applied to the main element.
 *
 * @var array
 */
$main_classes = apply_filters( 'darenorthward__main_class', [ 'main' ] );
?>

<div id="main-wrapper">
<main class="<?php echo esc_attr( implode( ' ', $main_classes ) ); ?>" role="main">
