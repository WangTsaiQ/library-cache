<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 13:38
 * desc:
 */

namespace Cache;


class File extends CacheManager
{
    /**
     * 默认引擎
     * @var string
     */
    public static $default_store = 'file';
}