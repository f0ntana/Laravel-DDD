<?php

namespace Domain\Repository;

use Domain\Entity\Country;

class Countries extends Repository
{
    /**
     * @param Country $country
     * @return bool
     */
    public function create(Country $country)
    {
        try {
            $created = $this->db()->table('countries')->insertGetId([
                'name' => $country->getName(),
                'slug' => $country->getSlug(),
                'active' => $country->isActive(),
            ]);

            if ($created) {
                $country->setId($created);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $id
     * @return Country $country
     */
    public function findById($id)
    {
        try {
            return $find = $this->db()->table('countries')->find($id);
        } catch (\Exception $e) {
            return false;
        }
    }
}