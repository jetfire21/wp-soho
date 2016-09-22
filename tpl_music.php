<?php
/*
Template Name: Music
*/

 // page /music/ 

get_header(); 

$prefix = "movie_";

global $wpdb;
$wpdb->fer_table_name = $wpdb->prefix .  "spotify_api_music";


$tracks = $wpdb->get_results("SELECT * FROM $wpdb->fer_table_name", ARRAY_A);
var_dump($tracks);
print_r($tracks);
if( !empty( $tracks[0]['track_name'] )) echo "is tracks!";
else echo "no";


?>

