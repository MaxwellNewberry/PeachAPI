<?php

namespace PeachAPI;

class helper
{

    function postHelper(array $arg): array
    {
        if ($arg['type'] == "text") {
            $message = array();
            $message['message'][0] = (object)array('text' => $arg['body'], 'type' => 'text');
            // If post contains image(s)
        } else if ($arg['type'] == "image") {
            $message = array();
            foreach ($arg['image'] as $img) {
                // Go through each image to be posted
                list($width, $height) = getimagesize($img);
                if (!$height || !$width) {
                    $message['error'] = !0;
                }
                $message['message'][] = (object)array("height" => $height, "src" => $arg['src'], "type" => "image", "width" => $width);
            }
            if ($arg['body']) {
                $message['message'][] = (object)array('text' => $arg['body'], 'type' => 'text');
            }
        } else {
            $message['error'] = !0;
        }

        return $message;
    }

    function newChatHelper(array $arg): array
    {
        $message = array();
        $message['message'][0] = (object)array('type' => 'text', 'text' => $arg['text']);
        // If post is text-based only
        if ($arg['type'] == "text") {
            $message = array();
            $message['message'][0] = (object)array('text' => $arg['body'], 'type' => 'text');
            // If post contains image(s)
        } else if ($arg['type'] == "image") {
            $message = array();
            foreach ($arg['image'] as $img) {
                // Go through each image to be posted
                list($width, $height) = getimagesize($img);
                if (!$height || !$width) {
                    $message['error'] = !0;
                }
                $message['message'][] = (object)array("height" => $height, "src" => $arg['image'], "type" => "image", "width" => $width);
            }
            if ($arg['body']) {
                $message['message'][] = (object)array('text' => $arg['body'], 'type' => 'text');
            }
        } else {
            $message['error'] = !0;
        }

        $message['streamIDs'][] = $arg['id'];
        $message['streamIDs'][] = $arg['target_id'];
        $message['clientPostID'] = "";
        return $message;
    }

    function chatHelper(array $arg): array
    {
        if ($arg['type'] == "text") {
            $message = array();
            $message['message'][0] = (object)array('$messageID' => '', '$isTail' => true, '$isFailTail' => true, 'text' => $arg['body'], 'type' => 'text');
            // If post contains image(s)
        } else if ($arg['type'] == "image") {
            $message = array();
            foreach ($arg['image'] as $img) {
                // Go through each image to be posted
                list($width, $height) = getimagesize($img);
                if (!$height || !$width) {
                    $message['error'] = !0;
                }
                $message['message'][] = (object)array('$messageID' => '', '$isTail' => true, '$isFailTail' => true, "height" => $height, "src" => $src, "type" => "image", "width" => $width);
            }
            if ($arg['body']) {
                $message['message'][] = (object)array('text' => $arg['body'], 'type' => 'text');
            }
        } else {
            $message['error'] = !0;
        }

        return $message;
    }

}