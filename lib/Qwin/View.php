<?php

/**
 * Qwin Framework
 *
 * @copyright   Copyright (c) 2008-2012 Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 */

namespace Qwin;

/**
 * Tmpl
 *
 * @package     Qwin
 * @author      Twin Huang <twinh@yahoo.cn>
 */
class View extends Widget implements Viewable
{
    public $options = array(
        'dirs' => array(),
    );
    
    /**
     * @see \Qwin\Viewable::render
     */
    public function render($name, $context = array())
    {
        $tmpl = new Tmpl(array('name' => $name));
        
        return $tmpl->render($context);
    }
    
    /**
     * @see \Qwin\Viewable::display
     */
    public function display($name, $context = array())
    {
        echo $this->render($name, $context);
    }
    
    /**
     * @see \Qwin\Viewable::assign
     */
    public function assign($name, $value = null)
    {
        if (is_array($name)) {
            $this->vars = $name + $this->vars;
        } else {
            $this->vars[$name] = $value;
        }
        return $this;
    }
  
    
    /**
     * Get the template file by name
     * 
     * @param string $name The name of template
     * @return string The template file path
     * @throws Exception When file not found
     */
    public function getFile($name)
    {
        foreach ($this->options['dirs'] as $dir) {
            if (is_file($file = $dir . '/' .  $name)) {
                return $file;
            }
        }
        
        throw new Exception(sprintf('Template "%s" not found in directories "%s"', $name, implode('", "', $this->options['dirs'])));
    }
}