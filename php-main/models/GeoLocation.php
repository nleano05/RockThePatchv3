<?php

/**
 * Class GeoLocation
 * @author - Patches
 * @version - 1.0
 * @history - Created 10/25/2015/
 */
class GeoLocation {
    private $country;
    private $state;
    private $city;

    /**
     * @param string|NULL $country
     * @param string|NULL $state
     * @param string|NULL $city
     */
    public function __construct($country = NULL, $state = NULL, $city = NULL) {
        if (is_string($country) || $country == NULL) {
            $this->country = $country;
        } else {
            trigger_error('Expected a string or null for $country.', E_USER_WARNING);
        }
        if (is_string($state) || $state == NULL) {
            $this->state = $state;
        } else {
            trigger_error('Expected a string or null for $state.', E_USER_WARNING);
        }
        if (is_string($city) || $city == NULL) {
            $this->city = $city;
        } else {
            trigger_error('Expected a string or null for $city.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $country
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param string|NULL $country
     */
    public function setCountry($country) {
        if (is_string($country) || $country == NULL) {
            $this->country = $country;
        } else {
            trigger_error('Expected a string or null for $country.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $state
     */
    public function getState() {
        return $this->state;
    }

    /**
     * @param string|NULL $state
     */
    public function setState($state) {
        if (is_string($state) || $state == NULL) {
            $this->state = $state;
        } else {
            trigger_error('Expected a string or null for $state.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $city
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @param string|NULL $city
     */
    public function setCity($city) {
        if (is_string($city) || $city == NULL) {
            $this->city = $city;
        } else {
            trigger_error('Expected a string or null for $city.', E_USER_WARNING);
        }
    }
}