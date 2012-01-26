<?php
/**
 * Qwin Framework
 *
 * Copyright (c) 2008-2011 Twin Huang. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author      Twin Huang <twinh@yahoo.cn>
 * @copyright   Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 * @version     $Id$
 */

/**
 * Escape
 *
 * @package     Qwin
 * @subpackage  Widget
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 * @author      Twin Huang <twinh@yahoo.cn>
 * @since       2012-01-12 17:53:49
 */
class Qwin_Escape extends Qwin_Widget
{
    /**
     * Escapes special characters for sql query
     *
     * @see www.php.net/manual/en/function.mysql-real-escape-string.php
     */
    public function call()
    {
        // \0 === \x00
        $this->source = str_replace(array(
            "\0", "\n", "\r", '\\', "'", '"', "\x1a"
        ), array(
            '\\0', '\\n', '\\r', '\\\\', "\\'", '\\"', '\\Z'
        ), $this->source);

        return $this->invoker;
    }
}