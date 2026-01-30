<?php

// Base URL configuration
define('BASE_URL', '/milk_tea/');

// Helper function to get asset URL (for public assets)
function asset_url($path)
{
    // Remove leading slash if present
    $path = ltrim($path, '/');
    return BASE_URL . 'public/' . $path;
}

// Helper function to get admin asset URL (for view/admin assets)
function admin_asset_url($path)
{
    // Remove leading slash if present
    $path = ltrim($path, '/');
    return BASE_URL . 'public/admin/' . $path;
}

// Helper function to get user avatar URL
function get_avatar_url($avatar = null)
{
    // Common default avatar names
    $defaults = ['user.jpg', 'user.png', 'default.png', 'default.jpg'];

    if ($avatar && !empty($avatar) && !in_array($avatar, $defaults)) {
        // If it's a full URL (external), return as is
        if (filter_var($avatar, FILTER_VALIDATE_URL)) {
            return $avatar;
        }
        return asset_url('images/avatars/' . $avatar);
    }
    // Default avatar
    return admin_asset_url('img/user.png');
}

// Helper function to get product image URL
function get_product_image_url($image = null)
{
    if (!$image || empty($image)) {
        return asset_url('images/default.png');
    }

    // Check if it's already a full URL
    if (filter_var($image, FILTER_VALIDATE_URL)) {
        return $image;
    }

    // Try multiple possible paths
    $paths = [
        'public/images/' . $image,
        'public/client/images/' . $image,
    ];

    foreach ($paths as $relPath) {
        $fullPath = __DIR__ . '/../' . $relPath;
        if (file_exists($fullPath)) {
            // Convert relative path (starting with public/) to asset_url compatible path
            $assetPath = str_replace('public/', '', $relPath);
            return asset_url($assetPath);
        }
    }

    // Fallback if file not found locally
    return asset_url('images/default.png');
}