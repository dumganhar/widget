<?php
/**
 * Widget Framework
 *
 * @copyright   Copyright (c) 2008-2013 Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 */

namespace Widget\Validator;

/**
 * Check if the input is less or equal than specified value
 * 
 * @author      Twin Huang <twinh@yahoo.cn>
 */
class Max extends AbstractValidator
{
    protected $maxMessage = '%name% must be less or equal than %max%';
    
    protected $notMessage = '%name% must not be less or equal than %max%';
    
    protected $max;
    
    public function __invoke($input, $max = null)
    {
        $max && $this->storeOption('max', $max);
        
        return $this->isValid($input);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function validate($input)
    {
        if ($this->max < $input) {
            $this->addError('max');
            return false;
        }
        
        return true;
    }
}