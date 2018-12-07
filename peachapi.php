<?php

namespace PeachAPI;

require 'peachapi/stream.php';
require 'peachapi/post.php';
require 'peachapi/chat.php';

class get_token {
  
  public $token = "";
  
  public function __construct($args)
  {
    return (($args['method']=='login') ? $this->login($args['login']['username'], $args['login']['password']) : $this->register($args['login']['username'], $args['login']['name'], $args['login']['password']));
  }
  
  public function request($args) {
    $ch = curl_init('https://v1.peachapi.com/' . $args['request']);
    curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($args['payload'])
    ));
    $execute = curl_exec($ch);
    curl_close($ch);
		$data = json_decode($execute);
		$login = (array) $data;
		$login = (array) $login['data'];
		$login = (array) $login['streams'];
		$login = (array) $login[0];
		if($data == false){ $this->token = NULL; } else { $this->token = $login['token']; }
  }
  
  public function login($email, $password) {
    $params = array(
      'payload' => array('email' => $email, 'password' => $password),
      'request' => 'login'
    );

    return $this->request($params);
  }

  public function register($email, $name, $password) {
    $params = array(
      'payload' => array('email' => $email, 'name' => $name, 'password' => $password),
      'request' => 'register'
    );

    return $this->request($params);
  }
  
}

class peach {
  public $follow, $post, $token;
  
  public function __construct($args) {
    $this->token = ((array) (new get_token($args)))['token'];
    if(isset($this->token)) {
      $this->stream = new stream($this->token);
      $this->post = new post($this->token);
      $this->chat = new chat($this->token);
		} else {
			die('You must include a user or application token');
		}
  }
}

class client {
	private $token = '';
	protected $url = 'https://v1.peachapi.com/';

	public function __construct($token) {
		$this->token = $token;
	}

	public function request($args) {
    $c_url = $this->url . $args['request'];
		$ch = curl_init($c_url);
		$authorization = "Authorization: Bearer " . $this->token . "";
		curl_setopt_array($ch, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $c_url,
        CURLOPT_CUSTOMREQUEST => $args['method'],
				CURLOPT_POSTFIELDS => json_encode($args['payload']),
				CURLOPT_HTTPHEADER => array('Content-Type: application/json' , $authorization) 
		));
		$execute = curl_exec($ch);
		curl_close($ch);
		$execute = json_decode($execute);
		return $execute;
	}
}
?>