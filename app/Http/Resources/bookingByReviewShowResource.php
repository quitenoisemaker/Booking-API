<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class bookingByReviewShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'booking_id' => $this->id,
            'from' => $this->from,
            't0' => $this->to,
            'bookable' => new bookingByReviewBookableShowResource($this->bookable),

        ];
    }
}
