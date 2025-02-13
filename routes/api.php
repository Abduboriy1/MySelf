<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/query-rag', function (Request $request) {
    $query = $request->input('query');
    

    if (!$query) {
        return response()->json(['error' => 'Query is required'], 400);
    }

    // Call the Python script running as a service
    $pythonServiceUrl = 'http://host.docker.internal:5000/query'; // Update with actual service URL if needed

    $response = Http::post($pythonServiceUrl, [
        'query' => $query,
    ]);

    return $response->json();
});