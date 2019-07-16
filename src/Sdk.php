<?php namespace Sonnenglas\AmazonMws;

use ReflectionClass;

class Sdk
{
    /**
     * @var array Configuration options for all services.
     */
    private $config;

    /**
     * @param array $config Configuration option values for all services.
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     *
     * @param string $name The class name.
     * @param array $args Arguments that will be passed to the class.
     * @return object
     * @throws \BadMethodCallException
     * @throws \ReflectionException
     */
    public function __call($name, array $args)
    {
        $class = $this->getClass($name);

        if (! class_exists($class)) {

            throw new \BadMethodCallException("Unknown class: {$class}.");
        }

        $objectReflection = new ReflectionClass($class);
        return $objectReflection->newInstanceArgs($args);
    }

    protected function getClass($name) {

        return "Amazon" . $name;
    }
}
