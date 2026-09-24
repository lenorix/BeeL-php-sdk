<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1AccountsGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<ManagedAccountSummary>
     */
    protected $accounts;
    /**
     * Pass as `cursor` for the next page; `null` when there are no more results.
     *
     * @var string|null
     */
    protected $nextCursor;
    /**
     * @return list<ManagedAccountSummary>
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }
    /**
     * @param list<ManagedAccountSummary> $accounts
     *
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->initialized['accounts'] = true;
        $this->accounts = $accounts;
        return $this;
    }
    /**
     * Pass as `cursor` for the next page; `null` when there are no more results.
     *
     * @return string|null
     */
    public function getNextCursor(): ?string
    {
        return $this->nextCursor;
    }
    /**
     * Pass as `cursor` for the next page; `null` when there are no more results.
     *
     * @param string|null $nextCursor
     *
     * @return self
     */
    public function setNextCursor(?string $nextCursor): self
    {
        $this->initialized['nextCursor'] = true;
        $this->nextCursor = $nextCursor;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['accounts' => ['accounts', 'getAccounts', 'setAccounts'], 'nextCursor' => ['next_cursor', 'getNextCursor', 'setNextCursor']];
    }
}