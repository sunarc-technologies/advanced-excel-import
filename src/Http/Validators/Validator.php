<?php

namespace Sunarc\ImportExcel\Http\Validators;

use Illuminate\Support\Facades\Validator as FacadesValidator;

trait Validator
{
    public $rule = [];

    /**
     * This function will remove previous rules
     *
     * @return $this
     */
    public function start()
    {
        $this->rule = ['string'];
        return $this;
    }

    /**
     * This function will add rule required or nullable
     *
     * @return $this
     */
    public function required($value)
    {
        if ($value) {
            $this->rule[] = 'required';
        } else {
            $this->rule[] = 'nullable';
        }

        return $this;
    }

    /**
     * This function will add rule min length
     *
     * @return $this
     */
    public function min($length)
    {
        if ($length)
            $this->rule[] = "min:$length";

        return $this;
    }

    /**
     * This function will add rule max length
     *
     * @return $this
     */
    public function max($length)
    {
        if ($length)
            $this->rule[] = "max:$length";

        return $this;
    }

    /**
     * This function will return the compound rule
     *
     * @return array
     */
    public function rule(): array
    {
        return $this->rule;
    }


    /**
     * To validate the data with generated validation rules
     *
     * @param array $rules
     * @param array $data
     * @return array
     */
    public function validateRules(array $data, array $rules): array
    {
        $validator = FacadesValidator::make($data, $rules);
        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        return [];
    }
}
