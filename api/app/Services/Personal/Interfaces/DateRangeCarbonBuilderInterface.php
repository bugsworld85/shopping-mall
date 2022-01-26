<?php

namespace App\Services\Personal\Interfaces;

use App\Services\Personal\DateRangeCarbonBuilder;
use Carbon\Carbon;

/**
 * Default to 1 month from now.
 */
interface DateRangeCarbonBuilderInterface
{
    /**
     * Get start date.
     * @return Carbon
     */
    public function getStartDate(): Carbon;

    /**
     * Get end date.
     * @return Carbon
     */
    public function getEndDate(): Carbon;

    /**
     * Build the Carbon date range and return start and end date.
     * @return self
     */
    public function build(): self;
}
