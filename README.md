# library-cache

PHP Cache

# 预加载文件
    ./composer.json

    "autoload": {
        "classmap": [
          "app/Libs/Cache"
        ],
    }
#   重新生成 autoload.php
    composer dumpautoload
#   注册缓存
    use \App\Libs\Cache\Cache as Cache;
    $cacheConfig = require_once __DIR__ . '/config/cache.php';
    Cache::register($cacheConfig);

#   快捷操作
- Cache::get();是默认的缓存对象,可以Cache::store切换不同的引擎
- Cache::store('file')->get(); 切换store
- File::get();文件缓存操作
- Redis::get();redis缓存操作

#   写入缓存
- Cache::put(key,value)
- Cache::store("file")->put(key,value)
- File::put(key,value)

# 支持原生对象方法调用

- Redis::lpush(key,value)

# 获取引擎的实例
- Cache::link();获取默认的引擎实例
- RCache::link('redis');获取redis引擎实例

# put 写入缓存
    //保存时间10分钟
    Cache::put('key', 'data', 10);
    Cache::put('key', function(){
        return 'abc';
    }, 10);

# get 获取缓存
Cache::get('key');

# remember 写入缓存
Cache::remember("key", 10, "data");

# forget 删除缓存
Cache::forget('key')

# flush 清除所有的缓存
Cache::flush()

