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
 * @method string getConfigId() 获取拉流配置Id。
 * @method void setConfigId(string $ConfigId) 设置拉流配置Id。
 * @method string getFromUrl() 获取源Url。
 * @method void setFromUrl(string $FromUrl) 设置源Url。
 * @method string getToUrl() 获取目的Url。
 * @method void setToUrl(string $ToUrl) 设置目的Url。
 * @method string getAreaName() 获取区域名。
 * @method void setAreaName(string $AreaName) 设置区域名。
 * @method string getIspName() 获取运营商名。
 * @method void setIspName(string $IspName) 设置运营商名。
 * @method string getStartTime() 获取开始时间。
 * @method void setStartTime(string $StartTime) 设置开始时间。
 * @method string getEndTime() 获取结束时间。
 * @method void setEndTime(string $EndTime) 设置结束时间。
 * @method string getStatus() 获取0无效，1初始状态，2正在运行，3拉起失败，4暂停。
 * @method void setStatus(string $Status) 设置0无效，1初始状态，2正在运行，3拉起失败，4暂停。
 */

/**
 *拉流配置
 */
class PullStreamConfig extends AbstractModel
{
    /**
     * @var string 拉流配置Id。
     */
    public $ConfigId;

    /**
     * @var string 源Url。
     */
    public $FromUrl;

    /**
     * @var string 目的Url。
     */
    public $ToUrl;

    /**
     * @var string 区域名。
     */
    public $AreaName;

    /**
     * @var string 运营商名。
     */
    public $IspName;

    /**
     * @var string 开始时间。
     */
    public $StartTime;

    /**
     * @var string 结束时间。
     */
    public $EndTime;

    /**
     * @var string 0无效，1初始状态，2正在运行，3拉起失败，4暂停。
     */
    public $Status;
    /**
     * @param string $ConfigId 拉流配置Id。
     * @param string $FromUrl 源Url。
     * @param string $ToUrl 目的Url。
     * @param string $AreaName 区域名。
     * @param string $IspName 运营商名。
     * @param string $StartTime 开始时间。
     * @param string $EndTime 结束时间。
     * @param string $Status 0无效，1初始状态，2正在运行，3拉起失败，4暂停。
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
        if (array_key_exists("ConfigId",$param) and $param["ConfigId"] !== null) {
            $this->ConfigId = $param["ConfigId"];
        }

        if (array_key_exists("FromUrl",$param) and $param["FromUrl"] !== null) {
            $this->FromUrl = $param["FromUrl"];
        }

        if (array_key_exists("ToUrl",$param) and $param["ToUrl"] !== null) {
            $this->ToUrl = $param["ToUrl"];
        }

        if (array_key_exists("AreaName",$param) and $param["AreaName"] !== null) {
            $this->AreaName = $param["AreaName"];
        }

        if (array_key_exists("IspName",$param) and $param["IspName"] !== null) {
            $this->IspName = $param["IspName"];
        }

        if (array_key_exists("StartTime",$param) and $param["StartTime"] !== null) {
            $this->StartTime = $param["StartTime"];
        }

        if (array_key_exists("EndTime",$param) and $param["EndTime"] !== null) {
            $this->EndTime = $param["EndTime"];
        }

        if (array_key_exists("Status",$param) and $param["Status"] !== null) {
            $this->Status = $param["Status"];
        }
    }
}
