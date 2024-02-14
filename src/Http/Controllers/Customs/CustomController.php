<?php

namespace JSCustom\Chargify\Http\Controllers\Customs;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function post(Request $request, String $url = NULL)
    {
        $data = $this->_customService->post($request, $url);
        return response(['status' => $data->status, 'code' => $data->code, 'message' => $data->message, 'result' => $data->result ?? NULL], $data->code);
    }
    public function put(Request $request, String $url = NULL)
    {
        $data = $this->_customService->put($request, $url);
        return response(['status' => $data->status, 'code' => $data->code, 'message' => $data->message, 'result' => $data->result ?? NULL], $data->code);
    }
    public function get(Request $request, String $url = NULL)
    {
        $data = $this->_customService->get($request, $url);
        return response(['status' => $data->status, 'code' => $data->code, 'message' => $data->message, 'result' => $data->result ?? NULL], $data->code);
    }
    public function delete(String $url = NULL)
    {
        $data = $this->_customService->delete($request, $url);
        return response(['status' => $data->status, 'code' => $data->code, 'message' => $data->message, 'result' => $data->result ?? NULL], $data->code);
    }
}
?>