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
class ChiTietPhieuValidator extends LaravelValidator
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
                'soluong'           =>    'required|numeric',
            ],
            ValidatorInterface::RULE_UPDATE => [
                'soluong'           =>    'required|numeric',
            ],
        ];

        $this->attributes = [
            'soluong'              => __('Số Lượng'),
        ];

        /**
         *
         * Validator messages
         *
         */
        $this->messages = [
            'soluong.required'=>'Số Lượng Không Được Bỏ Trống',
            'soluong.numeric'=>'Số Lượng Không Hợp Lệ',
        ];
    }

}
