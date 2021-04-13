<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 10:03
 * desc:
 */

namespace Cache;


class CacheContainer
{
    protected static $data;

    /**
     * 绑定缓存容器
     * @param $name
     * @param $resolver
     */
    public static function bind($name, $resolver)
    {
        static::$data[$name] = $resolver;
    }

    public static function make($name)
    {
        if (isset(static::$data[$name])) {
            $resolver = static::$data[$name];
            return $resolver();
        }
        throw new \Exception($name . '未注册');
    }
}