<?php

if (!function_exists('redirect_if')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  bool  $boolean
     * @param  string  $to
     */
    function redirect_if($boolean, $to)
    {
        if (!$boolean) {
            ob_start();
            header("Location: $to", false);
            ob_end_flush();
            exit();
        }
    }
}
