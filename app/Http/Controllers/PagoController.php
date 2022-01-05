<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function realizarPago(Request $request)
    {

        $receiverId = 336757;
        $secretKey  = '7e2e77f58ceb396aeb44339d3c3efb91593d8096';

        $configuration = new \Khipu\Configuration();
        $configuration->setReceiverId($receiverId);
        $configuration->setSecret($secretKey);

        $client   = new \Khipu\ApiClient($configuration);
        $payments = new \Khipu\Client\PaymentsApi($client);

        try {
            $opts = array(
                "transaction_id"     => "MTI-100",
                "return_url"         => "https://es-la.facebook.com/",
                "cancel_url"         => "https://www.youtube.com/watch?v=SigTkwy6Vac",
                "picture_url"        => "https://upload.wikimedia.org/wikipedia/commons/d/d6/Emblem_bolivar.png",
                "notify_url"         => "http://mi-ecomerce.com/backend/notify",
                "notify_api_version" => "1.3",
            );
            $response = $payments->paymentsPost(
                "Pedido Nro 1", //Motivo de la compra
                "BOB", //Monedas disponibles CLP, USD, ARS, BOB
                22.0, //Monto. Puede contener ","
                $opts //campos opcionales
            );
            $response = json_decode($response);
            /*"payment_id": "5vy0is3wxcg8",
            "payment_url": "https://khipu.com/payment/info/5vy0is3wxcg8",
            "simplified_transfer_url": null,
            "transfer_url": null,
            "webpay_url": null,
            "hites_url": null,
            "payme_url": null,
            "app_url": "khipu:///pos/5vy0is3wxcg8",
            "ready_for_terminal": false*/

            return response()->json(['url_pago' => $response->payment_url]);
        } catch (\Khipu\ApiException $e) {
            return response()->json(['dato' => $e->getResponseBody()]);
        }

    }
}
