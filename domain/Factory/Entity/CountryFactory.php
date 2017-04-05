<?php

namespace Domain\Factory\Entity;

use Domain\Entity\Country;

class CountryFactory
{
    /**
     * Build a country entity
     *
     * @param $params
     * @return Country
     */
    static public function create($params)
    {
        if (is_object($params)) {
            $params = get_object_vars($params);
        }

        $entity = new Country();

        if (array_key_exists('id', $params)) {
            $entity->setId($params['id']);
        }

        if (array_key_exists('name', $params)) {
            $entity->setName($params['name']);
        }

        if (array_key_exists('slug', $params)) {
            $entity->setSlug($params['slug']);
        }

        if (array_key_exists('active', $params)) {
            $entity->setActive($params['active']);
        }

        return $entity;
    }

    /**
     * Create an collection of country
     *
     * @param array $records
     * @return array
     */
    static public function createFromCollection(array $records)
    {
        $output = [];

        array_map(function ($item) use (&$output) {
            $output[] = self::create($item);
        }, $records);

        return $output;
    }
}