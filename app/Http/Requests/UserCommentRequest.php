<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to create a comment.
     *
     * @return bool
     */
    public function authorize()
    {
        $password = '720DF6C2482218518FA20FDC52D4DED7ECC043AB';
        return $this->password === $password;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'comments' => 'required'
        ];
    }
}
