<?php
require_once dirname(__FILE__) . '/../../../libs/Qwin.php';
require_once dirname(__FILE__) . '/../../../libs/Qwin/Widget.php';

/**
 * Test class for Qwin_Widget.
 * Generated by PHPUnit on 2012-01-17 at 09:41:11.
 */
class Qwin_WidgetTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Qwin_Widget
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Qwin_Widget;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     * @covers Qwin_Widget::__construct
     */
    public function test__construct() {
        // self
        $object = new Qwin_Widget('source');
        
        $this->assertEquals('source', $object->source);
        
        // for code cover
        $object = new Qwin_Get('option');
        
        $object2 = new Qwin_Get(array('option'));
        
        $object2->options = 'string';
        $object2->__construct('new string');
    }

    /**
     * @covers Qwin_Widget::option
     */
    public function testOption() {
         // clean all option
        $this->object->option(array());
        $this->assertEquals(array(), $this->object->option(), 'Option is empty');
        
        $this->object->option('key', 'value');
        $this->assertEquals('value', $this->object->option('key'), 'get option "key"');
        
        $this->object->option('key2', array('value'));
        $this->assertEquals(array(
            'key' => 'value',
            'key2' => array('value'),
        ), $this->object->option(), 'get all options');
        
        $this->assertEquals(null, $this->object->option(new stdClass()));
        
    }

    /**
     * @covers Qwin_Widget::__call
     */
    public function test__call() {
        $name = $this->object->get('name');
        
        $get = new Qwin_Get();
        $name2 = $get->call('name');

        $this->assertEquals($name2, $name);
    }

    /**
     * @covers Qwin_Widget::__get
     */
    public function test__get() {
        $get = $this->object->get;
        
        $this->assertEquals('Qwin_Get', get_class($get), 'widget "get" found.');
    }

    /**
     * @covers Qwin_Widget::__toString
     */
    public function test__toString() {
        $this->object->source = 'source';
        
        $this->assertEquals('source', $this->object->__toString());
    }

} 