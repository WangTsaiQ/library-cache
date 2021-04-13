<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 13:41
 * desc:
 */

namespace Cache;


class Redis extends CacheManager
{
    /**
     * 默认引擎
     * @var string
     */
    public static $default_store = 'redis';
}