<?php

/**
 * This allow the specification of validator, both accessible in php & js.
 * Fields must be set mass assignable in the corresponding model.
 */
return [

	'ad'      => [
		'title'              => [
			'required' => true,
			'min'      => 0,
			'max'      => 80,
		],
		'category_id'        => [
			'categories' => true,
			'required'   => true,
			'class'      => 'ui selection dropdown',
		],
		'place'              => [
			'required' => true,
			'min'      => 0,
			'max'      => 40,
		],
		'description'        => [
			'required' => true,
			'min'      => 0,
			'max'      => 500,
		],

		'starts_at'          => [
			'required' => true,
			'readOnly' => true,
			'class'    => 'datepicker date',
		],
		'ends_at'            => [
			'readOnly' => true,
			'class'    => 'datepicker date',
		],
		'duration'           => [
			'required' => true,
		],
		'salary'             => [
			'required' => true,
			'min'      => 0,
			'max'      => 40,
		],
		'skills'             => [
			'min' => 0,
			'max' => 80,
		],
		'languages'          => [
			'min' => 0,
			'max' => 40,
		],

		'contact_first_name' => [
			'required' => true,
			'min'      => 0,
			'max'      => 40,
		],
		'contact_last_name'  => [
			'required' => true,
			'min'      => 0,
			'max'      => 40,
		],
		'contact_email'      => [
			'required' => true,
			'email'    => true,
			'min'      => 0,
			'max'      => 100,
		],
		'contact_phone'      => [
			'min' => 0,
			'max' => 50,
		],
		'section_ids'  						=> [
		]
	],

	'contact' => [
		'first_name' => [
			'required' => true,
			'min'      => 0,
			'max'      => 40,
		],
		'last_name'  => [
			'required' => true,
			'min'      => 0,
			'max'      => 40,
		],
		'email'      => [
			'required' => true,
			'min'      => 0,
			'max'      => 100,
		],
		'message'    => [
			'required' => true,
			'min'      => 0,
			'max'      => 1500,
		],
	],

];
