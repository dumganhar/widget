<?php

namespace WidgetTest;

class MemcacheTest extends CacheTestCase
{
    public function setUp()
    {
        if (!extension_loaded('memcache') || !class_exists('\Memcache')) {
            $this->markTestSkipped('The memcache extension is not loaded');
        }

        parent::setUp();

        if (false === @$this->object->getObject()->getStats()) {
            $this->markTestSkipped('The memcache is not running');
        }
    }

    public function testGetAndSetObject()
    {
        $cache = $this->object;
        $memcache = $cache->getObject();

        $this->assertInstanceOf('\Memcache', $memcache);

        $cache->setObject($memcache);

        $this->assertInstanceOf('\Memcache', $cache->getObject());
    }

    public function testCustomServer()
    {
        $this->widget->setConfig(array(
            'test.memcache' => array(
                'servers' => array(
                    array(
                        'host'          => 'localhost',
                        'port'          => 11211,
                        'persistent'    => true
                    )
                )
            )
        ));

        $this->assertInstanceOf('\Widget\Memcache', $this->widget->testMemcache);
    }

    public function testGetMemcacheObject()
    {
        $this->assertInstanceOf('Memcache', $this->memcache());
    }
}