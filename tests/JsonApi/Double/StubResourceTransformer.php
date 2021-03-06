<?php
declare(strict_types=1);

namespace WoohooLabs\Yin\Tests\JsonApi\Double;

use WoohooLabs\Yin\JsonApi\Schema\Links;
use WoohooLabs\Yin\JsonApi\Transformer\AbstractResourceTransformer;

class StubResourceTransformer extends AbstractResourceTransformer
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $meta;

    /**
     * @var Links|null
     */
    protected $links;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var array
     */
    protected $defaultRelationships;

    /**
     * @var array
     */
    protected $relationships;

    public function __construct(
        string $type = "",
        string $id = "",
        array $meta = [],
        Links $links = null,
        array $attributes = [],
        array $defaultRelationships = [],
        array $relationships = []
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->meta = $meta;
        $this->links = $links;
        $this->attributes = $attributes;
        $this->defaultRelationships = $defaultRelationships;
        $this->relationships = $relationships;
    }

    public function getType($domainObject): string
    {
        return $this->type;
    }

    public function getId($domainObject): string
    {
        return $this->id;
    }

    public function getMeta($domainObject): array
    {
        return $this->meta;
    }

    public function getLinks($domainObject): ?Links
    {
        return $this->links;
    }

    public function getAttributes($domainObject): array
    {
        return $this->attributes;
    }

    public function getDefaultIncludedRelationships($domainObject): array
    {
        return $this->defaultRelationships;
    }

    public function getRelationships($domainObject): array
    {
        return $this->relationships;
    }
}
