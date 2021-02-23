<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePermission extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id = $this->segment(3);

        return [
            'name' => "required|min:3|max:255|unique:permissions,name,{$id},id",
            'description' => 'nullable|min:3|max:255',
        ];
    }
}
