<?

namespace PeachAPI;

class stream extends client {
  
  /* user information functions */
  
  /**
   * Generates user information.
   *
   * @param $username string The username of the user you're getting info on.
   *
   * @return object Returns object array of user data.
   *
   */
  public function user($username) {
    $params = array(
      'request' => '/stream/n/' . $username,
      'payload' => '',
      'method' => 'GET'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Generates the user's id based off the given username.
   *
   * @param $username string The username of the user you want the id you're retreiving. 
   *
   * @return int The id the requested user.
   *
   */
  public function get_user_id($username) {
    return ((array) ( (array) $this->user($username) )['data'])['id'];
  }
 
  /* user action functions */
  
  /**
   *
   * Follows a user.
   *
   * @param $username string The username of the user you want to follow.
   *
   * @return object Returns in object boolean whether follow was successful.
   */
   public function follow($username) {
     $params = array(
       'request' => "stream/n/{$username}/connection",
       'payload' => '',
       'method' => 'POST'
     );
     
     return $this->request($params);
   }
  
  /**
   *
   * Unfollows a user.
   *
   * @param $username string The username of the user you want to unfollow.
   *
   * @return object Returns in object boolean whether unfollow was successful.
   *
   */
  public function unfollow($username) {
    $username = $this->get_user_id($username);
    $params = array(
       'request' => "stream/id/{$username}/connection",
       'payload' => '',
       'method' => 'DELETE'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Retrieves array of followers.
   *
   * @param $username string The username you want to get the list of followers of.
   *
   * @return object Returns object array of requested user's followers (limit: 500).
   *
   */
  public function followers($username) {
    $params = array(
      'request' => "/stream/n/{$username}/connections",
      'payload' => '',
      'method' => 'GET'
    );
    
    return $this->request($params);
  }
  
  /* settings */
  
  /**
   *
   * Changes user's privacy settings to either public or private.
   *
   * @param $arg boolean True sets the user to private, false sets to public.
   *
   * @return object Returns object boolean whether the setting change was successful.
   *
   */
  public function public_settings($arg) {
    $params = array(
      'request' => '/stream/visibility',
      'payload' => array('friendsOnly' => $arg),
      'method' => 'POST'
    );
  }
  
  /**
   *
   * Changes user's display name.
   *
   * @param $name string The new display name for the user.
   *
   * @return object Returns object boolean whether the setting change was successful.
   *
   */
  public function change_display($name) {
    $params = array(
      'request' => '/stream/displayName',
      'payload' => array('displayName' => $name),
      'method' => 'PUT'
    );
    
    return $this->request($params);
  }
  
  /**
   *
   * Changes user's biography.
   *
   * @param $arg string The new bio for the user.
   *
   * @return object Returns object boolean whether the setting change was successful.
   *
   */
  public function change_bio($arg) {
    $params = array(
      'request' => '/stream/bio',
      'payload' => array('bio' => $arg),
      'method' => 'PUT'
    );
    
    return $this->request($params);
  }
}