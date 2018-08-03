<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UploadFile\System\Core as SystemCore;

class System extends Controller
{

	protected static $core;

	function __construct()
	{
		self::$core = new SystemCore;
	}


	public function category ()
	{
		return $this->resSuccess('',self::$core->listCategoryKey());
	}


	public function group (Request $req)
	{
		if ($req->category) {
			return $this->resSuccess('', self::$core->getCategory($req->category));
		} else {
			return $this->resFail('分类未提交。');
		}
	}


	public function save(Request $req)
	{

	    //提交参数 举例
        /*{
            "category": "Seo",
            "group": "Home Page",
            "param": {
                "home_page_title": 123,
                "home_page_keywords": 2134
            }

          }
        */
		$category = $req->category;
		$group = $req->group;

		if (!$category) {
			return $this->resFail('分类未提供。');
		}
		if (!$group) {
			return $this->resFail('分组未提供。');
		}
		self::$core->save($category, $group, $req->input('param'));
		return $this->resSuccess('系统设置保存成功。');
	}


}
