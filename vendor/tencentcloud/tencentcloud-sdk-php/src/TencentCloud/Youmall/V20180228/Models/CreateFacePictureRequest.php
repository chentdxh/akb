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
namespace TencentCloud\Youmall\V20180228\Models;
use TencentCloud\Common\AbstractModel;

/**
 * @method string getCompanyId() 获取集团ID
 * @method void setCompanyId(string $CompanyId) 设置集团ID
 * @method integer getShopId() 获取店铺ID
 * @method void setShopId(integer $ShopId) 设置店铺ID
 * @method integer getPersonType() 获取人物类型（0表示普通顾客，1 白名单，2 表示黑名单）
 * @method void setPersonType(integer $PersonType) 设置人物类型（0表示普通顾客，1 白名单，2 表示黑名单）
 * @method string getPicture() 获取图片BASE编码
 * @method void setPicture(string $Picture) 设置图片BASE编码
 * @method string getPictureName() 获取图片名称
 * @method void setPictureName(string $PictureName) 设置图片名称
 */

/**
 *CreateFacePicture请求参数结构体
 */
class CreateFacePictureRequest extends AbstractModel
{
    /**
     * @var string 集团ID
     */
    public $CompanyId;

    /**
     * @var integer 店铺ID
     */
    public $ShopId;

    /**
     * @var integer 人物类型（0表示普通顾客，1 白名单，2 表示黑名单）
     */
    public $PersonType;

    /**
     * @var string 图片BASE编码
     */
    public $Picture;

    /**
     * @var string 图片名称
     */
    public $PictureName;
    /**
     * @param string $CompanyId 集团ID
     * @param integer $ShopId 店铺ID
     * @param integer $PersonType 人物类型（0表示普通顾客，1 白名单，2 表示黑名单）
     * @param string $Picture 图片BASE编码
     * @param string $PictureName 图片名称
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
        if (array_key_exists("CompanyId",$param) and $param["CompanyId"] !== null) {
            $this->CompanyId = $param["CompanyId"];
        }

        if (array_key_exists("ShopId",$param) and $param["ShopId"] !== null) {
            $this->ShopId = $param["ShopId"];
        }

        if (array_key_exists("PersonType",$param) and $param["PersonType"] !== null) {
            $this->PersonType = $param["PersonType"];
        }

        if (array_key_exists("Picture",$param) and $param["Picture"] !== null) {
            $this->Picture = $param["Picture"];
        }

        if (array_key_exists("PictureName",$param) and $param["PictureName"] !== null) {
            $this->PictureName = $param["PictureName"];
        }
    }
}
