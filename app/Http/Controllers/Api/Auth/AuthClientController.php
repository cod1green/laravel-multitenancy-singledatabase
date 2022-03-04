<?php
namespace App\Http\Controllers\Api\Auth;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ClientResource;

class AuthClientController extends ApiController
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        try {
            $client = Client::where('email', $request->email)->first();

            if (!$client || ! Hash::check($request->password, $client->password)) {
                return $this->errorResponse(__('messages.invalid_credentials'), 404);
            }

            $token = $client->createToken($request->device_name)->plainTextToken;

            return $this->successResponse(['token' => $token]);

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function me(Request $request)
    {
        $client = auth()->user();

        return $this->successResponse(new ClientResource($client));
    }

    public function logout(Request $request)
    {
        $client = $request->user();

        $client->tokens()->delete();

        return $this->successResponse('', '', 204);
    }
}
