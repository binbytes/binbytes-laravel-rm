<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    use AuthorizesRequests {
        resourceAbilityMap as protected resourceAbilityMapTrait;
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        // Map the "index" ability to the "index" function in our policies
        return array_merge($this->resourceAbilityMapTrait(), ['index' => 'index']);
    }
}
