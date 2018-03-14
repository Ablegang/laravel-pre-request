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

class PreRequest extends Request
{
    public $data;
    public $request;

    public function __construct(Request $re)
    {
        parent::__construct();
        $this->data = array_merge($re->route()->parameters(),$re->all());
        $this->request = $re;
        $validator = Validator::make($this->data,$this->rules(),$this->messages());
        if ($validator->fails()){
            throw new PreRequestException($validator->errors()->first());
        }
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
        return $this->assembling();
    }

    public function assembling()
    {
        return $this->data;
    }
}