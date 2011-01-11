<?php
/**
 * Group
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
 * @package     Common
 * @subpackage  Member
 * @author      Twin Huang <twinh@yahoo.cn>
 * @copyright   Twin Huang
 * @license     http://www.opensource.org/licenses/apache2.0.php Apache License
 * @version     $Id$
 * @since       2010-07-15 14:49:16
 */

class Common_Member_Metadata_Group extends Common_Metadata
{
    public function setMetadata()
    {
        $this->setCommonMetadata();
        $this->parseMetadata(array(
            // 基本属性
            'field' => array(
                'name' => array(
                    'attr' => array(
                        'isList' => 1,
                    ),
                ),
                'image_path' => array(
                    'form' => array(
                        '_widget' => array(
                            'fileTree',
                            'ajaxUpload'
                        ),
                    ),
                ),
                'description' => array(
                    'form' => array(
                        '_type' => 'textarea',
                    ),
                ),
                'permission' => array(
                    'form' => array(
                        '_type' => 'hidden',
                    ),
                    'attr' => array(
                        'isList' => 0,
                        'isView' => 0,
                    ),
                ),
            ),
            'group' => array(

            ),
            'model' => array(

            ),
            'metadata' => array(

            ),
            'db' => array(
                'table' => 'member_group',
                'order' => array(
                    array('date_created', 'DESC'),
                ),
                'nameField' => array(
                    'name',
                ),
            ),
            // 页面显示
            'page' => array(
                'title' => 'LBL_MODULE_MEMBER_GROUP',
            ),
        ));
    }

    public function convertViewImagePath($value)
    {
        if(file_exists($value))
        {
            return '<img src="' . $value . '" />';
        }
        return $value . '<em>(' . $this->_lang->t('MSG_FILE_NOT_EXISTS') . ')</em>';
    }

    public function convertListOperation($value, $name, $data, $copyData)
    {
        $primaryKey = $this->db['primaryKey'];
        $url = Qwin::run('-url');
        $lang = Qwin::run('-lang');
        $set = $this->getAscFromClass();
        $html = Qwin_Helper_Html::jQueryButton($url->createUrl($set, array('action' => 'AllocatePermission', $primaryKey => $copyData[$primaryKey])), $lang->t('LBL_ACTION_ALLOCATE_PERMISSION'), 'ui-icon-person')
              . parent::convertListOperation($value, $name, $data, $copyData);
        return $html;
    }
}
