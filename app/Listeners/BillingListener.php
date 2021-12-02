<?php

namespace App\Listeners;

use App\Events\BillingEvent;
use App\Services\Interfaces\BillingServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BillingListener
{
    private $billingService;

    /**
     * Create the event listener.
     *
     * @param BillingServiceInterface $billingService
     */
    public function __construct(BillingServiceInterface $billingService)
    {
        $this->billingService = $billingService;
    }

    /**
     * Handle the event.
     *
     * @param  BillingEvent  $event
     * @return void
     */
    public function handle(BillingEvent $event)
    {
        $this->billingService->generateBilling($event->activityId);
    }
}
