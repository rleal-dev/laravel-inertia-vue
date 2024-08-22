<?php

if (! function_exists('uploads_path')) {
    function uploads_path(string $path = '')
    {
        return asset('storage/' . $path);
    }
}
