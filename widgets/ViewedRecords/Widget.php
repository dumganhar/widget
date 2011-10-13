<?php
/**
 * widget
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
 * @since       2011-02-11 14:47:21
 */

class ViewedRecords_Widget extends Qwin_Widget
{
    /**
     * 自动加载配置
     * @var array
     */
    public $options = array(
        'lang' => true,
    );

    public function render($options = null)
    {
        return false;
        $this->_lang->appendByWidget($this);
        $viewRecords = Qwin::call('-session')->get('viewedRecords');
        $this->_minify->add($this->_path . 'view/style.css');

        require $this->_path . 'view/default.php';
    }
}
