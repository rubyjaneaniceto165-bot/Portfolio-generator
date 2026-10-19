<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AccountDeletionController extends Controller
{
    public function destroy(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Please log in again before deleting your account.'
            ], 401);
        }

        $url = rtrim((string) config('services.supabase.url'), '/');
        $publishableKey = config('services.supabase.publishable_key');
        $serviceKey = config('services.supabase.service_role_key');

        if (!$url || !$publishableKey || !$serviceKey) {
            return response()->json([
                'message' => 'Account deletion is not configured yet.'
            ], 500);
        }

        try {
            // Verify the logged-in user.
            $userResponse = Http::withHeaders([
                'apikey' => $publishableKey,
                'Authorization' => 'Bearer ' . $token,
            ])->get($url . '/auth/v1/user');

            if (!$userResponse->successful()) {
                return response()->json([
                    'message' => 'Your session is invalid. Please log in again.'
                ], 401);
            }

            $userId = $userResponse->json('id');

            if (!$userId) {
                return response()->json([
                    'message' => 'Could not verify your account.'
                ], 401);
            }

            // Delete the user's saved portfolios.
            $portfolioResponse = Http::withHeaders([
                'apikey' => $serviceKey,
                'Authorization' => 'Bearer ' . $serviceKey,
                'Prefer' => 'return=minimal',
            ])->delete($url . '/rest/v1/portfolios', [
                'user_id' => 'eq.' . $userId,
            ]);

                if (!$portfolioResponse->successful()) {
                    Log::error('Portfolio cleanup failed.', [
                    'user_id' => $userId,
                    'status' => $portfolioResponse->status(),
                    ]);
                }

            // Permanently delete the Supabase Auth account.
            $deleteResponse = Http::withHeaders([
                'apikey' => $serviceKey,
                'Authorization' => 'Bearer ' . $serviceKey,
            ])->delete($url . '/auth/v1/admin/users/' . $userId);

            if (!$deleteResponse->successful()) {
                Log::error('Auth account deletion failed.', [
                    'user_id' => $userId,
                    'status' => $deleteResponse->status(),
                ]);

                return response()->json([
                    'message' => 'Portfolios were removed, but the account could not be deleted. Please contact support.'
                ], 500);
            }

            return response()->json([
                'message' => 'Your account has been deleted.'
            ]);

        } catch (\Throwable $exception) {
            Log::error('Account deletion request failed.', [
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
