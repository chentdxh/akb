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
namespace TencentCloud\Live\V20180801\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method string getStreamName() 获取流名称。
 * @method void setStreamName(string $StreamName) 设置流名称。
 * @method array getPublishTimeList() 获取推流时间列表
 * @method void setPublishTimeList(array $PublishTimeList) 设置推流时间列表
 */

/**
 *查询当前正在推流的信息
 */
class StreamOnlineInfo extends AbstractModel
{
    /**
     * @var string 流名称。
     */
    public $StreamName;

    /**
     * @var array 推流时间列表
     */
    public $PublishTimeList;
    /**
     * @param string $StreamName 流名称。
     * @param array $PublishTimeList 推流时间列表
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
        if (array_key_exists("StreamName",$param) and $param["StreamName"] !== null) {
            $this->StreamName = $param["StreamName"];
        }

        if (array_key_exists("PublishTimeList",$param) and $param["PublishTimeList"] !== null) {
            $this->PublishTimeList = [];
            foreach ($param["PublishTimeList"] as $key => $value){
                $obj = new PublishTime();
                $obj->deserialize($value);
                array_push($this->PublishTimeList, $obj);
            }
        }
    }
}
