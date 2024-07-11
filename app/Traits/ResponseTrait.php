<?php

namespace App\Traits;

trait ResponseTrait
{
    /**
     * Réponse de succès.
     *
     * @param mixed $data Les données à renvoyer dans la réponse.
     * @param string $message Message associé à la réponse.
     * @param int $statusCode Code de statut HTTP de la réponse.
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $message = '', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Réponse d'erreur.
     *
     * @param string $message Message d'erreur à renvoyer dans la réponse.
     * @param int $statusCode Code de statut HTTP de la réponse.
     * @param mixed|null $data Données supplémentaires à renvoyer dans la réponse.
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $statusCode = 500, $data = null)
    {
        return response()->json([
            'success' => false,
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data ?? []
        ], $statusCode);
    }
}
