<?php

return [

    /*
    |--------------------------------------------------------------------------
    | System Config from SDWSystem table
    |--------------------------------------------------------------------------
    |
    |
    |
    */

	# category
	'Seo' => [
		# group
		'Home Page' => [
			# param
			'home_page_title' => [  // 首页标题
				'title' => 'Home page title ',
				'type' => 'input',
				'note' => '',
				'require' => 'string',
				'val' => ''
			],
			'home_page_keywords' => [  // 首页关键字
				'title' => 'Home page keywords ',
				'type' => 'textarea',
				'note' => '',
				'require' => 'string',
				'val' => ''
			],
			'home_page_description' => [ // 首页描述
				'title' => 'Home page description ',
				'type' => 'textarea',
				'note' => '',
				'require' => 'string',
				'val' => ''
			],
		]
	],

	'Shop' => [
		'Order' => [
			'min_amount_of_first_order' => [ // 首次下单最大金额
				'title' => 'Min amount of first order ',
				'type' => 'input',
				'note' => 'Set 0, if u wanna remove this limit.',
				'require' => 'int|8|+',
				'val' => null
			],
            'reorder_amount_of_order' => [ // 翻单金额
                'title' => 'Min Amount of re-orders ',
                'type' => 'input',
                'note' => 'Set 0, if u wanna remove this limit.',
                'require' => 'int|8|+',
                'val' => null
            ],

			'expired_time_of_unpaid_order' => [ // 超时订单过期时间(小时)
				'title' => 'Expired time of unpaid order ',
				'type' => 'input',
				'note' => 'hour(s), the unpaid order will be canceled automaticly after the time.Set 0 if u don\'t wanna set this limit.',
				'require' => 'int|0|+0',
				'val' => null
			],

			'amount_of_big_order' => [ // 大订单金额
				'title' => 'The amount of big order ',
				'type' => 'input',
				'note' => 'If u wanna verify the big order manually, set a number for the amount, otherwise set 0.',
				'require' => 'int|8|+0',
				'val' => null
			],

			'verify_order_manually_when_new_address_are_used' => [ // 如果客户使用新地址 手动审核订单
				'title' => 'Verify order manually when a new address is used ',
				'type' => 'switch',
				'note' => '',
				'require' => '',
				'val' => null
			],
		],


		'Inventory' => [
			'qty_of_low_stock' => [ // 低库存数量
				'title' => 'Qty of low stock ',
				'type' => 'input',
				'note' => 'Set 0, if u wanna remove this function.',
				'require' => 'int|8|+0',
				'val' => null
			],

			'comment_for_low_stock' => [ // 低库存提示语
				'title' => 'Comment for low stock ',
				'type' => 'input',
				'note' => '',
				'require' => 'string',
				'val' => null
			],
		],


		# 公司信息
		'Company Info' => [
			'tel_for_customer' => [ // 客户热线
				'title' => 'Tel Number for customer',
				'type' => 'input',
				'note' => '',
				'require' => 'string',
				'val' => null
			],

			'email_for_customer' => [ // 客户线上咨询邮箱
				'title' => 'Email for customer',
				'type' => 'input',
				'note' => '',
				'require' => 'string',
				'val' => null
			],
		],
	],



	'Payment' => [
		'Development' => [
			'amount' => [ // stripe api key
				'title' => 'Amount for payment ',
				'type' => 'input',
				'note' => 'All testing orders will charge this amount of transaction. Please turn off this function and enter "0" after testing.',
				'require' => 'float|0,2|+0',
				'val' => null
			],
		],

		'Stripe' => [
			'api_key' => [ // stripe api key
				'title' => 'Api Key(public) ',
				'type' => 'input',
				'note' => 'These two functions are related to payment account, please set it cautiously.',
				'require' => 'string',
				'val' => null
			],

			'api_secret' => [ // stripe api key
				'title' => 'Api Secret{private) ',
				'type' => 'input',
				'note' => '',
				'require' => 'string',
				'val' => null
			],
		],
	],


	'Client' => [
		'Register' => [
			'reason_for_register_failing' => [ // 注册失败原因
				'title' => 'Reason for register failing ',
				'type' => 'textarea',
				'note' => 'each reason per line',
				'require' => 'string',
				'val' => null
			],
		]
	],


	'Test' => [
		'Develop' => [
			'unsigned_int' => [ // 首次下单最大金额
				'title' => '正数',
				'type' => 'input',
				'note' => '正整数 int|8|+0',
				'require' => 'int|8|+0',
				'val' => null
			],

			'int' => [ // 超时订单过期时间(小时)
				'title' => '负数',
				'type' => 'input',
				'note' => '负数 int|3|-',
				'require' => 'int|3|-',
				'val' => null
			],

			'float' => [ // 大订单金额
				'title' => '浮点型',
				'type' => 'input',
				'note' => '浮点型 float|0,2|+-0',
				'require' => 'float|0,2|+-0',
				'val' => null
			],

		],

	],




];
