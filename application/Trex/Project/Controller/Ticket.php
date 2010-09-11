<?php
/**
 * Ticket
 *
 * Copyright (c) 2008-2010 Twin Huang. All rights reserved.
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
 * @package     Trex
 * @subpackage  Project
 * @author      Twin Huang <twinh@yahoo.cn>
 * @copyright   Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 * @version     $Id$
 * @since       2010-07-09 14:53:13
 */

class Trex_Project_Controller_Ticket extends Trex_ActionController
{
    /**
     * 简洁模式
     */
    public function actionSimpleAdd()
    {
        $this->setAction('Add');
        $this->_meta->field->unlinkList(array(
            'type', 'priority', 'severity', 'reproducibility', 'status',
        ));
        parent::actionAdd();
    }

    public function convertDbStatusId($value, $name, $data, $copyData)
    {
        return Qwin::run('Qwin_converter_String')->getUuid($value);
    }

    public function isSaveStatusData($data, $query)
    {
        if(isset($data['status']) && isset($query->status) && $data['status'] == $query['status'])
        {
            return false;
        }
        return true;
    }
}
