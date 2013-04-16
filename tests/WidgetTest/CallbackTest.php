<?php

namespace WidgetTest;

use Widget\Callback;

/**
 * @property \Widget\Callback $callback The WeChat callback widget
 */
class CallbackTest extends TestCase
{
    /**
     * @dataProvider providerForInputAndOutput
     */
    public function testInputAndOutput($query, $input, $output)
    {
        $cb = $this->callback;
        
        // Inject HTTP query
        parse_str($query, $gets);
        $this->request->setOption('gets', $gets);
        
        // Inject user input message
        $cb->setOption('postData', $input);
        
        $cb->fallback(function($callback){
            return "Your input is " . $callback->getIntput() . "\n"
                . "Type a number to see more \n"
                . "[0]Show menu message"
                . "[1]Show text message\n"
                . "[2]Show music message\n"
                . "[3]Show richtext message\n"
                . "[4]Show a random number\n";
        });

        $cb->is('0', function(){
            
        });
        
        $cb->is('1', function(){
            return 'text message';
        });
        
        $cb->is('2', function(Callback $cb){
            return $cb->sendMusic('Burning', 'A song of Maria Arredondo', 'url', 'HQ url', true);
        });
        
        $cb->is('3', function(Callback $cb){
            return $cb->sendArticle(array(
                'title' => 'It\'s fine today',
                'description' => 'A new day is coming~~',
                'picUrl' => 'http://pic-url',
                'url' => 'http://link-url'
            ));
        });
        
        $cb->has('ipad', function(Callback $cb){
            return $cb->sendText('Find a ipad ? ok, i will remember u', true);
        });
        
        $cb->match('/twin/i', function(Callback $cb){
            return $cb->sendText('I\'m here');
        });
        
        ob_start();
        $cb();
        $content = ob_get_contents();
        
        $this->assertEquals('fromUser', $cb->getFrom());
        $this->assertEquals('toUser', $cb->getTo());

        $output = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);

        $this->assertEquals('toUser', $output->FromUserName);
        $this->assertEquals('fromUser', $output->ToUserName);
    }
    
    public function providerForInputAndOutput()
    {
        return array(
            array(
                'signature=2c14ced70f1f149ce23e453d678eb9e465ac032a&timestamp=1366032735&nonce=1365872231',
                $this->inputTextMessage('0'),
                '<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>12345678</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[content]]></Content>
 <FuncFlag>0</FuncFlag>
 </xml>'
            )
        );
    }
    
    public function inputTextMessage($input)
    {
        return '<xml>
                <ToUserName><![CDATA[toUser]]></ToUserName>
                <FromUserName><![CDATA[fromUser]]></FromUserName> 
                <CreateTime>1348831860</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[' . $input . ']]></Content>
                <MsgId>1234567890123456</MsgId>
                </xml>';
    }
}
