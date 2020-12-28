<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\LineService;

class LoginController extends Controller {
	protected $lineService;

	public function __construct(LineService $lineService) {
		$this->lineService = $lineService;
	}

	public function pageLine() {
		$url = $this->lineService->getLoginBaseUrl();
		// public function getLoginBaseUrl() {
		// 	// 組成 Line Login Url
		// 	$url = config('line.authorize_base_url') . '?';
		// 	$url .= 'response_type=code';
		// 	$url .= '&client_id=' . config('line.channel_id');
		// 	$url .= '&redirect_uri=' . config('app.url') . '/callback/login';
		// 	$url .= '&state=test'; // 暫時固定方便測試
		// 	$url .= '&scope=openid%20profile';
		// 	return $url;
		// }

		return view('line')->with('url', $url);
	}

	public function lineLoginCallBack(Request $request) {
		try {
			$error = $request->input('error', false);
			if ($error) {
				throw new Exception($request->all());
			}
			$code = $request->input('code', '');
			$response = $this->lineService->getLineToken($code);
			// public function getLineToken($code) {
			// 	$client = new Client();
			// 	$response = $client->request('POST', config('line.get_token_url'), [
			// 		'form_params' => [
			// 			'grant_type' => 'authorization_code',
			// 			'code' => $code,
			// 			'redirect_uri' => config('app.url') . '/callback/login',
			// 			'client_id' => config('line.channel_id'),
			// 			'client_secret' => config('line.secret')
			// 		]
			// 	]);
			// 	return json_decode($response->getBody()->getContents(), true);
			// }

			$user_profile = $this->lineService->getUserProfile($response['access_token']);
			// public function getUserProfile($token) {
			// 	$client = new Client();
			// 	$headers = [
			// 		'Authorization' => 'Bearer ' . $token,
			// 		'Accept' => 'application/json',
			// 	];
			// 	$response = $client->request('GET', config('line.get_user_profile_url'), [
			// 		'headers' => $headers
			// 	]);
			// 	return json_decode($response->getBody()->getContents(), true);
			// }
			echo '<pre>';
			print_r($user_profile);
			echo '</pre>';
		} catch (Exception $ex) {
			Log::error($ex);
		}
	}
}
