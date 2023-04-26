<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapport Client Credit PDF</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <h4 class="" style="font-size: 26px;background: #ddd;">
                                <i class="fas fa-globe text-indigo"></i> Express, Colis.
                            </h4>
                        </td>
                        <td width="50%">
                            <h4 class="" style="font-size: 20px;">Titre :<span style="font-size: 18px"> {{ $entrepot->name
                                    }}</span></h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div>
            <hr>
            <table>
                <tbody>
                    <tr>
                        <td width="38%"></td>
                        <td width=""><strong>LISTE DES COLIS DE {{ $entrepot->name }}</strong></td>
                        <td width="15%"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            
            <table  border="1" width="100%" cellspacing="0" style="margin-top: 5px">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Poids</th>
                        <th>Statut</th>
                        <th>Verification</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                @foreach ($colis as $colis)
                    <tr>
                        <td>{{ $colis->titre }}</td>
                        <td>{{ $colis->description }}</td>
                        <td>{{ $colis->poids }} kg</td>
                        <td>
                            @if ($colis->charge == 1)
                            <span class="badge "
                                style="background: #0044ff;color:white; padding: 3px;">
                                <i class="fa fa-ship"></i> Chargé</span>
                            @else 
                            <span class="badge "
                                style="background:  #ddd; color:black; padding: 3px;">
                                <i class="fas fa-times"></i> Non Chargé</span>                                                                                                       
                            @endif
                        </td>
                        <td> <strong>|<input type="checkbox" >Oui | <input type="checkbox" >Non |</strong></td>
                        {{-- <td></td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

      </div>

    <div>
        <hr style="margin-bottom: 0px;">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 40%;">
                        <p>Fait à ______________________, le {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
                    </td>
                    <td style="width: 25%;"></td>
                    <td style="width: 40px; text-align: center;">
                        <p style="text-align: center; font-weight: bold"> Signature du Responsable</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>