{{-- <html>
    <head>
    <title>Faktur Pembayaran</title>
    <style>
    
    #tabel
    {
    font-size:15px;
    border-collapse:collapse;
    }
    #tabel  td
    {
    padding-left:5px;
    border: 1px solid black;
    }
    </style>
    </head>
    <body style='font-family:tahoma; font-size:8pt;' onload="window.print()">
    <center><table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
    <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
    <b>APOTEK GEMILANG FARMA</b></br>JL XXXXXXXXXXX XXXXXXX</span></br>
    
    
    <span style='font-size:12pt'>No. : xxxxx, 11 Juni 2020 (user:xxxxx), 11:57:50</span></br>
    </td>
    </table>
    <style>
    hr { 
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    } 
    </style>
    <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
    
    <tr align='center'>
    <td width='10%'>Item</td>
    <td width='13%'>Price</td>
    <td width='4%'>Qty</td>
    <td width='7%'>Diskon %</td>
    <td width='13%'>Total</td><tr>
    <td colspan='5'><hr></td></tr>
    </tr>
    <tr><td style='vertical-align:top'>3 WAY STOPCOCK</td>
    <td style='vertical-align:top; text-align:right; padding-right:10px'>7.440</td>
    <td style='vertical-align:top; text-align:right; padding-right:10px'>100</td>
    <td style='vertical-align:top; text-align:right; padding-right:10px'>0,00%</td>
    <td style='text-align:right; vertical-align:top'>744.000</td></tr>
    <tr>
    <td colspan='5'><hr></td>
    </tr>
    <tr>
    <td colspan = '4'><div style='text-align:right'>Biaya Adm : </div></td><td style='text-align:right; font-size:16pt;'>Rp3.500,00</td>
    </tr>
    <tr>
    <td colspan = '4'><div style='text-align:right; color:black'>Total : </div></td><td style='text-align:right; font-size:16pt; color:black'>747.500</td>
    </tr>
    <tr>
    <td colspan = '4'><div style='text-align:right; color:black'>Cash : </div></td><td style='text-align:right; font-size:16pt; color:black'>1.000.000</td>
    </tr>
    <tr>
    <td colspan = '4'><div style='text-align:right; color:black'>Change : </div></td><td style='text-align:right; font-size:16pt; color:black'>252.500</td>
    </tr>
    <tr>
    <td colspan = '4'><div style='text-align:right; color:black'>DP : </div></td><td style='text-align:right; font-size:16pt; color:black'>0</td>
    </tr>
    <tr>
    <td colspan = '4'><div style='text-align:right; color:black'>Sisa : </div></td><td style='text-align:right; font-size:16pt; color:black'>0</td>
    </tr>
    </table>
    <table style='width:350; font-size:12pt;' cellspacing='2'><tr></br><td align='center'>****** TERIMAKASIH ******</br></td></tr></table></center></body>
</html> --}}

<!DOCTYPE html>
<html lang="en" >
 
    <head>
        <meta charset="UTF-8">
        <title>Almahyra</title>

        <style>
            @media print {
                .page-break { display: block; page-break-before: always; }
            }
            #invoice-POS {
                box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
                padding: 2mm;
                margin: 0 auto;
                width: 100mm;
                background: #FFF;
            }
            #invoice-POS ::selection {
                background: #f31544;
                color: #FFF;
            }
            #invoice-POS ::moz-selection {
                background: #f31544;
                color: #FFF;
            }
            #invoice-POS h1 {
                font-size: 1.5em;
                color: #222;
            }
            #invoice-POS h2 {
                font-size: .9em;
            }
            #invoice-POS h3 {
                font-size: 1.2em;
                font-weight: 300;
                line-height: 2em;
            }
            #invoice-POS p {
                font-size: .7em;
                color: #666;
                line-height: 1.2em;
            }
            #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
                /* Targets all id with 'col-' */
                border-bottom: 1px solid #EEE;
            }
            #invoice-POS #top {
                min-height: 50px;
            }
            #invoice-POS #mid {
                min-height: 40px;
            }
            #invoice-POS #bot {
                min-height: 50px;
            }
            #invoice-POS #top .logo {
                height: 40px;
                width: 150px;
                background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
                background-size: 150px 40px;
            }
            #invoice-POS .clientlogo {
                float: left;
                height: 60px;
                width: 60px;
                background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
                background-size: 60px 60px;
                border-radius: 50px;
            }
            #invoice-POS .info {
                display: block;
                margin-left: 0;
            }
            #invoice-POS .title {
                float: right;
            }
            #invoice-POS .title p {
                text-align: right;
            }
            #invoice-POS table {
                width: 100%;
                border-collapse: collapse;
            }
            #invoice-POS .tabletitle {
                font-size: .5em;
            }
            #invoice-POS .service {
                border-bottom: 1px solid #EEE;
            }
            /* #invoice-POS .item {
                width: 21mm;
            }
            #invoice-POS .Hours {
                width: 8mm;
            } */
            #invoice-POS .itemtext {
                font-size: .5em;
            }
        </style>
    
        <script>
            window.console = window.console || function(t) {};
        </script>

        <script>
            if (document.location.search.match(/type=embed/gi)) {
                window.parent.postMessage("resize", "*");
            }
        </script>
    </head>
 
    <body translate="no">
        <div id="invoice-POS">
        
            <center id="top">
            {{-- <div class="logo"></div> --}}
            <div class="info"> 
                <h2>Almahyra Jamur</h2>
                <p>Glenmore</p>
            </div><!--End Info-->
            </center><!--End InvoiceTop-->
        
            <div id="mid">
            <div class="info">
                <p> 
                    Petani   : {{ $petani->name }}<br>
                    Lokasi   : {{ $petani->lokasi }}<br>
                    Periode : {{ Carbon\Carbon::parse($tglAwal)->translatedFormat("d F Y") }} - {{ Carbon\Carbon::parse($tglAkhir)->translatedFormat("d F Y") }}
                </p>
            </div>
            </div><!--End Invoice Mid-->
        
            <div id="bot">
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item"><p style="font-size: 9px">Tgl</p></td>
                            <td class="Hours"><p style="font-size: 9px">Kg</p></td>
                            <td class="Rate"><p style="font-size: 9px">Harga</p></td>
                            <td class="Rate"><p style="font-size: 9px">Jumlah</p></td>
                        </tr>

                        @foreach ($dataPanen as $panen)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ Carbon\Carbon::parse($panen->tanggal)->translatedFormat("d/m/Y") }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $panen->berat }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($panen->hasil_penjualan/$panen->berat,0,',','.') }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($panen->hasil_penjualan,0,',','.') }}</p></td>
                        </tr>
                        @endforeach

                        <tr class="tabletitle">
                            <td class="Rate"><p style="font-size: 9px">Total</p></td>
                            <td class="Rate"><p style="font-size: 9px">{{ $berat }} Kg</p></td>
                            <td></td>
                            <td class="payment"><p style="font-size: 9px">Rp {{ number_format($total,0,',','.') }}</p></td>
                        </tr>

                    </table>
                </div><!--End Table-->

                {{-- <div id="legalcopy">
                    <p style="font-size: 8px" class="legal">
                        <i>*Bukti pembayaran yang sah</i>
                    </p>
                </div> --}}
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->

    </body>
 
</html>