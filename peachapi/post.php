<?php

namespace PeachAPI;

class post extends client {
  
  /**
   *
   * Gets a list of notifications by the currently logged in user.
   *
   * @return object Returns object array of the user's post (limit 500).
   *
   */
  public function activity() {
    $params = array(
      'request' => '/activity/',
      'payload' => '',
      'method' => 'GET'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Posts to the currently logged in user.
   *
   * @param $arg array 
   *           [type => (text or image)]
   *           [body => (message)]
   * optional: [image => array: (src)]
   *
   * @return object Returns boolean object whether post was successful.
   *
   */
  public function post($arg) {
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
   
    $params = array(
      'request' => '/post',
      'payload' => $message,
      'method' => 'POST'
    );
    return $this->request($params);
  }
  
  /**
   *
   * Comments on specified post.
   *
   * @param $arg array
   *          [post_id => post id]
   *          [body => comment body]
   *
   * @return object Returns obeject boolean whether the comment was successfully sent.
   *
   */
  public function comment($arg) {
    $params = array(
      'request' => '/comment/',
      'payload' => array('postId' => $arg['post_id'], 'body' => $arg['body']),
      'method' => 'POST'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Likes a specified post.
   *
   * @param $arg unsigned Post id of the post to like.
   *
   * @return object Returns obeject boolean whether the like was successfully sent.
   *
   */
  public function like($arg) {
    $params = array(
      'request' => '/like/',
      'payload' => array('postId' => $arg),
      'method' => 'POST'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Unlikes a specified post.
   *
   * @param $arg unsigned Post id of the post to unlike.
   *
   * @return object Returns obeject boolean whether the unlike was successfully sent.
   *
   */
  public function unlike($arg) {
    $params = array(
      'request' => '/like/postID/' . $arg,
      'payload' => array('postId' => $arg),
      'method' => 'DELETE'
    );
    
    return $this->request($params);
  }
  
}

?>