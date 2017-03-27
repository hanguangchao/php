<?php

/**
 *
 * MsRedis:Redis yii封装
 * 使用原生Redis方法，主从自动切换
 * @version 1.0.1
 * @author <hanguangchao@gmail.com>
 * @date 2015-08-10
 * 配置
 *
 *   ```php
    'components' => array(
        'redis' => array(
            'class' => 'ext.redis.MsRedis',
            'masterConfig' => array(
                'hostname' => 'localhost',
                'port' => 6379,
            ),
            'slaveConfig' => array(
                'hostname' => '127.0.0.1',
                'port' => '6379',
            ),
            'prefix" => 'Yii.redis.'
        ),
    ),
 *   ```
 */
class MsRedis implements IApplicationComponent
{
    //Redis实例
    protected $_redis;
    protected $_redisMaster;
    //当前Redis是否为主
    protected $_master = false;
    //重连次数
    protected $_count = 3;
    //Redis Key前缀
    public $prefix = 'Yii.Redis.';
    public $masterConfig = array(
        'hostname' => '127.0.0.1',
        'port' => '6379',
    );
    public $slaveConfig = array(
        'hostname' => '127.0.0.1',
        'port' => '6379',
    );
    
    /**
     * 写操作函数标记
     */
    private $_setOperation = array(
        'append', 'getSet', 'SET','set', 'mset', 'msetnx', 'decr', 'decrBy', 'incr', 'incrBy','setex', #STRING#
        'rPush', 'lPush', 'lPushx', 'rPushx', 'lPop', 'lSet', 'lRemove', 'rPop', 'brPop', 'rpoplpush', #LIST#
        'hset','hMSet', 'hIncrBy', 'hDel', #HASH#
        'sRemove', 'sPop', 'sMove', 'sInterStore', 'sUnionStore', 'sDiffStore', 'sAdd', 'sRem', #SET#
        'zAdd', 'zDelete', 'zIncrBy', 'zDeleteRangeByRank', 'zDeleteRangeByScore','zRem','zRange'  #ZSET#
    );

    public function init()
    {
        $this->_initialized = true;
    }
    
    public function getIsInitialized()
    {
        return $this->_initialized;
    }
    
    //Redis原生操作，通过__call回调
    public function __call($name, $arguments)
    {
        if (extension_loaded('Redis') && method_exists('Redis', $name)) {
            //需要写库的，切换到主库
            if (in_array($name, $this->_setOperation)) {    
                if (null === $this->_redisMaster) {
                    $this->switchToMaster();
                }
                $result = call_user_func_array(array($this->_redisMaster, $name), $arguments);

            } else {
                if (null === $this->_redis) {
                    $this->switchToSlave();
                }
                $result = call_user_func_array(array($this->_redis, $name), $arguments);
            }
            
            return $result;
        }
    }
    
    private function switchToSlave()
    {
        $this->_master = false;
        $this->connect($this->slaveConfig);
    }
    
    private function switchToMaster()
    {
        $this->_master = true;
        $this->connect($this->masterConfig);
    }
    
    private function connect($serverConfig)
    {
        try {
            if (true === $this->_master) {      
                $this->_redisMaster = new Redis();
                $this->_redisMaster->connect($serverConfig['hostname'], $serverConfig['port']);
                $this->_redisMaster->auth($serverConfig['auth']);
                $this->_redisMaster->setOption(Redis::OPT_PREFIX, $this->prefix);
            } else {
                $this->_redis = new Redis();
                $this->_redis->connect($serverConfig['hostname'], $serverConfig['port']);
                $this->_redis->auth($serverConfig['auth']);
                $this->_redis->setOption(Redis::OPT_PREFIX, $this->prefix);
            }
            
        } catch (RedisException $e) {
            Yii::log($e->getMessage() . "\n---\n", CLogger::LEVEL_ERROR);
            //重连3次
            if($this->_count > 0){
                $this->_count--;
                $this->connect($serverConfig);
            }
            // throw new CException('redis connect exception.');
        }
    }
}
