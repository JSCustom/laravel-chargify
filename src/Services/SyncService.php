<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Models\{
    ChargifyCustomer
};
use JSCustom\Chargify\Providers\HttpServiceProvider;
use JSCustom\Chargify\Utils\Urls;
use Illuminate\Http\Request;
use Exception;

class SyncService
{
    public function syncImport()
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Sync import success.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function syncExport()
    {
        try {
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Sync export success.',
                'result' => null
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
}
?>