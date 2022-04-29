<?php

namespace App\Http\Traits;

trait CountriesTraits
{
    private function get_countries_drop_dwon_list()
    {
        return $this->countriesModel::pluck('name' , 'id');
    }
}
