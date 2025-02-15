<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'key'             => $this->translation_key,
            'language_id'     => $this->language->id,
            'content'         => $this->content,
            'tags'            => explode(',', $this->tags), // Convert comma-separated tags into an array
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
            'lang' => $this->language,
        ];
    }
}
