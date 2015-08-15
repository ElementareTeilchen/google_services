<?php

/**
 * Sitemap provider
 *
 * @author Tim Lochmüller
 */

namespace FRUIT\GoogleServices\Service;

use TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Description of SitemapProvider
 */
class SitemapProvider
{

    /**
     * Provider Storage
     *
     * @var Array
     */
    private static $provider = array();

    /**
     * Add a Sitemap Provider
     *
     * @param string $className
     */
    public static function addProvider($className)
    {
        self::$provider[$className] = $className;
    }

    /**
     * Get all Providers
     *
     * @return array
     */
    public static function getProviders()
    {
        return self::$provider;
    }

    /**
     * Get a provider
     *
     * @param string $name
     *
     * @throws InvalidArgumentValueException
     * @return object
     */
    public static function getProvider($name)
    {
        if (!isset(self::$provider[$name])) {
            throw new InvalidArgumentValueException($name . ' not exists');
        }
        $obj = new ObjectManager();
        return $obj->get($name);
    }

    /**
     * @param $params
     * @param $ref
     */
    public function flexformSelection(&$params, &$ref)
    {
        $providers = self::getProviders();
        $params['items'] = array();

        foreach ($providers as $id => $provider) {
            $params['items'][] = array(
                $id,
                $id
            );
        }
    }

}