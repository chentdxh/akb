<?php
/*
 * Copyright (c) 2017-2018 THL A29 Limited, a Tencent company. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace TencentCloud\Tmt\V20180321\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method array getValue() 获取图片翻译结果
 * @method void setValue(array $Value) 设置图片翻译结果
 */

/**
 *图片翻译结果
 */
class ImageRecord extends AbstractModel
{
    /**
     * @var array 图片翻译结果
     */
    public $Value;
    /**
     * @param array $Value 图片翻译结果
     */
    function __construct()
    {

    }
    /**
     * 内部实现，用户禁止调用
     */
    public function deserialize($param)
    {
        if ($param === null) {
            return;
        }
        if (array_key_exists("Value",$param) and $param["Value"] !== null) {
            $this->Value = [];
            foreach ($param["Value"] as $key => $value){
                $obj = new ItemValue();
                $obj->deserialize($value);
                array_push($this->Value, $obj);
            }
        }
    }
}
