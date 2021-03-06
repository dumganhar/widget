<?php
/**
 * Widget Framework
 *
 * @copyright   Copyright (c) 2008-2013 Twin Huang
 * @license     http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Widget\Validator;

/**
 * Check if the input is greater than (>=) the specified value
 *
 * @author      Twin Huang <twinhuang@qq.com>
 */
class GreaterThan extends EqualTo
{
    protected $invalidMessage = '%name% must be greater than %value%';

    protected $negativeMessage = '%name% must not be greater than %value%';

    /**
     * {@inheritdoc}
     */
    protected function doCompare($input)
    {
        return $input > $this->value;
    }
}