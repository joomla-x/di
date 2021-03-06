<?php
/**
 * Part of the Joomla Framework DI Package
 *
 * @copyright  Copyright (C) 2013 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\DI\Loader;

use Joomla\DI\Container;

/**
 * Fills a container with service providers from an ini string.
 * The key is the alias and the value the class which can be registered as
 * service provider.
 * The structure of the ini string must be:
 *
 * [providers]
 * dispatcher = "\\MyApp\\Service\\MyServiceProvider"
 *
 * @since  __DEPLOY_VERSION__
 */
class IniLoader implements LoaderInterface
{
    /** @var Container The container */
    private $container = null;

    /**
     * IniLoader constructor.
     *
     * @param   Container $container The container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Helper function to load the services from a file.
     *
     * @param   string $filename The filename
     *
     * @return  void
     *
     * @see LoaderInterface::load()
     */
    public function loadFromFile($filename)
    {
        $this->load(file_get_contents($filename));
    }

    /**
     * Loads service providers from the content.
     *
     * @param   string $content The content
     *
     * @return  void
     */
    public function load($content)
    {
        $services = parse_ini_string($content, true);

        if (!key_exists('providers', $services)) {
            return;
        }

        foreach ($services['providers'] as $alias => $service) {
            if (!class_exists($service)) {
                continue;
            }

            $this->container->registerServiceProvider(new $service, $alias);
        }
    }
}
