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
                    Rekap Keuntungan<br>
                    Periode : {{ Carbon\Carbon::parse($tglAwal)->translatedFormat("d F Y") }} - {{ Carbon\Carbon::parse($tglAkhir)->translatedFormat("d F Y") }}
                </p>
            </div>
            </div><!--End Invoice Mid-->
        
            <div id="bot">
                {{-- Data Penjualan --}}
                <div id="table">
                    <table>
                        <p>Data Penjualan</p>
                        <tr class="tabletitle">
                            <td class="item"><p style="font-size: 9px">Tgl</p></td>
                            <td class="Hours"><p style="font-size: 9px">Kg</p></td>
                            <td class="Rate"><p style="font-size: 9px">Harga</p></td>
                            <td class="Rate"><p style="font-size: 9px">Jumlah</p></td>
                        </tr>

                        @foreach ($dataPenjualan as $penjualan)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat("d/m/Y") }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $penjualan->berat }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($penjualan->total_harga/$penjualan->berat,0,',','.') }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($penjualan->total_harga,0,',','.') }}</p></td>
                        </tr>
                        @endforeach

                        <tr class="tabletitle">
                            <td class="Rate"><p style="font-size: 9px">Total</p></td>
                            <td class="Rate"><p style="font-size: 9px">{{ $beratPenjualan }} Kg</p></td>
                            <td></td>
                            <td class="payment"><p style="font-size: 9px">Rp {{ number_format($totalPenjualan,0,',','.') }}</p></td>
                        </tr>

                    </table>
                </div><!--End Table-->

                {{-- Data Penjualan Sortir --}}
                <div id="table">
                    <table>
                        <p>Data Penjualan Sortir</p>
                        <tr class="tabletitle">
                            <td class="item"><p style="font-size: 9px">Tgl</p></td>
                            <td class="Hours"><p style="font-size: 9px">Kg</p></td>
                            <td class="Rate"><p style="font-size: 9px">Harga</p></td>
                            <td class="Rate"><p style="font-size: 9px">Jumlah</p></td>
                        </tr>

                        @foreach ($dataPenjualanSortir as $penjualans)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ Carbon\Carbon::parse($penjualans->tanggal)->translatedFormat("d/m/Y") }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $penjualans->berat_awal }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($penjualans->total_harga/$penjualans->berat_awal,0,',','.') }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($penjualans->total_harga,0,',','.') }}</p></td>
                        </tr>
                        @endforeach

                        <tr class="tabletitle">
                            <td class="Rate"><p style="font-size: 9px">Total</p></td>
                            <td class="Rate"><p style="font-size: 9px">{{ $beratPenjualanSortir }} Kg</p></td>
                            <td></td>
                            <td class="payment"><p style="font-size: 9px">Rp {{ number_format($totalPenjualanSortir,0,',','.') }}</p></td>
                        </tr>

                    </table>
                </div><!--End Table-->

                {{-- Data Panen --}}
                <div id="table">
                    <table>
                        <p>Data Panen</p>
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
                            <td class="Rate"><p style="font-size: 9px">{{ $beratPanen }} Kg</p></td>
                            <td></td>
                            <td class="payment"><p style="font-size: 9px">Rp {{ number_format($totalPanen,0,',','.') }}</p></td>
                        </tr>

                    </table>
                </div><!--End Table-->
                
                {{-- Data Panen Sortir --}}
                <div id="table">
                    <table>
                        <p>Data Panen Sortir</p>
                        <tr class="tabletitle">
                            <td class="item"><p style="font-size: 9px">Tgl</p></td>
                            <td class="Hours"><p style="font-size: 9px">Kg</p></td>
                            <td class="Rate"><p style="font-size: 9px">Harga</p></td>
                            <td class="Rate"><p style="font-size: 9px">Jumlah</p></td>
                        </tr>

                        @foreach ($dataPanenSortir as $panens)
                        <tr class="service">
                            <td class="tableitem"><p class="itemtext">{{ Carbon\Carbon::parse($panens->tanggal)->translatedFormat("d/m/Y") }}</p></td>
                            <td class="tableitem"><p class="itemtext">{{ $panens->berat }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($panens->total_harga/$panens->berat,0,',','.') }}</p></td>
                            <td class="tableitem"><p class="itemtext">Rp {{ number_format($panens->total_harga,0,',','.') }}</p></td>
                        </tr>
                        @endforeach

                        <tr class="tabletitle">
                            <td class="Rate"><p style="font-size: 9px">Total</p></td>
                            <td class="Rate"><p style="font-size: 9px">{{ $beratPanenSortir }} Kg</p></td>
                            <td></td>
                            <td class="payment"><p style="font-size: 9px">Rp {{ number_format($totalPanenSortir,0,',','.') }}</p></td>
                        </tr>

                    </table>
                </div><!--End Table-->

                {{-- Total --}}
                <?php $hasilPenjualan = $totalPenjualan + $totalPenjualanSortir ?>
                <?php $hasilPanen = $totalPanen + $totalPanenSortir ?>
                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="rate">Total Penjualan:</td>
                            <td></td>
                            <td></td>
                            <td class="payment">Rp {{ number_format($hasilPenjualan,0,',','.') }}</td>
                        </tr>
                        <tr class="tabletitle">
                            <td class="rate">Total Biaya Panen:</td>
                            <td></td>
                            <td></td>
                            <td class="payment">Rp {{ number_format($hasilPanen,0,',','.') }}</td>
                        </tr>
                        <tr class="tabletitle">
                            @if ($hasilPenjualan > $hasilPanen)
                            <td class="rate">Laba: </td>
                            <td></td>
                            <td></td>
                            <td class="payment">Rp {{ number_format($hasilPenjualan - $hasilPanen,0,',','.') }}</td>
                            @else
                            <td class="rate">Rugi: </td>
                            <td></td>
                            <td></td>
                            <td class="payment">Rp {{ number_format($hasilPanen - $hasilPenjualan,0,',','.') }}</td>
                            @endif
                            
                        </tr>
                    </table>
                </div>

                {{-- <div id="legalcopy">
                    <p style="font-size: 8px" class="legal">
                        <i>*Bukti pembayaran yang sah</i>
                    </p>
                </div> --}}
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->

    </body>
 
</html>