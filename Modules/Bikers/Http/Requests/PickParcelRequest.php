<?php

namespace Modules\Bikers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PickParcelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "pick_up_at" => "required|date_format:Y-m-d H:i:s|after:today",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
