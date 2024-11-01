<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $medical; 
$medical = new Opalmedical_Medical( get_the_ID() );
?>
<div class="doctor-social">
    <?php if( $medical->getMetaboxValue('facebook') ) : ?>
        <a href="<?php echo esc_url( $medical->getMetaboxValue('facebook') );?>" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <?php endif; ?>
    <?php if( $medical->getMetaboxValue('twitter') ) : ?>
        <a href="<?php echo esc_url( $medical->getMetaboxValue('twitter') );?>" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    <?php endif; ?>
    <?php if( $medical->getMetaboxValue('google') ) : ?>
        <a href="<?php echo esc_url( $medical ->getMetaboxValue('google') );?>" title="google"><i class="fa fa-google" aria-hidden="true"></i></a>
    <?php endif; ?>
    <?php if( $medical->getMetaboxValue('skype') ) : ?>
        <a href="<?php echo esc_url( $medical->getMetaboxValue('skype') );?>" title="youtube"><i class="fa fa-skype" aria-hidden="true"></i></a>
    <?php endif; ?>
    <?php if( $medical->getMetaboxValue('linkedin') ) : ?>
        <a href="<?php echo esc_url( $medical->getMetaboxValue('linkedin') );?>" title="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
    <?php endif; ?>
    <?php if( $medical->getMetaboxValue('pinterest') ) : ?>
        <a href="<?php echo esc_url( $medical->getMetaboxValue('pinterest') );?>" title="printrest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
    <?php endif; ?>
    <?php if( $medical->getMetaboxValue('youtube') ) : ?>
        <a href="<?php echo esc_url( $medical->getMetaboxValue('youtube') );?>" title="youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
    <?php endif; ?>
</div>