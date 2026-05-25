<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/customers", [CustomerController::class, "index"])->name(
    "customers.index",
);
Route::post("/customers", [CustomerController::class, "store"])->name(
    "customers.store",
);
Route::patch("/customers/{id}", [CustomerController::class, "update"])->name(
    "customers.update",
);
Route::delete("/customers/{id}", [CustomerController::class, "destroy"])->name(
    "customers.destroy",
);
Route::patch("/customers/{id}/activate", [
    CustomerController::class,
    "activate",
])->name("customers.activate");
Route::patch("/customers/{id}/deactivate", [
    CustomerController::class,
    "deactivate",
])->name("customers.deactivate");

Route::get("/services", [ServiceController::class, "index"])->name(
    "services.index",
);
Route::post("/services", [ServiceController::class, "store"])->name(
    "services.store",
);
Route::patch("/services/{id}", [ServiceController::class, "update"])->name(
    "services.update",
);
Route::delete("/services/{id}", [ServiceController::class, "destroy"])->name(
    "services.destroy",
);
Route::patch("/services/{id}/activate", [
    ServiceController::class,
    "activate",
])->name("services.activate");
Route::patch("/services/{id}/deactivate", [
    ServiceController::class,
    "deactivate",
])->name("services.deactivate");

Route::get("/subscriptions", [SubscriptionController::class, "index"])->name(
    "subscriptions.index",
);
Route::post("/subscriptions", [SubscriptionController::class, "store"])->name(
    "subscriptions.store",
);
Route::patch("/subscriptions/{id}/activate", [
    SubscriptionController::class,
    "activate",
])->name("subscriptions.activate");
Route::patch("/subscriptions/{id}/deactivate", [
    SubscriptionController::class,
    "deactivate",
])->name("subscriptions.deactivate");
Route::patch("/subscriptions/{id}/trial", [
    SubscriptionController::class,
    "trial",
])->name("subscriptions.trial");
Route::patch("/subscriptions/{id}/isolir", [
    SubscriptionController::class,
    "isolir",
])->name("subscriptions.isolir");
Route::patch("/subscriptions/{id}/dismantle", [
    SubscriptionController::class,
    "dismantle",
])->name("subscriptions.dismantle");
