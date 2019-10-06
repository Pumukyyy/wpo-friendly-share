<?php 
// Si se llama directamente a este archivo, aborta.
defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

function wfs_remove_options() {

  delete_option( 'wfs-share-custom-label' );
  delete_option( 'wfs-share-facebook' );
  delete_option( 'wfs-share-twitter-name' );
  delete_option( 'wfs-share-twitter' );
  delete_option( 'wfs-share-linkedin' );
  delete_option( 'wfs-share-buffer' );
  delete_option( 'wfs-share-pinterest'  );
  delete_option( 'wfs-share-whatsapp' );
  delete_option( 'wfs-share-email' );
  delete_option( 'wfs-share-instagram' );

  delete_option( 'wfs-follow-custom-label' );
  delete_option( 'wfs-follow-checkbox-facebook' );
  delete_option( 'wfs-follow-url-facebook' );
  delete_option( 'wfs-follow-checkbox-twitter' );
  delete_option( 'wfs-follow-url-twitter' );
  delete_option( 'wfs-follow-checkbox-linkedin' );
  delete_option( 'wfs-follow-url-linkedin' );
  delete_option( 'wfs-follow-checkbox-instagram' );
  delete_option( 'wfs-follow-url-instagram' );
  delete_option( 'wfs-follow-checkbox-youtube' );
  delete_option( 'wfs-follow-url-youtube' );
  delete_option( 'wfs-follow-checkbox-pinterest' );
  delete_option( 'wfs-follow-url-pinterest' );
  delete_option( 'wfs-follow-checkbox-myBusiness' );
  delete_option( 'wfs-follow-url-myBusiness' );

  delete_option( 'wfs-options-before-post' );
  delete_option( 'wfs-options-after-post' );
  delete_option( 'wfs-options-css' );
  delete_option( 'wfs-options-rel-nofollow' );
  delete_option( 'wfs-options-analytics' );
  delete_option( 'wfs-options-ga-gtag' );
  delete_option( 'wfs-options-delete-all' );

}