<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ProductQueryParams implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;

    /**
     * @var array
     */
    protected $initialized = [];

    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }

    /**
     * Product/service category:
     * * PRODUCT - Physical, tangible products
     * * SERVICE - General services
     * * CONSULTING - Consulting and advisory services
     * * SOFTWARE - Development, licenses, SaaS
     * * TRAINING - Courses, workshops, training
     * * OTHER - Other unclassified types
     *
     *
     * @var string
     */
    protected $category;

    /**
     * Filter by active/inactive status
     *
     * @var bool
     */
    protected $active;

    /**
     * Search in name, description or code
     *
     * @var string
     */
    protected $search;

    /**
     * Page number (0-indexed)
     *
     * @var int
     */
    protected $page = 0;

    /**
     * Page size
     *
     * @var int
     */
    protected $size = 20;

    /**
     * Product/service category:
     * * PRODUCT - Physical, tangible products
     * * SERVICE - General services
     * * CONSULTING - Consulting and advisory services
     * * SOFTWARE - Development, licenses, SaaS
     * * TRAINING - Courses, workshops, training
     * * OTHER - Other unclassified types
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Product/service category:
     * PRODUCT - Physical, tangible products
     * SERVICE - General services
     * CONSULTING - Consulting and advisory services
     * SOFTWARE - Development, licenses, SaaS
     * TRAINING - Courses, workshops, training
     * OTHER - Other unclassified types
     */
    public function setCategory(string $category): self
    {
        $this->initialized['category'] = true;
        $this->category = $category;

        return $this;
    }

    /**
     * Filter by active/inactive status
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Filter by active/inactive status
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * Search in name, description or code
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * Search in name, description or code
     */
    public function setSearch(string $search): self
    {
        $this->initialized['search'] = true;
        $this->search = $search;

        return $this;
    }

    /**
     * Page number (0-indexed)
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * Page number (0-indexed)
     */
    public function setPage(int $page): self
    {
        $this->initialized['page'] = true;
        $this->page = $page;

        return $this;
    }

    /**
     * Page size
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Page size
     */
    public function setSize(int $size): self
    {
        $this->initialized['size'] = true;
        $this->size = $size;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['category' => ['category', 'getCategory', 'setCategory'], 'active' => ['active', 'getActive', 'setActive'], 'search' => ['search', 'getSearch', 'setSearch'], 'page' => ['page', 'getPage', 'setPage'], 'size' => ['size', 'getSize', 'setSize']];
    }
}
