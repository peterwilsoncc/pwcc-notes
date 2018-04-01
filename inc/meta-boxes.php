<?php
/**
 * PWCC Notes.
 *
 * @package     PWCCNotes
 * @author      Peter Wilson
 * @copyright   2018 Peter Wilson
 * @license     GPL-2.0+
 */

namespace PWCC\Notes\MetaBoxes;

/**
 * Bootstrap Metabox configuration.
 *
 * Runs on same hook as `PWCC\Notes\bootstrap()`.
 */
function bootstrap() {
	add_filter( 'cmb_meta_boxes', __NAMESPACE__ . '\\register_meta_boxes' );
}

/**
 * Register meta boxes using CMB2.
 *
 * Runs on the `cmb_meta_boxes` hook.
 *
 * @param array $meta_boxes Registered meta boxes.
 * @return array Modified meta boxes.
 */
function register_meta_boxes( array $meta_boxes ) {
	$twitter_fields = [
		[
			'id'    => 'text',
			'name'  => 'Text',
			'type'  => 'textarea',
			'rows'  => '3',
			'class' => 'pwccindieweb-note-text',
		],
		[
			'id'      => 'post_on_twitter',
			'name'    => 'Post on twitter',
			'type'    => 'radio',
			'options' => [
				'1'  => 'Yes',
				'no' => 'No',
			],
			'cols'    => '6',
			'default' => '1',
			'class'   => 'pwccindieweb-note-post-on-twitter',
		],
		[
			'id'      => 'append_url',
			'name'    => 'Append URL to post',
			'type'    => 'radio',
			'options' => [
				'1'  => 'Yes',
				'no' => 'No',
			],
			'default' => 'no',
			'cols'    => '6',
			'class'   => 'pwccindieweb-note-append-url',
		],
		[
			'id'             => 'images',
			'name'           => 'Images to include',
			'type'           => 'image',
			'class'          => 'pwccindieweb-note-images',
			'repeatable'     => true,
			'repeatable_max' => 4,
		],
	];

	$fields = [
		[
			'id'         => '_pwccindieweb-note',
			'desc'       => 'Post to Twitter',
			'name'       => 'Twitter',
			'type'       => 'group',
			'class'      => 'pwccindieweb-twitter',
			'repeatable' => false,
			'fields'     => $twitter_fields,
		],
	];

	$meta_boxes[] = [
		'id'       => 'pwccindieweb_notes_metabox',
		'title'    => 'Notes',
		'pages'    => [ 'post', 'page', 'pwcc_notes' ],
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => $fields,
	];

	return $meta_boxes;
}
