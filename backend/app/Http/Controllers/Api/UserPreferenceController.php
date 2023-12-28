<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserPreferenceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\SavePreferencesRequest;


class UserPreferenceController extends BaseController
{
    private $userPreferenceRepository;

    public function __construct(UserPreferenceRepository $userPreferenceRepository)
    {
        $this->userPreferenceRepository = $userPreferenceRepository;
    }

    public function getPreferences(Request $request)
    {
        $userId = $request->user()->id;

        $preferences = $this->userPreferenceRepository->getPreferencesByUserId($userId);
        
        return $this->sendResponse($preferences, "Success, Preferences found");
    }

    public function savePreferences(SavePreferencesRequest $request)
    {
        $userId = $request->user()->id;
        $preferences = $request->input('preferences');

        $this->userPreferenceRepository->savePreferences($userId, $preferences);

        return $this->sendResponse([], 'Success, Preferences saved');
    }
}