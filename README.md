# PeachAPI

PeachAPI, affectionately named PAPI, is a PHP Library created as the first unofficial API for the social media app called Peach. This library includes or will include most functions of the app that any developer may need for their own personal projects. I have hopefully created the easiest way for even the most beginner users to implement into their projects.

## Easy Setup

Setting up your project to work with PAPI is easy. Working with this library only takes a few steps to set up and once it is, you'll have full access to the library and it's components.

### Setting Up Account Token

You will need to create a new file called something like `auth.php` or similar that will contain information regarding your account or the user's account. In this file set up your information like the following:

```php
  $auth = array(
  
    'method' => 'login', // two options login or register, default: register
    'login' => array(
      'username' => '',
      'password' => ''
      //'name' => '' (add comma)
      // 'name' required if register
    )
   );
```

**`username`**: (required) In the value section, enter the username if you're logging in or desired username if you're registering.

**`password`**: (required) In the value section, enter the password if you're logging in or desired password if you're registering.

**`name`**: (optional) Only required if you plan to register. This is the display name of the user.

Now that you have the account information set up, let's implement the library. In another file, let's include the library itself.

```php
require 'peachapi.php';
require 'auth.php';

$api = new PeachAPI\peach($auth);
```

Now you're ready to go! Let's get into some functions.

## Functions

There are different categories I've separated the functions into depending on what each function does. You can look for more detailed documentation later but here's a quick rundown. **This is assuming you've set up your API similar to Quick Setup**

### Stream

#### Functions
```php
 public function user($username) {}
 public function get_user_id($username) {}
 public function follow($username) {}
 public function unfollow($username) {}
 public function followers($username) {}
 public function public_settings($arg) {}
 public function change_display($name) {}
 public function change_bio($arg) {}
 ```
 #### Usage
| Function  | Usage |
| ------------- | ------------- |
| user($username)  | $api->stream->user(string)  |
| get_user_id($username)  | $api->stream->get_user_id(string)  |
| follow($username)  | $api->stream->follow(string)  |
| unfollow($username)  | $api->stream->unfollow(string)  |
| followers($username) | $api->stream->followers(string) |
| public_settings($arg) | $api->stream->public_settings(boolean) |
| change_display($name) | $api->stream->change_display(string) |
| change_bio($arg) | $api->stream->change_bio(string) |

### Post

#### Functions
```php
public function activity() {}
public function post($arg) {}
public function comment($arg) {}
```

### Usage
| Function | Usage |
| ------------- | ------------- |
| activity() | $api->post->activity() |
| post($arg) | $api->post->post(array) |
| comment($arg) | $api->post->comment(array) |

**`post($arg)`**: The argument for this function depends on what you want to post. For example, if you're wanting to post just a text post, you would pass an array with the following structure:
```php
array(
   'type' => 'text',
   'body' => 'text of post'
)
```
Where the body is **required**. Versus posting an image, you would need the link to the image and would pass an array like this:
```php
array(
    'type' => 'image',
    'image' => array(image_url, image_url),
    'body' => 'text of post'
)
```
Where the body is **optional**.

**`comment($arg)`**: Array structure should be the following:
```php
array(
    'post_id' => post id,
    'body' => comment
)
```
