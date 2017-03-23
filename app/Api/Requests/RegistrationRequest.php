<?php

namespace Api\Requests;

use Dingo\Api\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //I need to get to main database connection using the systems table....
        //I need to validate a request
        return [
            'company' => 'required|max:255|unique:main.systems',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:main.systems',
            'password' => 'required|confirmed|min:4',
        ];
    }
}
