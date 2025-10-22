<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentNetworkResource extends JsonResource
{
    //  public function toArray(Request $request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'code' => $this->code,
    //         'name_subcontinents' => $this->name_subcontinents,
    //         'name_continents' => $this->name_continents,
    //         'name_country' => $this->name_country,
    //         'flag_country' => $this->flag_country,
    //         'name_city' => $this->name_city,
    //         'address' => $this->address,
    //         'lat' => $this->lat,
    //         'lng' => $this->lng,
    //         'phone' => $this->phone,
    //         'email' => $this->email,
    //         'image' => $this->image,
    //         'status' => $this->status,
    //         'created_at' => $this->created_at?->toDateString() ?? '-',
    //         'updated_at' => $this->updated_at?->toDateString() ?? '-',
    //     ];
    // }


    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,

            //  Lokasi geografis
            'location' => [
                'continent' => $this->name_continents,
                'subcontinent' => $this->name_subcontinents,
                'country' => [
                    'name' => $this->name_country,
                    // 'flag' => $this->flag_country,
                    'flag' => $this->flag_country
                        ? asset('storage/flag/' . $this->flag_country)
                        : asset('storage/flag/defaultFlag.png'),
                ],
                'city' => $this->name_city,
                'address' => $this->address,
                'coordinates' => [
                    'lat' => $this->lat,
                    'lng' => $this->lng,
                ],
            ],

            //  Kontak
            'contact' => [
                'phone' => $this->phone,
                'email' => $this->email,
            ],

            //  Media
            'image' => $this->image 
                ? asset('storage/agent/' . $this->image) 
                : asset('images/default-agent.jpg'),

            //  Status
            'status' => $this->status,

            //  Timestamp
            'created_at' => $this->created_at?->toDateString() ?? '-',
            'updated_at' => $this->updated_at?->toDateString() ?? '-',
        ];
    }
}
