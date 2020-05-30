<?php declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadXmlRequest extends FormRequest
{
    public function rules()
    {
        return [
            'users' => [
                'required',
                'mimes:application/xml,xml'
            ]
        ];
    }
}
