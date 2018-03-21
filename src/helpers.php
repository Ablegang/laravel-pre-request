<?php
// +----------------------------------------------------------------------
// | helpers.php
// +----------------------------------------------------------------------
// | Description: 函数库
// +----------------------------------------------------------------------
// | Time: 2018/3/21 上午11:13
// +----------------------------------------------------------------------
// | Author: Object,半醒的狐狸<2252390865@qq.com>
// +----------------------------------------------------------------------

if (!function_exists("api")){
    function api($api)
    {
        return $api.'\\'.$api;
    }
}

if(!function_exists("all2string")){
	function all2string($data)
	{
		if(in_array(gettype($data),['array','object'])){
			$data = (array)$data;
			foreach ($data as $k => $v) {
				$data[$k] = all2string($v);
			}
		}else{
			return (string)$data;
		}
	}
}