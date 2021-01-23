<?php

if ( ! function_exists('config_path'))
{
    
    if (!file_exists(app()->basePath() . '/config')) {
        mkdir(app()->basePath() . '/config', 0755, true);
    }
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}