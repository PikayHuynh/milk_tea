<?php

// Base URL configuration
define('BASE_URL', '/milk_tea/');

// Helper function to get asset URL
function asset_url($path) {
    // Remove leading slash if present
    $path = ltrim($path, '/');
    return BASE_URL . 'view/asset/' . $path;
}