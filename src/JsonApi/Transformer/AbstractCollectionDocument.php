<?php
namespace WoohooLabs\Yin\JsonApi\Transformer;

use WoohooLabs\Yin\JsonApi\Request\RelationshipRequest;
use WoohooLabs\Yin\JsonApi\Request\RequestInterface;

abstract class AbstractCollectionDocument extends AbstractCompoundDocument
{
    /**
     * @var \WoohooLabs\Yin\JsonApi\Transformer\AbstractResourceTransformer
     */
    protected $transformer;

    /**
     * @param \WoohooLabs\Yin\JsonApi\Transformer\AbstractResourceTransformer $transformer
     */
    public function __construct(AbstractResourceTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Sets the value of the "data" and "included" properties based on the "resource" property.
     *
     * @param \WoohooLabs\Yin\JsonApi\Request\RequestInterface $request
     */
    protected function setContent(RequestInterface $request)
    {
        $this->data = [];

        foreach ($this->domainObject as $item) {
            $this->data[] = $this->transformer->transformToResource($item, $request, $this->included);
        }
    }

    /**
     * Returns a response whose primary data is a relationship object with $relationshipName name.
     *
     * @param string $relationshipName
     * @param \WoohooLabs\Yin\JsonApi\Request\RequestInterface $request
     * @return array
     */
    protected function getRelationshipContent($relationshipName, RequestInterface $request)
    {
        $request = new RelationshipRequest($request, $this->transformer->getType($this->domainObject), $relationshipName);
        $content = [];

        foreach ($this->domainObject as $item) {
            $this->data[] = $this->transformer->transformRelationship(
                $item,
                $request,
                $this->included,
                $relationshipName
            );
        }

        return $content;
    }
}
