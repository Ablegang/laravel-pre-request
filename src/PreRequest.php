<?php
// +----------------------------------------------------------------------
// | PreRequest.php
// +----------------------------------------------------------------------
// | Description: 
// +----------------------------------------------------------------------
// | Time: 2018/3/15 上午11:20
// +----------------------------------------------------------------------
// | Author: Object,半醒的狐狸<2252390865@qq.com>
// +----------------------------------------------------------------------

namespace ChinaObject\PreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreRequest
{
    public $data;
    public $request;

    public function __construct(Request $re)
    {
        $this->data = array_merge($re->route()->parameters(),$re->all());
        $this->request = $re;
        $validator = Validator::make($this->data,$this->rules(),$this->messages());
        if ($validator->fails()){
            throw new PreRequestException($validator->errors()->first());
        }
    }

    public function __call($method,$parameters)
    {
        return call_user_func_array([$this->request, $method], $parameters);
    }

    public function __get($var)
    {
        return $this->request->$var;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    public function fill()
    {
        return [];
    }

    public function fullData()
    {
        return collect($this->assembling());
    }

    public function assembling()
    {
        return $this->data;
    }
    
    public function validated()
    {
        return $this->only(collect($this->rules())->keys()->map(function ($rule) {
            return str_contains($rule, '.') ? explode('.', $rule)[0] : $rule;
        })->unique()->toArray());
    }
}
