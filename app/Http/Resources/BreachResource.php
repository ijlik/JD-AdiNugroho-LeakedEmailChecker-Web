<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreachResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this['Name'],
            'title' => $this['Title'],
            'domain' => $this['Domain'],
            'breach_date' => $this['BreachDate'],
            'added_date' => $this['AddedDate'],
            'modified_date' => $this['ModifiedDate'],
            'pwn_count' => $this['PwnCount'],
            'description' => strip_tags($this['Description']),
            'logo_path' => $this['LogoPath'],
            'data_classes' => $this['DataClasses'],
            'is_verified' => $this['IsVerified'],
            'is_fabricated' => $this['IsFabricated'],
            'is_sensitive' => $this['IsSensitive'],
            'is_retired' => $this['IsRetired'],
            'is_spam_list' => $this['IsSpamList'],
            'is_malware' => $this['IsMalware'],
        ];
    }
}
