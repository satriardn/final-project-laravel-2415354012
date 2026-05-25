<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Enums\SubscriptionStatus;
use Illuminate\Validation\Rules\Enum;

class SubscriptionController extends Controller
{
    public function index(): JsonResponse
    {
        $subscriptions = Subscription::query()
            ->with(["customer", "service"])
            ->get();

        return response()->json([
            "success" => true,
            "message" => "Subscriptions retrieved successfully",
            "data" => $subscriptions,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'service_id'  => ['required', 'integer', 'exists:services,id'],
            'start_date'  => ['nullable', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'      => ['nullable', new Enum(SubscriptionStatus::class)],
        ]);

        $data['status'] = $data['status'] ?? 'active';

        $subscription = Subscription::query()->create($data);
        $subscription->load(['customer', 'service']);

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully',
            'data'    => $subscription,
        ], 201);
    }

    public function show(int $subscription): JsonResponse
    {
        $subscription = Subscription::query()
            ->with(['customer', 'service'])
            ->find($subscription);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
                'errors'  => [],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Subscription retrieved successfully',
            'data'    => $subscription,
        ]);
    }

    public function update(Request $request, int $subscription): JsonResponse
    {
        $subscription = Subscription::query()->find($subscription);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
                'errors'  => [],
            ], 404);
        }

        $data = $request->validate([
            'customer_id' => ['sometimes', 'integer', 'exists:customers,id'],
            'service_id'  => ['sometimes', 'integer', 'exists:services,id'],
            'start_date'  => ['nullable', 'date'],
            'end_date'    => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'      => ['nullable', 'in:active,inactive,trial,isolir,dismantle'],
        ]);

        $subscription->update($data);
        $subscription->load(['customer', 'service']);

        return response()->json([
            'success' => true,
            'message' => 'Subscription updated successfully',
            'data'    => $subscription,
        ]);
    }

    public function activate(int $subscription): JsonResponse
{
    return $this->changeStatus($subscription, SubscriptionStatus::ACTIVE->value);
}

public function deactivate(int $subscription): JsonResponse
{
    return $this->changeStatus($subscription, SubscriptionStatus::INACTIVE->value);
}

public function trial(int $subscription): JsonResponse
{
    return $this->changeStatus($subscription, SubscriptionStatus::TRIAL->value);
}

public function isolir(int $subscription): JsonResponse
{
    return $this->changeStatus($subscription, SubscriptionStatus::ISOLIR->value);
}

public function dismantle(int $subscription): JsonResponse
{
    return $this->changeStatus($subscription, SubscriptionStatus::DISMANTLE->value);
}

private function changeStatus(int $subscriptionId, string $status): JsonResponse
{
    $subscription = Subscription::find($subscriptionId);

    if (!$subscription) {
        return response()->json([
            'success' => false,
            'message' => 'Subscription not found',
        ], 404);
    }

    if (SubscriptionStatus::DISMANTLE->value) {
        return response()->json([
            'success' => false,
            'message' => 'Subscription are dismantle please create new Sub',
        ], 404);
    }

    $subscription->update([
        'status' => $status
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Subscription status updated successfully',
        'data' => $subscription,
    ]);
}
}
