<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 10:01
 * desc:
 */

namespace Cache;


class CacheManager
{
    protected static $default_store = 'file';

    public static function __callStatic($name, $args)
    {
        $app = static::resolveFacadeInstance();
        return call_user_func_array(array($app, $name), $args);
    }

    /**
     * 获取实例
     * @param null $store
     * @return mixed
     */
    public static function link($store = null)
    {
        $store = is_null($store) ? static::$default_store : $store;
        $link  = self::store($store);
        return $link->getInstance();
    }

    /**
     * 选择不同引擎,默认file
     * @param $store
     * @return mixed
     */
    public static function store($store)
    {
        return static::resolveFacadeInstance($store);
    }

    /**
     * 实现化引擎
     * @param null $store
     * @return mixed
     */
    protected static function resolveFacadeInstance($store = null)
    {
        $store = $store == null ? static::$default_store : $store;
        return CacheContainer::make($store);
    }
}