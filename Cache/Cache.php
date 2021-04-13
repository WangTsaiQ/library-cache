<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 9:53
 * desc:
 */

namespace Cache;


class Cache extends CacheManager
{
    /**
     * 默认引擎
     * @var string
     */
    public static $default_store = 'file';

    /**
     * 注册服务
     * @param array $config
     */
    public static function register($config)
    {
        if (isset($config['default'])) {
            self::$default_store = $config['default'];
        }
        self::registerFile($config);
        self::registerRedis($config);
    }

    /**
     * 注册文件缓存
     * @param $config
     * @throws \Exception
     */
    public static function registerFile($config)
    {
        $engine = 'file';
        if (!isset($config[$engine])) {
            throw new \Exception('未配置' . $engine);
        }
        $config = $config[$engine];
        CacheContainer::bind($engine, function () use ($config) {
            return new FileStore($config);
        });
    }

    /**
     * 注册redis
     * @param $config
     * @throws \Exception
     */
    public static function registerRedis($config)
    {
        $engine = 'redis';
        if (!isset($config[$engine])) {
            throw new \Exception('未配置' . $engine);
        }
        $config = $config[$engine];
        CacheContainer::bind($engine, function () use ($config) {
            return new RedisStore(RedisConnect::getInstance($config), $config);
        });
    }
}