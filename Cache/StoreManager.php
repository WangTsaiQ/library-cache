<?php
/**
 * User: Wangtsai
 * Date: 2021/4/8
 * time: 10:22
 * desc:
 */

namespace Cache;


abstract class StoreManager implements StoreInterface
{
    protected $app;
    protected $config=[];
    /**
     * 判断是否是匿名函数还是普通的值
     * @param $value
     * @return mixed
     */
    public function value($value)
    {
        return $value instanceof \Closure ? $value() : $value;
    }

    /**
     * igbinary serialize 序列化
     * @param $value mixed 支持匿名函数
     * @return string
     */
    public function serialize($value)
    {
        $value = $this->value($value);
        if (extension_loaded('igbinary')) {
            return igbinary_serialize($value);
        }
        return serialize($value);
    }

    /**
     * igbinary unserialize 解序列化
     * @param string $value 字符串
     * @return mixed
     */
    public function unserialize($value)
    {
        $value = $this->value($value);
        if (extension_loaded('igbinary')) {
            return igbinary_unserialize($value);
        }
        return unserialize($value);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->app, $name), $arguments);
    }

}