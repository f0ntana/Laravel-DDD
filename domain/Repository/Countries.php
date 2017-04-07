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
     * @return bool
     */
    public function findById($id)
    {
        try {
            return $this->db()->table('countries')->find($id);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $id, Country $country
     * @return bool
     */

    public function update($id, Country $country)
    {
        try {
            $updated = $this->db()->table('countries')
                ->where('id', '=', $id)
                ->update([
                    'name' => $country->getName(),
                    'slug' => $country->getSlug(),
                    'active' => $country->isActive(),
                ]);

            if ($updated) {
                $country->setId($updated);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}