<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 10:26
 * desc:
 */

namespace Cache;


class RedisConnect
{
    protected static $link;

    /**
     * 单例
     * @param $config
     */
    public static function getInstance($config)
    {
        if (!self::$link instanceof \Redis) {
            self::$link = self::connect($config);
        }
        return self::$link;
    }

    /**
     * 连接
     * @param $config
     * @throws \Exception
     */
    protected static function connect($config)
    {
        if (!isset($config['host'])) {
            throw new \Exception('未设置host');
        }

        if (!extension_loaded('redis')) {
            throw new \Exception('Redis未安装');
        }
        $link = new \Redis();
        $bool = $link->connect($config['host'],$config['port']);

        if (isset($config['auth']) && $config['auth'] != '') {
            $link->auth($config['auth']);
        }
        if (!$bool || !$link->ping()) {
            throw new \Exception('Redis链接失败');
        }
        if (isset($config['preFix']) && $config['preFix'] != '') {
            $link->setOption(\Redis::OPT_PREFIX, $config['preFix']);
        }
        if (extension_loaded('igbinary') && defined('SERIALIZER_IGBINARY')) {
            $link->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_IGBINARY);
        }
        return $link;
    }
}