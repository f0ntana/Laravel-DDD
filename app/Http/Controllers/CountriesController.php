<?php

namespace App\Http\Controllers;

use App\Http\Requests\Countries\CreateCountryRequest;
use App\Http\Requests\Countries\UpdateCountryRequest;
use App\Http\Transformer\CountryTransformer;
use App\Models\Country;
use Domain\Factory\Entity\CountryFactory;
use Domain\Services\Countries\CreateCountry;
use Domain\Services\Countries\GetCountryById;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = CountryFactory::createFromCollection(Country::all()->toArray());

        return fractal($records, new CountryTransformer())->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCountryRequest $request
     * @param CreateCountry $createCountry
     * @return \Illuminate\Http\Response
     * @throws \RuntimeException
     */
    public function store(CreateCountryRequest $request, CreateCountry $createCountry)
    {
        $country = CountryFactory::createFromArray($request->all());
        $createCountry->setCountry($country);

        if ($createCountry->fire()) {
            return fractal($country, new CountryTransformer())->respond();
        }

        throw new \RuntimeException('Impossible to create this country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param GetCountryById $getCountryById
     * @return \Illuminate\Http\Response
     * @throws \InvalidArgumentException
     */
    public function show($id, GetCountryById $getCountryById)
    {
        $getCountryById->setId($id);
        $country = $getCountryById->fire();

        if ($country) {
            return fractal($country, new CountryTransformer())->respond();
        }

        return ['error' => 'Whooooops!'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCountryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, $id)
    {
        $country = Country::find($id);
        $country->name = $request->get('name');
        $country->slug = str_slug($request->get('name'));
        $country->active = false;

        if ($country->save()) {
            return $country;
        }

        return ['error' => 'Whooooops!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);

        if ($country->delete()) {
            return $country;
        }

        return ['error' => 'Whooooops!'];
    }
}