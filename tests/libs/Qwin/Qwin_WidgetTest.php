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
        // init Qwin
        Qwin::getInstance();

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
        $widget = new _WidgetTest;

        $widget->option('key2', array('value'));
        $this->assertEquals(array(
            'intValue' => 1,
            'mixedValue' => null,
            'key2' => array('value'),
        ), $widget->option(), 'get all options');

        $widget->option(array(
            'key1' => 'value1',
            'key2' => 'value2',
        ));
         $this->assertEquals('value1', $widget->option('key1'), 'set options be passed array and get option "key1"');


        $widget->option('key', 'value');
        $this->assertEquals('value', $widget->option('key'), 'get option "key"');

        $widget->option('intValue', 100);
        $this->assertEquals(100, $widget->option('intValue'), 'get value by getXxxOption method');

        $this->assertEquals(null, $widget->option(new stdClass()));

    }

    /**
     * @covers Qwin_Widget::source
     */
    public function testSource()
    {
        $widget = $this->object;

        $widget->source('string');

        $this->assertEquals('string', $widget->source(), 'get source');
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

    /**
     * @covers Qwin_Widget::__invoke
     */
    public function test__invoke() {
        $get = $this->object->get;

        $this->assertEquals($get->call('name'), $get->__invoke('name'));
    }
}

/**
 * class for Qwin_Widget test
 */
class _WidgetTest extends Qwin_Widget
{
    /**
     * how many times called getIntValueOption method
     *
     * @var int
     */
    protected $_count = 0;

    public $options = array(
        'intValue' => 1,
        'mixedValue' => null,
    );

    public function setIntValueOption($value)
    {
        if (is_int($value)) {
            $this->options['intValue'] = $value;
            return $this;
        }
        throw new Qwin_Exception('Parameter 1 should be int');
    }

    public function getIntValueOption()
    {
        // called count
        $this->_count++;

        return $this->options['intValue'];
    }
}