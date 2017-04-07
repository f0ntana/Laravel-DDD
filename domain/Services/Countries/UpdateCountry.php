<?php

namespace Domain\Services\Countries;

use Domain\Entity\Country;
use Domain\Repository\Countries;
use Domain\Services\Service;

class UpdateCountry implements Service
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
     * @var int
     */
    private $id;

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
     * Set country will be created
     *
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }


    /**
     * Execute service
     * @return boolean
     */
    public function fire()
    {
        // REGRAS / EVENTOS - BEFORE

        $updated = $this->countries->update($this->id, $this->country);

        // REGRAS / EVENTOS - AFTER

        return $updated;
    }
}