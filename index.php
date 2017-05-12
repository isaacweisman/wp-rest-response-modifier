<?php
/**
 * Plugin Name: REST Response Modifier
 * Description: A very simple plugin to modify the response of the wordpress REST API.
 * Author: Isaac Weisman
 * Author URI: https://github.com/isaacweisman
 */

 add_action( 'rest_api_init', 'iw_add_custom_rest_fields' );

 function iw_add_custom_rest_fields() {
   $iw_author_name_schema = array(
       'description'   => 'Name of the post author',
       'type'          => 'string',
       'context'       =>   array( 'view' )
   );

   register_rest_field(
       'post',
       'iw_author_name',
       array(
           'get_callback'      => 'iw_get_author_name',
           'update_callback'   => null,
           'schema'            => $iw_author_name_schema
       )
   );

  $iw_author_url_schema = array(
      'description'   => 'Url to the post author page',
      'type'          => 'string',
      'context'       =>   array( 'view' )
  );

  register_rest_field(
      'post',
      'iw_author_url',
      array(
          'get_callback'      => 'iw_get_author_url',
          'update_callback'   => null,
          'schema'            => $iw_author_url_schema
      )
  );

  $iw_category_schema = array(
      'description'   => 'The post category',
      'type'          => 'array',
      'context'       =>   array( 'view' )
  );

  register_rest_field(
      'post',
      'iw_category',
      array(
          'get_callback'      => 'iw_get_category',
          'update_callback'   => null,
          'schema'            => $iw_category_schema
      )
  );
}

function iw_get_author_name( $object, $field_name ) {
  return get_the_author_meta( 'display_name', $object['author'] );
}

function iw_get_author_url( $object ) {
  return get_author_posts_url( $object['author'] );
}

function iw_get_category() {
  $cat = get_the_category();
  return $cat[0];
}
