<?php

namespace UploadFile\System;

use Illuminate\Support\Facades\Cache;
use UploadFile\Model\System as Model;

class Core
{

	private static $dat;
	private static $key;
	private static $exp;

	function __construct($config=null, $expHour=24)
	{
		self::$key = $config ?: 'system';
		self::$exp = (int)$expHour;
		self::$dat || self::$dat=config(self::$key);
	}


	/**
	 * test if the category, group, param valid
	 * */

	private static function is_category_valid ($category) {
		return $category && array_key_exists($category, self::$dat);
	}

	private static function is_group_valid ($category, $group) {
		return self::is_category_valid($category) && $group && array_key_exists($group, self::$dat[$category]);
	}

	private static function is_param_valid ($category, $group, $param) {
		return self::is_group_valid($category, $group) && $param && array_key_exists($param, self::$dat[$category][$group]);
	}



	// 从数据库获取数据
	private static function get_from_db ($category, $group=null, $param=null)
	{

		if ( !self::is_category_valid($category)) return;

		$qry = Model::where('category', $category);

		if ($group) {
			is_array($group) ? $qry->whereIn('group', $group) : $qry->where('group', $group);
			if ($param) {
				$qry->where('param', $param);
			}
		}

		$qry = $qry->orderBy('group')->get();

		return $qry->toArray();
	}



	/**
	 * get the key of category (获取Category列表)
	 * */
	static function listCategoryKey ()
	{
		return array_keys(self::$dat);
	}



	/**
	 * get the all the param in group of the given category (以数据组的形式返回分类下的所有参数值)
	 * @param $category string
	 * */
	static function getCategory ($category)
	{
		if (!self::is_category_valid($category)) return;

		$dat =& self::$dat[$category];

		$qry = self::get_from_db($category, array_keys($dat));

		foreach ($qry as &$row) {
			if (self::is_param_valid($row['category'], $row['group'], $row['param'])) {
				$dat[$row['group']][$row['param']]['val'] = $row['val'];
//				$dat[$row['group']][$row['param']]['key'] = $row['param'];
			}
		}
/*
		foreach ($dat as &$group) {
			$group = array_values($group);
		}*/

		return $dat;
	}



	/**
	 * save the sys config data in db # 存储数据到数据表
	 * @param $category string, category
	 * @param $group string, group
	 * @param $param array, key=>val type, the key is the field "param". # 键值对的形式，其中键对应param字段.
	 * */
	public static function save ($category, $group, array $param)
	{
		if (!$param) return;

		foreach ($param as $key=>&$val) {

			Cache::forget(self::set_cache_key($category, $group, $key));

			$val = [
				'category' => $category,
				'group' => $group,
				'param' => $key,
				'val' => $val,
			];
		}

		\DB::transaction (function () use (&$category, &$group, &$param) {
			Model::where([
				'category' => $category,
				'group' => $group,
			])->delete();

			Model::replace($param);
		});

	}




	# 缓存部分

	/**
	 * set the cache name
	 * */
	private static function set_cache_key ($category, $group, $param)
	{
		return join('.', [
			self::$key,
			$category,
			$group,
			$param,
		]);
	}



	/**
	 * get the param value from cache (从缓存中获取参数)
	 * @param $param string. chain style with "." # 用"."符号作为链式调用分隔符
	 * */
	static function getCache ($param)
	{

		list($category, $group, $param) = explode('.', $param);
		if (self::is_param_valid($category, $group, $param) ) {
			return Cache::remember (
				self::set_cache_key($category, $group, $param),
				self::$exp,
				function () use ($category, $group, $param) {
					$dat = self::get_from_db($category, $group, $param);
					if ($dat) {
						return $dat[0]['val'];
					}
				}
			);
		}
	}


}
