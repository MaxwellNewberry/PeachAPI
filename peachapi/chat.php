<?php

namespace PeachAPI;

class chat extends client
{

    /**
     *
     * Shows a list of the chats and their ids.
     * @return object An array of the chats and their ids.
     *
     */
    public function chats(): object
    {
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
    public function token(): object
    {
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
     * @param $arg int The id of the chat you'd like to open.
     *
     * @return object An array of data including users of the chat and messages within.
     *
     */
    public function chat(int $arg): object
    {
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
     * @param $arg int The id of the chat you'd like to mark as read.
     *
     * @return object Does not return anything useful or needed aside from successful/failure message.
     *
     */
    public function read(int $arg): object
    {
        $params = array(
            'request' => '/chat/id' . $arg . '/read',
            'payload' => '',
            'method' => 'PUT'
        );

        return $this->request($params);
    }

    // please use chat()
    public function getChat($arg): object
    {
        $params = array(
            'request' => '/stream/id/' . $arg . '/chat',
            'payload' => '',
            'method' => 'GET'
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
     * @return object Successfully created chat or no success.
     *
     */
    public function newChat(array $arg): object
    {

        $message = $this->helper->newChatHelper($arg);
        if (isset($message['error'])) {
            return (object)array("An error occurred.");
        }

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
     * @return object success or no success
     *
     */
    public function newMessage(array $arg): object
    {
        $message = $this->helper->chatHelper($arg);
        if (isset($message['error'])) {
            return (object)array("An error occurred.");
        }
        $message['clientPostID'][0] = (object)array('');

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
     * @param $arg int id of chat to check
     *
     * @return boolean true or false
     *
     */
    public function chatExists(int $arg): bool
    {
        $foo = $this->chat($arg);
        $foo = (array)$foo;
        return ($foo['success']);
    }

}
  
  