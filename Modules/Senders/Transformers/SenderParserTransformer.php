<?php

namespace Modules\Senders\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SenderParserTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'pick_up_address' => $this->pick_up_address,
            'drop_off_address' => $this->drop_off_address,
            'sender_id' => $this->sender_id,
            'status' => $this->status,
            'details' => $this->details,
            'notes' => $this->notes,
            'created_at' => $this->created_at->toDateTimeString(),
            'last_update' => $this->updated_at->toDateTimeString(),
        ];
    }
}
