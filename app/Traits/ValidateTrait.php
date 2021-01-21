<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidateTrait {

    public static function bootValidateTrait() {
        static::creating(static::validate(static::createRules()));
        static::updating(static::validate(static::updateRules()));
    }

    public static function validate($rules) {
        return function (Model $model) use($rules) {

            $validator = Validator::make(
                $model->getAttributes(),
                $rules
            );

            if ($validator->validate() && $validator->fails()) {
                throw new ValidationException($validator);
            }
        };
    }
}
