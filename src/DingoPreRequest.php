<?php
// +----------------------------------------------------------------------
// | DingoPreRequest.php
// +----------------------------------------------------------------------
// | Description: 请求前置处理（dingo）
// +----------------------------------------------------------------------
// | Time: 2018/3/15 上午11:20
// +----------------------------------------------------------------------
// | Author: Object,半醒的狐狸<2252390865@qq.com>
// +----------------------------------------------------------------------

namespace Chinaobject\PreRequest;

use Dingo\Api\Http\FormRequest;

class DingoPreRequest extends FormRequest
{
    public $data = [];

    public function validate()
    {
        $this->data = array_merge($this->route()->parameters(),$this->all());

        if ($this->authorize() === false) {
            throw new AccessDeniedHttpException(401,'权限不足');
        }
        
        $validator = app('validator')->make($this->data, $this->rules(), $this->messages());

        if ($validator->fails()) {
            throw new ValidationHttpException(400,$validator->errors()->first());
        }
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

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
