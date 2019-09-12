<?php

namespace PeachAPI;

class post extends client
{

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
    public function post(array $arg): object
    {

        $message = $this->helper->postHelper($arg);
        if (isset($message['error'])) {
            return (object)array("An error occurred.");
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
    public function comment(array $arg): object
    {
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
     * @param $arg string Post id of the post to like.
     *
     * @return object Returns obeject boolean whether the like was successfully sent.
     *
     */
    public function like(string $arg): object
    {
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
     * @param $arg string Post id of the post to unlike.
     *
     * @return object Returns obeject boolean whether the unlike was successfully sent.
     *
     */
    public function unlike(string $arg): object
    {
        $params = array(
            'request' => '/like/postID/' . $arg,
            'payload' => array('postId' => $arg),
            'method' => 'DELETE'
        );

        return $this->request($params);
    }

}

?>