<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bio'              => 'max:500',
            'twitter_username' => 'max:50',
            'github_username'  => 'max:50',
            'avatar'           => 'image|mimes:png,jpg,jpeg|max:5000',
            'avatar_status'    => '',
        ];
    }
}
