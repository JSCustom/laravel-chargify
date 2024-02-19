<?php

namespace JSCustom\Chargify\Services;

use JSCustom\Chargify\Helpers\ChargifyHelper;
use JSCustom\Chargify\Providers\HttpServiceProvider;
use JSCustom\Chargify\Utils\Urls;
use Illuminate\Http\Request;
use Exception;

class InvoiceService
{
    public function listInvoice(Request $request)
    {
        try {
            $params = http_build_query($request->all(), '', '&');
            $invoice = ChargifyHelper::get("/".Urls::INVOICES.".json?$params");
            $invoice = json_decode($invoice);
            if (isset($invoice->errors)) {
                throw new Exception(implode(' ', $invoice->errors));
            }
            $invoice = collect((object)$invoice)->pluck('invoice');
            return (object)[
                'status' => true,
                'code' => HttpServiceProvider::OK,
                'message' => 'Invoice list.',
                'result' => $invoice
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