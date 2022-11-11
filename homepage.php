<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 */

get_header(); ?>

<?php get_template_part('template-parts/homepage/hero-search'); ?>

<?php get_template_part('template-parts/homepage/top-products'); ?>

<?php get_template_part('template-parts/newsletter'); ?>

<?php get_template_part('template-parts/homepage/featured-recipes'); ?>

<?php get_template_part('template-parts/homepage/featured-products'); ?>

<?php get_template_part('template-parts/homepage/latest-blog'); ?>

<?php get_template_part('template-parts/homepage/latest-ideas'); ?>


<?php get_footer(); ?>
