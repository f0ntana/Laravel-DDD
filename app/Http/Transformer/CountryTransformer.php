<?php

namespace App\Http\Transformer;

use Domain\Entity\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
    public function transform(Country $country)
    {
        return [
            'id' => (int) $country->getId(),
            'name' => $country->getName(),
            'slug' => $country->getSlug(),
            'active' => (boolean) $country->isActive()
        ];
    }
}