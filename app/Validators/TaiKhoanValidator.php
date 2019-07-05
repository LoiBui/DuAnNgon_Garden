<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;

/**
 * Class QLYUserValidator.
 *
 * @package namespace App\Validators;
 */
class TaiKhoanValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
  
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);

        /**
         *
         * Validator rules
         *
         */
        $this->rules = [
            ValidatorInterface::RULE_CREATE => [
                'username'=>'min: 6|unique:taikhoans',
                'password'=>'min: 8|',
                'tennguoidung'=>'min: 10|max:50',
	            'socmnd'=>'min: 10|numeric|unique:taikhoans',
	            'quequan'=>'min: 8|',
                'sdt'=>'min: 10|numeric',
                'email'=>'required|unique:taikhoans',
            ],

            ValidatorInterface::RULE_UPDATE => [
                'password'=>'min: 6|',
                'tennguoidung'=>'min: 10|max:50',
	            'socmnd'=>'min: 10|numeric',
	            'quequan'=>'min: 8|',
                'sdt'=>'min: 10|numeric',
                'email'=>'required',
            ],
        ];

        /**
         *
         * Validator attributes
         *
         */
        $this->attributes = [];

        /**
         *
         * Validator messages
         *
         */
        $this->messages = [
            'username.min' => 'Tên đăng nhập quá ngắn ít nhất 6 kí tự',
            'username.max' => 'Tên đăng nhập quá dài nhiều nhất 50 kí tự',
            'username.username' => 'Tên đăng nhập đã tồn tại',

            'password.min' => 'Mật khẩu nhập quá ngắn ít nhất 8 kí tự',
            'tennguoidung.min' => 'Tên người dùng quá ngắn ít nhất 8 kí tự',
            'tennguoidung.max' => 'Tên người dùng quá dài nhiều nhất 50 kí tự',

            'socmnd.min' => 'Số CMND nhập quá ngắn ít nhất 8 kí tự',
            'socmnd.max' => 'Số CMND nhập quá dài nhiều nhất 20 kí tự',
            'socmnd.numeric' => 'Số CMND không hợp lệ chỉ được nhập số',
            'socmnd.socmnd' => 'Số CMND nhập đã tồn tại',

            'quequan.min' => 'Quê quán nhập quá ngắn ít nhất 8 kí tự',
            'sdt.min' => 'SDT nhập quá ngắn ít nhất 8 kí tự',
            'sdt.max' => 'SDT nhập quá dài nhiều nhất 13 kí tự',
            'sdt.numeric' => 'SDT không hợp lệ chỉ được nhập số',

            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email đã tồn tại',
        ];
    }
}
