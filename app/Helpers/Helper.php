<?php
namespace App\Helpers;
use Illuminate\Http\Request;
class Helper{
	public static function uploadFile($key,$path){
		request()->file($key)->store($path);
		return request()->file($key)->hashName();
	}
}
