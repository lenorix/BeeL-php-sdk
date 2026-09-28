<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200 implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;

    /**
     * Live recurring schedules of this company and the money behind them, in two blocks that
     * are **never added together**.
     *
     * `active` is a forecast: what is going to be invoiced if nothing breaks. `stopped` is the
     * opposite — invoicing that should be happening and is not, because the unattended
     * generation failed. They answer different questions, so there is no grand total here and
     * you should not compute one.
     *
     * Schedules **a person paused**, and those parked by a plan downgrade, are in **neither**
     * block: they are not a forecast (they will not generate) and not a breakage to fix
     * (someone decided they should not invoice). Completed schedules are in neither block
     * either.
     *
     *
     * @var RecurringInvoiceStats
     */
    protected $data;

    /**
     * @var ResponseMeta
     */
    protected $meta;

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;

        return $this;
    }

    /**
     * Live recurring schedules of this company and the money behind them, in two blocks that
     * are **never added together**.
     *
     * `active` is a forecast: what is going to be invoiced if nothing breaks. `stopped` is the
     * opposite — invoicing that should be happening and is not, because the unattended
     * generation failed. They answer different questions, so there is no grand total here and
     * you should not compute one.
     *
     * Schedules **a person paused**, and those parked by a plan downgrade, are in **neither**
     * block: they are not a forecast (they will not generate) and not a breakage to fix
     * (someone decided they should not invoice). Completed schedules are in neither block
     * either.
     */
    public function getData(): RecurringInvoiceStats
    {
        return $this->data;
    }

    /**
     * Live recurring schedules of this company and the money behind them, in two blocks that
    are **never added together**.

    `active` is a forecast: what is going to be invoiced if nothing breaks. `stopped` is the
    opposite — invoicing that should be happening and is not, because the unattended
    generation failed. They answer different questions, so there is no grand total here and
    you should not compute one.

    Schedules **a person paused**, and those parked by a plan downgrade, are in **neither**
    block: they are not a forecast (they will not generate) and not a breakage to fix
    (someone decided they should not invoice). Completed schedules are in neither block
    either.
     */
    public function setData(RecurringInvoiceStats $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }

    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }

    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}
