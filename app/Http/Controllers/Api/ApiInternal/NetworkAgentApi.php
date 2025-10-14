<?php

namespace App\Http\Controllers\Api\ApiInternal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NetworkAgentModel;
use App\Http\Requests\IndexRequestAgentNetwork;
use App\Helpers\ApiResponse;
use App\Http\Resources\AgentNetworkResourceCollection;
use App\Models\CityNetworkAgentModel;
use App\Models\CountryNetworkAgentModel;


class NetworkAgentApi extends Controller
{

     protected $NetworkAgentModel;
     protected $CityNetworkAgentModel;
     protected $CountryNetworkAgentModel;
     public function __construct(NetworkAgentModel $NetworkAgentModel, CountryNetworkAgentModel $CountryNetworkAgentModel, CityNetworkAgentModel $CityNetworkAgentModel, ) {
        $this->NetworkAgentModel = $NetworkAgentModel;
        $this->CityNetworkAgentModel = $CityNetworkAgentModel;
        $this->CountryNetworkAgentModel = $CountryNetworkAgentModel;
     }

     public function getNetworkAgent(IndexRequestAgentNetwork $request) 
     {
         $validated = $request->validated();

            $search = $validated['search'] ?? null;
            $perPage = is_numeric($validated['per_page'] ?? null) ? $validated['per_page'] : 10;
            $sortBy = $validated['sort_by'] ?? 'created_at';
            $sortDir = $validated['sort_dir'] ?? 'desc';
           

            $query = $this->NetworkAgentModel
                ->select('agents_network.*','countries_network_agent.name as name_country','cities_network_agent.name as name_city')
                ->leftJoin('countries_network_agent','countries_network_agent.id','=','agents_network.country_id')
                ->leftJoin('cities_network_agent','cities_network_agent.id','=','agents_network.city_id')
                ->search($search)
                ->sort($sortBy, $sortDir);
            $results = $query->paginate($perPage);
            $message = $results->isEmpty() ? "Data Not found" : "Success";
            return ApiResponse::paginate(new AgentNetworkResourceCollection($results), $message);
     }
}
