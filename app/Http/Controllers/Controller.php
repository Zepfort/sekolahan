<?php

namespace App\Http\Controllers;

abstract class Controller
{
protected function success($data, $statusCode, $message = 'success')
    {
        // Ambil data utama
        $rawItems = $data['data'] ?? $data;
        $formattedItems = [];

        if (!empty($rawItems)) {
            if (isset($rawItems[0]['name'])) {
                $formattedItems = [
                    [
                        'href' => request()->url(),
                        'data' => $rawItems,
                        '_links' => $data['_links'] ?? [] //  links spesifik
                    ]
                ];
            } else {
                $formattedItems = $rawItems;
            }
        }

        return response()->json([
            'collection' => [
                'status'    => true,
                'message'   => $message,
                'version'   => '1.0',
                'href'      => request()->fullUrl(),
                'items'     => $formattedItems,
                'queries'   => $data['queries'] ?? [],
                'template'  => $data['template'] ?? [],
            ],
            'status_code' => $statusCode
        ], $statusCode);
    }

    protected function failedResponse($message, $statusCode)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
            'status_code' => $statusCode
        ], $statusCode);
    }
}
