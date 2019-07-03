<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;

/**
 * Class ManagerValidator.
 *
 * @package namespace App\Validators;
 */
class BanValidator extends LaravelValidator
{

    /**
     * ManagerValidator constructor.
     * @param Factory $validator
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
                'tenkhachhang'  =>'required|min:6|max:50',
                'sdt'           =>    'numeric',
                'sdt'           =>    'required|min:10|max:11',
            ],
            ValidatorInterface::RULE_UPDATE => [
                'tenkhachhang'  =>'required|min:6|max:50',
                'sdt'           =>    'numeric',
                'sdt'           =>    'required|min:10|max:11',
            ],
        ];

        $this->attributes = [
            'tenkhachhang'              => __('ten khach hang'),
            'sdt'              => __('sdt'),
        ];

        /**
         *
         * Validator messages
         *
         */
        $this->messages = [
            'tenkhachhang.required'=>'Tên khách hàng không được bỏ trống',
            'tenkhachhang.min'=>'Tên khách hàng không được quá ngắn',
            'tenkhachhang.max'=>'Tên khách hàng không được quá dài',
            'sdt.required'=>'Số Điện Thoại không được bỏ trống',
            'sdt.min'=>'Số Điện Thoại không được quá ngắn',
            'sdt.max'=>'Số Điện Thoại không được quá dài'
        ];
    }

}
