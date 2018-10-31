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
namespace TencentCloud\Vpc\V20170312\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method string getVpcId() 获取VPC实例ID。
 * @method void setVpcId(string $VpcId) 设置VPC实例ID。
 * @method string getSubnetId() 获取子网实例ID，例如：subnet-bthucmmy。
 * @method void setSubnetId(string $SubnetId) 设置子网实例ID，例如：subnet-bthucmmy。
 * @method string getSubnetName() 获取子网名称。
 * @method void setSubnetName(string $SubnetName) 设置子网名称。
 * @method string getCidrBlock() 获取子网的CIDR。
 * @method void setCidrBlock(string $CidrBlock) 设置子网的CIDR。
 * @method boolean getIsDefault() 获取是否默认子网。
 * @method void setIsDefault(boolean $IsDefault) 设置是否默认子网。
 * @method boolean getEnableBroadcast() 获取是否开启广播。
 * @method void setEnableBroadcast(boolean $EnableBroadcast) 设置是否开启广播。
 * @method string getZone() 获取可用区。
 * @method void setZone(string $Zone) 设置可用区。
 * @method string getRouteTableId() 获取路由表实例ID，例如：rtb-l2h8d7c2。
 * @method void setRouteTableId(string $RouteTableId) 设置路由表实例ID，例如：rtb-l2h8d7c2。
 * @method string getCreatedTime() 获取创建时间。
 * @method void setCreatedTime(string $CreatedTime) 设置创建时间。
 * @method integer getAvailableIpAddressCount() 获取可用IP数。
 * @method void setAvailableIpAddressCount(integer $AvailableIpAddressCount) 设置可用IP数。
 */

/**
 *子网对象
 */
class Subnet extends AbstractModel
{
    /**
     * @var string VPC实例ID。
     */
    public $VpcId;

    /**
     * @var string 子网实例ID，例如：subnet-bthucmmy。
     */
    public $SubnetId;

    /**
     * @var string 子网名称。
     */
    public $SubnetName;

    /**
     * @var string 子网的CIDR。
     */
    public $CidrBlock;

    /**
     * @var boolean 是否默认子网。
     */
    public $IsDefault;

    /**
     * @var boolean 是否开启广播。
     */
    public $EnableBroadcast;

    /**
     * @var string 可用区。
     */
    public $Zone;

    /**
     * @var string 路由表实例ID，例如：rtb-l2h8d7c2。
     */
    public $RouteTableId;

    /**
     * @var string 创建时间。
     */
    public $CreatedTime;

    /**
     * @var integer 可用IP数。
     */
    public $AvailableIpAddressCount;
    /**
     * @param string $VpcId VPC实例ID。
     * @param string $SubnetId 子网实例ID，例如：subnet-bthucmmy。
     * @param string $SubnetName 子网名称。
     * @param string $CidrBlock 子网的CIDR。
     * @param boolean $IsDefault 是否默认子网。
     * @param boolean $EnableBroadcast 是否开启广播。
     * @param string $Zone 可用区。
     * @param string $RouteTableId 路由表实例ID，例如：rtb-l2h8d7c2。
     * @param string $CreatedTime 创建时间。
     * @param integer $AvailableIpAddressCount 可用IP数。
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
        if (array_key_exists("VpcId",$param) and $param["VpcId"] !== null) {
            $this->VpcId = $param["VpcId"];
        }

        if (array_key_exists("SubnetId",$param) and $param["SubnetId"] !== null) {
            $this->SubnetId = $param["SubnetId"];
        }

        if (array_key_exists("SubnetName",$param) and $param["SubnetName"] !== null) {
            $this->SubnetName = $param["SubnetName"];
        }

        if (array_key_exists("CidrBlock",$param) and $param["CidrBlock"] !== null) {
            $this->CidrBlock = $param["CidrBlock"];
        }

        if (array_key_exists("IsDefault",$param) and $param["IsDefault"] !== null) {
            $this->IsDefault = $param["IsDefault"];
        }

        if (array_key_exists("EnableBroadcast",$param) and $param["EnableBroadcast"] !== null) {
            $this->EnableBroadcast = $param["EnableBroadcast"];
        }

        if (array_key_exists("Zone",$param) and $param["Zone"] !== null) {
            $this->Zone = $param["Zone"];
        }

        if (array_key_exists("RouteTableId",$param) and $param["RouteTableId"] !== null) {
            $this->RouteTableId = $param["RouteTableId"];
        }

        if (array_key_exists("CreatedTime",$param) and $param["CreatedTime"] !== null) {
            $this->CreatedTime = $param["CreatedTime"];
        }

        if (array_key_exists("AvailableIpAddressCount",$param) and $param["AvailableIpAddressCount"] !== null) {
            $this->AvailableIpAddressCount = $param["AvailableIpAddressCount"];
        }
    }
}
