<?php

function is_home($action) {
    if(isset($_GET['url'])) {
        $url =  explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

        if($url[0] == "home") {
            if(isset($action)) {
                if($url[1] == $action) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}