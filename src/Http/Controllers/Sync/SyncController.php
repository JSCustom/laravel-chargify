<?php

namespace JSCustom\Chargify\Http\Controllers\Sync;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function syncImport()
    {
        $sync = $this->_syncService->syncImport();
        return response(['status' => $sync->status, 'code' => $sync->code, 'message' => $sync->message, 'result' => $sync->result ?? NULL], $sync->code);
    }
    public function syncExport()
    {
        $sync = $this->_syncService->syncExport();
        return response(['status' => $sync->status, 'code' => $sync->code, 'message' => $sync->message, 'result' => $sync->result ?? NULL], $sync->code);
    }
}
