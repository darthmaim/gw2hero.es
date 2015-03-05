<?php
return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		'Facebook' => [
			'client_id'     => env('OAUTH2_ID_FACEBOOK', ''),
			'client_secret' => env('OAUTH2_SECRET_FACEBOOK', ''),
			'scope'         => [],
		],

		'Github' => [
			'client_id'     => env('OAUTH2_ID_GITHUB', ''),
			'client_secret' => env('OAUTH2_SECRET_GITHUB', ''),
			'scope'         => [],
		],

		'Google' => [
			'client_id'     => env('OAUTH2_ID_GOOGLE', ''),
			'client_secret' => env('OAUTH2_SECRET_GOOGLE', ''),
			'scope'         => [],
		],

		'Guildwars2' => [
			'client_id'     => env('OAUTH2_ID_GUILDWARS2', ''),
			'client_secret' => env('OAUTH2_SECRET_GUILDWARS2', ''),
			'scope'         => [],
		],

		'Twitter' => [
			'client_id'     => env('OAUTH2_ID_TWITTER', ''),
			'client_secret' => env('OAUTH2_SECRET_TWITTER', ''),
			'scope'         => [],
		],

	]

];
