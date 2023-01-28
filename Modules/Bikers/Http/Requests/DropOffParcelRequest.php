<?php

namespace Modules\Bikers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Parcels\Services\Interfaces\ParcelServiceInterface;

class DropOffParcelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "delivered_at" => "required|date_format:Y-m-d H:i:s|after:today",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $parcelService = resolve(ParcelServiceInterface::class);
        $parcel = $parcelService->show($this->route()->parameter('parcel_id'));
        if (!isset($parcel->pickupDetails->biker_id) || $parcel->pickupDetails->biker_id != auth()->user()->morph_user_id) {
            return false;
        }

        return true;
    }
}
