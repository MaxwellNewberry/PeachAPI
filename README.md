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

* [Stream Function documentation](https://github.com/MaxwellNewberry/PeachAPI/wiki/Stream-Functions)
* [Post Function documentation](https://github.com/MaxwellNewberry/PeachAPI/wiki/Post-Functions)

