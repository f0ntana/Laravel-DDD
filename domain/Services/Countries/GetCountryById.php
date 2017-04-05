<?php

namespace Domain\Services\Countries;

use Domain\Entity\Country;
use Domain\Factory\Entity\CountryFactory;
use Domain\Repository\Countries;
use Domain\Services\Service;

class GetCountryById implements Service
{
    /**
     * @var Countries
     */
    private $countries;

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
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute service
     * @return Country
     * @throws \InvalidArgumentException
     */
    public function fire()
    {
        if (!$this->id) {
            throw new \InvalidArgumentException('Invalid Argument');
        }

        return CountryFactory::create($this->countries->findById($this->id));
    }
}