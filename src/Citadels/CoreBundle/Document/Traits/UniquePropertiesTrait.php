<?php
namespace Citadels\CoreBundle\Document\Traits;

trait UniquePropertiesTrait
{
    /**
     * @Doctrine\ODM\MongoDB\Mapping\Annotations\Collection(strategy="pushAll")
     * @var string[]
     */
    private $properties;

    /**
     * @return string[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string[] $properties
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param string $property
     */
    public function addProperty($property)
    {
        $properties = $this->getProperties() + [(string) $property];
        $this->setProperties(array_unique($properties));
    }

    /**
     * @param string $property
     */
    public function removeProperty($property)
    {
        $properties = array_diff($this->getProperties(), [$property]);
        $this->setProperties($properties);
    }
}
