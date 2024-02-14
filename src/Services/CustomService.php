<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Providers\HttpServiceProvider;
use Illuminate\Http\Request;
use Exception;

class CustomService
{
    public function post(Request $request, String $url = NULL)
    {
        try {
            $data = ChargifyHelper::post("/$url.json", $request->all());
            $data = json_decode($data);
            if (isset($data->errors)) {
                throw new Exception(implode(' ', $data->errors));
            }
            if (isset($data->error)) {
                throw new Exception($data->error);
            }
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::CREATED,
                'message' => 'Created.',
                'result' => $data
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function put(Request $request, String $url = NULL)
    {
        try {
            $data = ChargifyHelper::put("/$url.json", $request->all());
            $data = json_decode($data);
            if (isset($data->errors)) {
                throw new Exception(implode(' ', $data->errors));
            }
            if (isset($data->error)) {
                throw new Exception($data->error);
            }
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Updated.',
                'result' => $data
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function get(Request $request, String $url = NULL)
    {
        try {
            $params = http_build_query($request->all(), '', '&');
            $data = ChargifyHelper::get("/$url.json?$params");
            $data = json_decode($data);
            if (isset($data->errors)) {
                throw new Exception(implode(' ', $data->errors));
            }
            if (isset($data->error)) {
                throw new Exception($data->error);
            }
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Success.',
                'result' => $data
            ];
        } catch (Exception $e) {
            return (object)[
                'status' => false,
                'code' => HttpServiceProvider::BAD_REQUEST,
                'message' => $e->getMessage()
            ];
        }
    }
    public function delete(String $url = NULL)
    {
        try {
            $data = ChargifyHelper::delete("/$url.json");
            $data = json_decode($data);
            if (isset($data->errors)) {
                throw new Exception(implode(' ', $data->errors));
            }
            if (isset($data->error)) {
                throw new Exception($data->error);
            }
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Deleted.',
                'result' => $data
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