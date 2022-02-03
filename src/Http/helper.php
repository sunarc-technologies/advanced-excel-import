<?php

if (!function_exists('redirect_if')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  bool  $boolean
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function redirect_if($boolean, $to = null, $status = 302, $headers = [], $secure = null)
    {
        if ($boolean) {
            if (is_null($to)) {
                return app('redirect');
            }

            return app('redirect')->to($to, $status, $headers, $secure);
        }
    }
}
