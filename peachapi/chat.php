<?php

namespace PeachAPI;

class chat extends client {
  
  /**
   *
   * Shows a list of the chats and their ids.
   * @return object An array of the chats and their ids.
   *
   */
  public function chats() {
    $params = array(
      'request' => '/chat',
      'payload' => '',
      'method' => 'GET'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Gets chat token.
   *
   * @return object The token for each chat action.
   *
   */
  public function token() {
    $params = array(
      'request' => '/chat/token',
      'payload' => '',
      'method' => 'GET'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Opens a chat and returns messages within the chat.
   *
   * @param $arg The id of the chat you'd like to open.
   *
   * @return object An array of data including users of the chat and messages within.
   *
   */
  public function chat($arg) {
    $params = array(
      'request' => '/chat/id/' . $arg,
      'payload' => '',
      'method' => 'GET'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Marks chat messages as read.
   *
   * @param $arg The id of the chat you'd like to mark as read.
   *
   * @return Does not return anything useful or needed aside from successful/failure message.
   *
   */
  public function read($arg) {
    $params = array(
      'request' => '/chat/id' . $arg . '/read',
      'payload' => '',
      'method' => 'PUT'
    );
    
    return $this->request($params);
  }
  
  // please use chat()
  public function get_chat($arg) {
    $params = array(
      'request' => '/stream/id/' . $arg . '/chat',
      'payload' => '',
      'method' => 'GET'
    );
    return $this->request($params);
  }
  
  // please do not call this function
  public function null_chat() {
    $params = array(
      'request' => '/chat/id/(null)/read',
      'payload' => '',
      'method' => 'PUT'
    );
    
    return $this->request($params);
  }
  
  
   /**
   *
   * Starts a new chat with a new user.
   *
   * @param $arg array
   *           [ id => your id ]
   *           [ target_id => id of who you want to start chat with ]
   *           [ type => (text or image) ]
   *           [ body => (message) ]
   * optional: [ image => array: (src) ]
   *
   * @return success or no success
   *
   */
  public function new_chat($arg) {
    $message = array();
    $message['message'][0] = (object) array('type' => 'text', 'text' => $arg['text']);
    // If post is text-based only
    if($arg['type'] == "text") {
      $message = array();
      $message['message'][0] = (object) array('text' => $arg['body'], 'type' => 'text');
    // If post contains image(s)
    } else if($arg['type'] == "image") {
      $message = array();
      foreach($arg['image'] as $img)
      {
        // Go through each image to be posted
        list($width, $height) = getimagesize($img);
        if(!$height || !$width) { return "You must post an image with a height and width."; }
        $message['message'][] = (object) array("height" => $height, "src" => $src, "type" => "image", "width" => $width);
      }
      if($arg['body']) { $message['message'][] = (object) array('text' => $arg['body'], 'type' => 'text'); } 
    }
    else {
      return "You need to input a proper type.";
    }
    $message['streamIDs'][] = $arg['id'];
    $message['streamIDs'][] = $arg['target_id'];
    $message['clientPostID'] = "";
    $params = array(
      'request' => '/chat',
      'payload' => $message,
      'method' => 'POST'
    );
    
    return $this->request($params);
  }
  
   /**
   *
   * Sends new message between the user token and the id specified.
   *
   * @param $arg array
   *           [ id => chat id ]
   *           [ type => (text or image) ]
   *           [ body => (message) ]
   * optional: [ image => array: (src) ]
   *
   * @return success or no success
   *
   */
  public function new_msg($arg) {
    // If post is text-based only
    if($arg['type'] == "text") {
      $message = array();
      $message['message'][0] = (object) array('$messageID' => '', '$isTail' => true, '$isFailTail' => true, 'text' => $arg['body'], 'type' => 'text');
    // If post contains image(s)
    } else if($arg['type'] == "image") {
      $message = array();
      foreach($arg['image'] as $img)
      {
        // Go through each image to be posted
        list($width, $height) = getimagesize($img);
        if(!$height || !$width) { return "You must post an image with a height and width."; }
        $message['message'][] = (object) array('$messageID' => '', '$isTail' => true, '$isFailTail' => true, "height" => $height, "src" => $src, "type" => "image", "width" => $width);
      }
      if($arg['body']) { $message['message'][] = (object) array('text' => $arg['body'], 'type' => 'text'); } 
    }
    else {
      return "You need to input a proper type.";
    }
    $message['clientPostID'][0] = (object) array('');
    $params = array(
      'request' => '/chat/id/' . $arg['id'],
      'payload' => $message,
      'method' => 'POST'
    );
    return $this->request($params);
  }
  
  /**
   *
   * Checks if chat exists.
   *
   * @param $arg id of chat to check
   *
   * @return true or false
   *
   */
   public function chat_exists($arg) {
     $foo = $this->chat($arg);
     $foo = (array) $foo;
     return ($foo['success']);
   }
      
}
  
  