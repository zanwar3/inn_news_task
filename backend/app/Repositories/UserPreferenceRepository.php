<?php

namespace App\Repositories;

use App\Models\UserPreference;

class UserPreferenceRepository
{
    public function getPreferencesByUserId($userId)
    {
        return UserPreference::where('user_id', $userId)->get();
    }

    public function savePreferences($userId, $preferences, $append = false)
    {
        // Delete existing preferences
        if (!$append) {
            UserPreference::where('user_id', $userId)->delete();
        }

        // Get categories and sources
        $categories = $preferences['categories'] ?? [];
        $sources = $preferences['sources'] ?? [];

        // Get the maximum length
        $maxLen = max(count($categories), count($sources));

        // Save new preferences
        for ($i = 0; $i < $maxLen; $i++) {
            UserPreference::create([
                'user_id' => $userId,
                'category' => $categories[$i] ?? null,
                'source' => $sources[$i] ?? null,
            ]);
        }
    }
}