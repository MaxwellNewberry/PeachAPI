<?php

namespace PeachAPI;

class stream extends client
{

    /* user information functions */

    /**
     *
     * Gets a list of notifications by the currently logged in user.
     *
     * @return object Returns object array of the user's post (limit 500).
     *
     */
    public function activity(): object
    {
        $params = array(
            'request' => '/activity/',
            'payload' => '',
            'method' => 'GET'
        );

        return $this->request($params);
    }

    /**
     * Generates user information.
     *
     * @param $username string The username of the user you're getting info on.
     *
     * @return object Returns object array of user data.
     *
     */
    public function user(string $username): object
    {
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
     * @return string The id the requested user.
     *
     */
    public function getUserID(string $username): string
    {
        return ((array)((array)$this->user($username))['data'])['id'];
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
    public function follow(string $username): object
    {
        $params = array(
            'request' => "stream/n/{$username}/connection",
            'payload' => '',
            'method' => 'POST'
        );

        return $this->request($params);
    }

    /**
     *
     * Unfollow a user.
     *
     * @param $username string The username of the user you want to unfollow.
     *
     * @return object Returns in object boolean whether unfollow was successful.
     *
     */
    public function unfollow(string $username): object
    {
        $username = $this->getUserID($username);
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
    public function followers(string $username): object
    {
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
    public function publicSettings(bool $arg): object
    {
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
    public function changeDisplay(string $name): object
    {
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
    public function changeBio(string $arg): object
    {
        $params = array(
            'request' => '/stream/bio',
            'payload' => array('bio' => $arg),
            'method' => 'PUT'
        );

        return $this->request($params);
    }

    /**
     *
     * Favorite a user to your top users.
     *
     * @param $username string The username you want to favorite.
     *
     * @return object Returns object boolean whether or not the user was favorited.
     *
     */
    public function favorite(string $username): object
    {
        $uid = $this->getUserID($username);
        $params = array(
            'request' => '/stream/id/' . $uid . '/favorite',
            'payload' => '',
            'method' => 'POST'
        );

        return $this->request($params);
    }

    /**
     *
     * Unfavorites a user to your top users.
     *
     * @param $username string The username you want to unfavorite.
     *
     * @return object Returns object boolean whether or not the user was unfavorited.
     *
     */
    public function unfavorite(string $username): object
    {
        $uid = $this->getUserID($username);
        $params = array(
            'request' => '/stream/id/' . $uid . '/favorite',
            'payload' => '',
            'method' => 'DELETE'
        );

        return $this->request($params);
    }


}