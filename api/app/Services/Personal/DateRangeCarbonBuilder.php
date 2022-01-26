<?php

namespace App\Services\Personal;

use App\Services\Personal\Interfaces\DateRangeCarbonBuilderInterface;
use Carbon\Carbon;

class DateRangeCarbonBuilder implements DateRangeCarbonBuilderInterface
{
    private string|null $startDate;
    private string|null $endDate;

    public Carbon $start;
    public Carbon $end;

    /**
     * Build date range into Carbon.
     * @param string|null $start Default to 1 month from now.
     * @param string|null $end Default to today.
     */
    public function __construct(string $start = null, string $end = null)
    {
        $this->startDate = $start;
        $this->endDate = $end;
    }

    public function getStartDate(): Carbon
    {
        return $this->startDate ?
            Carbon::createFromFormat('m-d-Y', $this->startDate)->startOfDay() :
            Carbon::now()->subMonth()->startOfDay();
    }

    public function getEndDate(): Carbon
    {
        return $this->endDate ?
            Carbon::createFromFormat('m-d-Y', $this->endDate)->endOfDay() :
            Carbon::now()->endOfDay();
    }

    public function build(): self
    {
        $this->start = $this->getStartDate();
        $this->end = $this->getEndDate();

        return $this;
    }
}
