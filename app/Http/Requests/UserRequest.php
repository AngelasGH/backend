<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\elementType;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
       if(request()->routeIs('user.store')){
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|min:8',
            ];
       } elseif (request() -> routeIs('user.login')){
            return [
                'email' => 'required|string|email|max:255',
                'password' => 'required|min:8',
            ];
       } elseif (request() -> routeIs('user.image') || request()-> routeIs('profile.image') || request()-> routeIs('image.ocr')){
        return [
            'image' => 'required|image|mimes:jpg,bmp,png|max:2048',
        ];
        } else{
            return [
                'message' => 'no user request for that route name'
            ];
       }
    }
}