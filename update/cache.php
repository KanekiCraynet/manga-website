<?php

function __set_my_cache($key, $value = null, $group = "tukutema_cache", $expires = 120)
{
    return wp_cache_set($key, $value, $group, $expires);
}

function __get_my_cache($key, $group = "tukutema_cache")
{
    return wp_cache_get($key, $group);
}
