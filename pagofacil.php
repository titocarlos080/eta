<?php

// Datos de autenticación
$commerceID = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
$tokenService = "51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d5041c31d7cc6124be82afedc4fe926b806755efe678917468e31593a5f427c79cdf016b686fca0cb58eb145cf524f62088b57c6987b3bb3f30c2082b640d7c52907";
$tokenSecret = "9E7BC239DDC04F83B49FFDA5";

// Configurar la solicitud cURL
$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://serviciostigomoney.pagofacil.com.bo/api/servicio/pagoqr",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        "tcCommerceID" => $commerceID,
        "tcNroPago" => "23",
        "tcNombreUsuario" => "Jhon Doe",
        "tnCiNit" => 9999999,
        "tnTelefono" => 70000000,
        "tcCorreo" => "micorreo@mail.com",
        "tcCodigoClienteEmpresa" => "9",
        "tnMontoClienteEmpresa" => "1",
        "tnMoneda" => 2,
        "tcUrlCallBack" => "http://misitio.com/callback",
        "tcUrlReturn" => "http://misitio.com/return",
        "taPedidoDetalle" => [
            [
                "Serial" => 1,
                "Producto" => "Borrador",
                "Cantidad" => 1,
                "Precio" => "1",
                "Descuento" => 0,
                "Total" => "1"
            ]
        ]
    ]),
    CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Authorization: Bearer " . $tokenService, // Usando el TokenService como Bearer Token si es necesario
        "Content-Type: application/json"
    ],
]);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
