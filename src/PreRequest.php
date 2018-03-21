<?php
// +----------------------------------------------------------------------
// | PreRequest.php
// +----------------------------------------------------------------------
// | Description: 请求前置处理
// +----------------------------------------------------------------------
// | Time: 2018/3/15 上午11:20
// +----------------------------------------------------------------------
// | Author: Object,半醒的狐狸<2252390865@qq.com>
// +----------------------------------------------------------------------

namespace ChinaObject\PreRequest;

use Illuminate\Foundation\Http\FormRequest;

class PreRequest extends FormRequest
{
    public $data;

    public function validate()
    {
        $this->data = array_merge($this->route()->parameters(),$this->all());

        throw_if($this->authorize() === false, new AccessDeniedHttpException);

        $validator = app('validator')->make($this->data, $this->rules(), $this->messages());

        throw_if($validator->fails(), new ValidationHttpException($validator->errors()->first()));
    }

    public function fill()
    {
        return [];
    }

    public function fullData()
    {
        return $this->assembling();
    }

    public function assembling()
    {
        return $this->data;
    }
}
