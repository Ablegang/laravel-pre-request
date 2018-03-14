<?php
// +----------------------------------------------------------------------
// | TestService.php
// +----------------------------------------------------------------------
// | Description: 
// +----------------------------------------------------------------------
// | Time: 2018/3/15 上午11:34
// +----------------------------------------------------------------------
// | Author: Object,半醒的狐狸<2252390865@qq.com>
// +----------------------------------------------------------------------

namespace ChinaObject\PreRequest;

class TestService extends PreRequest
{
    public function rules()
    {
        return [

        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function assembling()
    {
        return $this->data;
    }
}