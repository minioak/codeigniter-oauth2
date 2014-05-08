<?php
/**
 * Foursquare OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Shootproof extends OAuth2_Provider
{  
	public $method = 'POST';
	
	protected $scope_seperator = ' ';

	public function url_authorize()
	{
		return 'https://auth.shootproof.com/oauth2/authorization/new';
	}

	public function url_access_token()
	{
		return 'https://auth.shootproof.com/oauth2/authorization/token';
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://api.shootproof.com/v2?'.http_build_query(array(
			'method' => 'sp.studio.info',
			'access_token' => $token->access_token,
		));

		$response = json_decode(file_get_contents($url));
		
		// Create a response from the request
		return array(
			'uid' => '98765433',
			//'nickname' => $user->login,
			'name' => $response->name
		);
	}
}