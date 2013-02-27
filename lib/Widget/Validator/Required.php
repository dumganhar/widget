<?php
/**
 * Widget Framework
 *
 * @copyright   Copyright (c) 2008-2013 Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 */

namespace Widget\Validator;

/**
 * @author      Twin Huang <twinh@yahoo.cn>
 */
class Required extends AbstractValidator
{
    protected $requiredMessage = '%name% is required';
    
    protected $required = true;
    
    public function __invoke($input, $required = null)
    {
        is_bool($required) && $this->setOption('required', $required);
        
        return $this->isValid($input);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function validate($input)
    {
        if ($this->required && !$input) {
            $this->addError('required');
            return false;
        }
        return true;
    }
}
