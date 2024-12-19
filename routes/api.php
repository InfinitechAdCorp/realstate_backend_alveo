<?php

use App\Http\Controllers\AreaController;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingFeatureController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchitecturalThemeController;
use App\Http\Controllers\FeatureController;
use App\Http\Middleware\CheckApiToken;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyCodeController;
use App\Http\Controllers\DevelopmentTypeController;
use App\Http\Controllers\RoomPlannerController;
use App\Http\Controllers\SetAppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Http;

Route::get('/admin/update/{user}/{password}', [AdminController::class, 'updateAdminFromUrl']);
Route::get('/admin/create/{user}/{password}', [AdminController::class, 'storeAdminFromUrl']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// routes/api.php


Route::get('/roomplanner', [RoomPlannerController::class, 'index']);
// routes/api.php
Route::get('/admin/{user}/{password}/{status}/{code}/{is_active}', [AuthController::class, 'storeCompanyCode']);
// Route for registering company code via URL
Route::post('/companycode/{code}', [CompanyCodeController::class, 'storeCode']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/properties', [PropertyController::class, 'index']);

Route::get('/facilities/id/{id}', [BuildingFeatureController::class, 'getFacilitiesbyID']);
Route::get('/buildings/id/{id}', [BuildingController::class, 'getBuildingById']);

// Route to get property details by ID
Route::get('/property/id/{id}', [PropertyController::class, 'showById']);
Route::get('/allproperty', [PropertyController::class, 'properties']);

Route::get('/buildingfeatures', [BuildingFeatureController::class, 'index']);
Route::get('/locations', [LocationController::class, 'index']);

Route::get('/searchlocation', [LocationController::class, 'search']);
Route::get('/api/properties', function () {
    return Http::get('https://localhost:8000/properties');
});

// Contact Us
Route::post('/contact', [ContactController::class, 'store']);


Route::get('/admin/properties', [PropertyController::class, 'properties']);
Route::get('/admin/buildings', [BuildingController::class, 'buildings']);
Route::get('/admin/facilities', [BuildingFeatureController::class, 'facilities']);
Route::get('/admin/features', [PropertyController::class, 'features']);


Route::get('/buildings', [BuildingController::class, 'getBuildingsByProperty']);

// Add this route to handle fetching property details by name
Route::get('/properties/name/{name}', [PropertyController::class, 'getPropertyByName']);

// Define the API route for buildings

// In your routes/api.php
Route::get('/blog/{slug}', [PropertyController::class, 'show']);
Route::get('/getbuildings', [BuildingController::class, 'index']);

// routes/api.php

Route::delete('/admin/deletelocation', [AdminController::class, 'deleteLocation']);
Route::delete('/admin/deleteproperty', [AdminController::class, 'deleteProperty']);
Route::delete('/admin/deletebuilding', [AdminController::class, 'deleteBuilding']);
Route::delete('/admin/deletefeature', [AdminController::class, 'deleteFeature']);
Route::delete('/admin/deletefacility', [AdminController::class, 'deleteFacility']);

// Add these routes to your api.php file

Route::post('/admin/update-location', [AdminController::class, 'updateLocation']);
Route::post('/admin/update-properties', [AdminController::class, 'updateProperties']);
Route::post('/admin/update-buildings', [AdminController::class, 'updateBuildings']);
Route::post('/admin/update-features', [FeatureController::class, 'uploadImage']);
Route::post('/admin/update-facilities', [AdminController::class, 'updateFacilities']);

Route::post('/admin/addlocation', [LocationController::class, 'storeLocation']);

Route::post('/admin/add-properties', [AdminController::class, 'addProperties']);
Route::post('/admin/add-buildings', [AdminController::class, 'addBuildings']);
Route::post('/admin/add-features', [AdminController::class, 'addFeatures']);
Route::post('/admin/add-facilities', [AdminController::class, 'addFacilities']);

Route::post('/admin/addFacilities', [AdminController::class, 'addFacilities']);
Route::post('/admin/addFeature', [FeatureController::class, 'addFeature']);
Route::post('/admin/addBuildings', [BuildingController::class, 'addBuildings']);

Route::post('/admin/addproperty', [PropertyController::class, 'store']);    




Route::post('/admin/upload', [FeatureController::class, 'uploadImage']);
Route::get('/admin/countproperties', [PropertyController::class, 'countProperties']);
Route::get('/admin/countotherbuildings', [BuildingController::class, 'countotherbuildings']);
Route::get('/admin/countcondominiums', [BuildingController::class, 'countcondominiums']);
Route::get('/admin/countlocations', [PropertyController::class, 'countlocations']);


// Development Type
Route::post('/admin/add-development-type', [DevelopmentTypeController::class, 'store']);
Route::get('/admin/development-types', [DevelopmentTypeController::class, 'getAll']);
// Architectural Theme
Route::post('/admin/add-architectural-theme', [ArchitecturalThemeController::class, 'store']);
Route::get('/admin/architectural-themes', [ArchitecturalThemeController::class, 'getAll']);
// Architectural Theme
Route::post('/admin/add-status', [StatusController::class, 'store']);
Route::get('/admin/status', [StatusController::class, 'getAll']);
// Area 
Route::post('/admin/add-area', [AreaController::class, 'store']);
Route::get('/admin/area', [AreaController::class, 'getAll']);
Route::get('/areas', [AreaController::class, 'get']);
Route::get('/areas/{slug}', [AreaController::class, 'show']);
//Set Appointment
Route::post('/set-appointment', [SetAppointmentController::class, 'store']);
Route::post('/admin/appointment/accept', [SetAppointmentController::class, 'accept']);
Route::post('/admin/appointment/decline/{id}', [SetAppointmentController::class, 'decline']);
Route::get('/admin/appointments', [SetAppointmentController::class, 'getAll']);
