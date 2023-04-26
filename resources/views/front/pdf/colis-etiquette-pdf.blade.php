<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Étiquette d'expédition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            border: 2px solid black;
            padding: 20px;
            width: 400px;
            /* margin: 20px auto; */
        }

        h1,
        h2 {
            margin: 0;
        }

        .sender,
        .recipient,
        .package,
        .qr-code {
            margin-bottom: 20px;
            display: flex;
            /* Ajout de la propriété display: flex; */
            flex-direction: column;
            /* Spécification de la direction de flexion */
            align-items: flex-start;
            /* Alignement des éléments sur l'axe transversal */
        }

       
        .sender h2,
        .recipient h2,
        .package h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .sender p,
        .recipient p,
        .package p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .qr-code {
            height: 100px;
            /* width: 500px; */
            border: 1px solid black;
            margin: 0 auto;
            display: flex;
            /* Ajout de la propriété display: flex; */
            align-items: center;
            /* Alignement vertical des éléments */
            justify-content: center;
            /* Alignement horizontal des éléments */
        }
    </style>
</head>

<body>
    
    <div class="container">
        <div class="flex">        
            <div class="sender">
                <h2>Expéditeur</h2>
                <p>Nom: {{ $colis->invoice->payement->customer->nom }}</p>
                <p>Adresse: {{ $colis->invoice->payement->customer->address }}</p>
                {{-- <p>Ville: Montréal</p>
                <p>Province: Québec</p>
                <p>Code postal: H2X 1K1</p> --}}
                <p>Téléphone: {{ $colis->invoice->payement->customer->phone }}</p>
            </div>
            <div class="recipient">
                <h2>Destinataire</h2>
                <p>Nom: {{ $colis->invoice->payement->receive->nom }}</p>
                <p>Adresse: {{ $colis->invoice->payement->receive->address }}</p>
                {{-- <p>Ville: Montréal</p>
                <p>Province: Québec</p>
                <p>Code postal: H2X 1K1</p> --}}
                <p>Téléphone: {{ $colis->invoice->payement->receive->phone }}</p>
            </div>
         </div>
        {{-- <div class="package">
            <h2>Colis</h2>
            <p>Poids: 2.5 kg</p>
            <p>Dimensions: 30 cm x 20 cm x 10 cm</p>
            <p>Type de contenu: Livres</p>
            <p>Valeur déclarée: 50 $</p>
        </div> --}}
        <table width="100%" style="text-align: center">
            <tr>
                <td width="10%"></td>
                <td style="font-weight: bold; text-align: center">
                    {{ $colis->invoice->country->name }}-{{ $colis->invoice->countryr->name }}
                </td>
                <td width="10%"></td>
            </tr>
        </table>
        <div class="qr-code">
           
            <table width="100%" style="text-align: center">
                <tr>
                    <td width="10%"></td>
                    <td style="font-weight: bold; text-align: center">
                        {{-- {!! DNS1D::getBarcodeSVG($invoice->invoice_zip, "C39", 1, 80, 'black') !!} <br> --}}
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($colis->code_zip, 'C39+')}}"
                            alt="barcode" width="50%" height="100px" style="color: black" />
                        <span>CMR{{ $colis->code_zip }}</span>
                    </td>
                    <td width="10%"></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>