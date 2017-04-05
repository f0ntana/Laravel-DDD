<?php

namespace Domain\Services\Countries;

use Domain\Entity\Country;
use Domain\Repository\Countries;
use Domain\Services\Service;

class CreateCountry implements Service
{
    /**
     * @var Countries
     */
    private $countries;

    /**
     * @var Country
     */
    private $country;

    /**
     * CreateCountry constructor.
     *
     * @param Countries $countries
     */
    public function __construct(Countries $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Set country will be created
     *
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Execute service
     * @return boolean
     */
    public function fire()
    {
        // REGRAS / EVENTOS - BEFORE

        $created = $this->countries->create($this->country);

        // REGRAS / EVENTOS - AFTER

        return $created;
    }
}