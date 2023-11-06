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
        .ligne {
        display: table;
        width: 100%;
    }
    .ligne tr {
        display: table-row;
    }
    .ligne td {
        display: table-cell;
        padding: 10px;
        border: 1px solid #ccc; /* Ajoute une bordure */
    }
    .sender, .recipient {
        width: 50%; /* Divise la largeur en deux colonnes */
    }

        .container {
            
            width: 400px;
            margin: 20px auto;
        }

    

       
        .qr-code {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

    
       

        .qr-code {
            
            border: 1px solid black;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style> 
  
</head>

<body>
   
    <table class="ligne">
    <tr>
        <td class="sender">
            <h2>Expéditeur</h2>
            <p>Nom: {{ $colis->invoice->payement->customer->nom }}</p>
            <p>Adresse: {{ $colis->invoice->payement->customer->address }}</p>
            <p>Téléphone: {{ $colis->invoice->payement->customer->phone }}</p>
        </td>
        <td class="recipient">
            <h2>Destinataire</h2>
            <p>Nom: {{ $colis->invoice->payement->receive->nom }}</p>
            <p>Adresse: {{ $colis->invoice->payement->receive->address }}</p>
            <p>Téléphone: {{ $colis->invoice->payement->receive->phone }}</p>
        </td>
    </tr>
</table>
    <div class="container">
        <!-- <div  class="ligne">        
            <div class="sender">
                <h2>Expéditeur</h2>
                <p>Nom: {{ $colis->invoice->payement->customer->nom }}</p>
                <p>Adresse: {{ $colis->invoice->payement->customer->address }}</p>                
                <p>Téléphone: {{ $colis->invoice->payement->customer->phone }}</p>
            </div>
            <div class="recipient">
                <h2>Destinataire</h2>
                <p>Nom: {{ $colis->invoice->payement->receive->nom }}</p>
                <p>Adresse: {{ $colis->invoice->payement->receive->address }}</p>               
                <p>Téléphone: {{ $colis->invoice->payement->receive->phone }}</p>
            </div>
         </div> -->
        
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