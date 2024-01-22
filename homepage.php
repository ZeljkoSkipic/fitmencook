<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 */

get_header();

?>

<?php get_template_part('template-parts/homepage/hero'); ?>

<?php get_template_part('template-parts/homepage/latest-blog'); ?>

<?php get_template_part('template-parts/homepage/featured-products'); ?>

<?php get_template_part('template-parts/homepage/featured-logos'); ?>

<?php get_template_part('template-parts/homepage/featured-recipes'); ?>

<?php get_template_part('template-parts/newsletter'); ?>

<div class="atm-ad-slot" data-slot-type="middleboard-ad"></div> <!-- Home AD 2 -->

<?php get_template_part('template-parts/app'); ?>

<?php get_footer(); ?>
