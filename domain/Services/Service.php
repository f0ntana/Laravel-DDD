<?php

namespace Domain\Services;

interface Service
{
    /**
     * Execute service
     * @return boolean
     */
    public function fire();
}