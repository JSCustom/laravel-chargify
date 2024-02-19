<?php

namespace JSCustom\Chargify\Http\Controllers\Invoices;

use JSCustom\Chargify\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function listInvoice(Request $request)
    {
        $invoice = $this->_invoiceService->listInvoice($request);
        return response(['status' => $invoice->status, 'code' => $invoice->code, 'message' => $invoice->message, 'result' => $invoice->result ?? NULL], $invoice->code);
    }
    public function readInvoice(String $id)
    {
        $invoice = $this->_invoiceService->readInvoice($id);
        return response(['status' => $invoice->status, 'code' => $invoice->code, 'message' => $invoice->message, 'result' => $invoice->result ?? NULL], $invoice->code);
    }
    public function downloadInvoice(String $id)
    {
        $invoice = $this->_invoiceService->readInvoice($id, true);
        return response(['status' => $invoice->status, 'code' => $invoice->code, 'message' => $invoice->message, 'result' => $invoice->result ?? NULL], $invoice->code);
    }
}