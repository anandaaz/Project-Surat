<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratPerintahLemburResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $waktu = Carbon::parse($this->waktu)->format('l, j F Y');
        return array(
            'id' => $this->id,
            'waktu' => $waktu,
            'department_id' => $this->department->id,
            'evidence' => $this->evidence,
            'created_by' => $this->created_by->name,
        );
    }
}
