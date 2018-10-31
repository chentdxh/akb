<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 15/11/4
 * Time: 下午7:55
 */



if (! function_exists('_T')) {
    /**
     * Translate the given message.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    function _T($id,$default="",$pack="lang")
    {
        if (empty($id))
        {
            return $default;
        }
        $trans = app('translator')->trans($pack.".".$id);

        if (substr($trans,0,5) == "lang.")
        {
            return   $id;
        } else
        {
            return $trans;
        }
    }
}




if (!function_exists('_JOIN_PATH')) {
    function _JOIN_PATH()
    {
        $args = func_get_args();
        $paths = array();
        $i = 0;
        foreach ($args as $arg) {


            if ($i > 0 )
            {
                $arg = trim($arg,"/");
            }

            if (!empty($arg))
            {
                $paths = array_merge($paths, (array)$arg);
            }

            $i ++;
        }
        $paths = array_map(function($p){
            return rtrim($p, "/");
        },$paths);

       // $paths = array_map(create_function('$p', 'return rtrim($p, "/");'), $paths);
        $paths = array_filter($paths);
        return join('/', $paths);
    }
}

