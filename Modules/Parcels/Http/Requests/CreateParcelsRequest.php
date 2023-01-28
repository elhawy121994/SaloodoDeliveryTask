<?php

namespace Modules\Parcels\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateParcelsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required|max:255',
            'pick_up_address' => 'string|required|max:255',
            'drop_off_address' => 'string|required|max:255',
            'details' => 'string|nullable|sometimes|max:255',
            'notes' => 'string|nullable|sometimes|max:500',
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
