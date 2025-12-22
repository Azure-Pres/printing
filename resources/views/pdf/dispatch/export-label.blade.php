<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRH Dispatch Label</title>

    <style>
        @page { size: A4; margin: 12mm; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            color: #000;
        }

        .label {
            border: 1px solid #000;
            padding: 14px 16px;
            margin-bottom: 20mm;
            font-size: 12px;
            line-height: 1.35;
        }

        .title { font-size: 20px; font-weight: bold; }
        .publisher { font-size: 17px; font-weight: bold; margin-top: 1px; }

        .on-sale{font-size: 17px;}
        .printed_in_india{font-size: 17px;}

        .divider {
            border-top: 1px solid #000;
            margin: 10px -16px;
        }

        .mono {
            font-family: "Courier New", monospace;
        }

        .mono-bold {
            font-family: "Courier New", monospace;
            font-size: 18px;
            font-weight: bold;
        }

        .ean-label {
            font-size: 34px;
            font-weight: bold;
        }

        .barcode-text {
            font-size: 11px;
            text-align: center;
            margin-top: 2px;
        }

        .price {
            {{-- font-weight: bold; --}}
            margin: 6px 0;
            text-align: center;
        }

        .barcode-wrapper {
            display: inline-block;
            margin: 0 auto;
            text-align: left;
        }

        .barcode-wrapper div {
            box-sizing: content-box;
        }

        table td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    @foreach ($labels as $l)
    <div class="label">
        <div class="title">Title: {{ $l['title'] }}</div>
        <div class="publisher">Publisher: {{ $l['publisher'] }}</div>

        <table width="100%">
            <tr>
                <td align="left" class="on-sale">On Sale: {{ $l['on_sale'] }}</td>
                <td align="right" class="printed_in_india">PRINTED IN INDIA</td>
            </tr>
        </table>

        <div class="divider"></div>

        <table width="100%">
            <tr>
                <td width="35%" class="mono-bold">ISBN: {{ $l['isbn'] }}<br>BATCH: {{ $l['batch'] }}</td>
                <td width="30%" align="center">
                    <span>BARCODE</span>
                    <div class="ean-label">EAN</div>
                </td>
                <td width="35%" align="center" class="mono">PPON: {{ $l['ppon'] }}<br><br>{!! DNS1D::getBarcodeHTML('(251)'.$l['ppon'], 'C128', 1.3, 35) !!}<div class="barcode-text">(251){{ $l['ppon'] }}</div></td>
            </tr>
        </table>

        <div class="divider"></div>

        <table width="100%" class="mono">
            <tr>
                <td width="50%" align="center">
                    CTN QTY: {{ $l['ctn_qty'] }}<br>

                    <div class="barcode-wrapper">
                        {!! DNS1D::getBarcodeHTML('(30)'.$l['ctn_qty'], 'C128', 1.0, 38) !!}
                    </div>
                    <div class="barcode-text">(30){{ $l['ctn_qty'] }}</div><br>
                    ISBN: {{ $l['isbn'] }}<br>

                    <div class="barcode-wrapper">
                        {!! DNS1D::getBarcodeHTML('(01)'.preg_replace('/[^0-9]/','',$l['isbn']).'0','C128', 1.0, 38) !!}
                    </div>
                    <div class="barcode-text">(01){{ preg_replace('/[^0-9]/','',$l['isbn']) }}0</div>
                </td>

                <td width="50%" align="center">
                    CTN WGT: {{ $l['ctn_wgt'] }} lbs<br>

                    <div class="barcode-wrapper">{!! DNS1D::getBarcodeHTML('(3401)000293', 'C128', 1.0, 38) !!}</div>
                    <div class="barcode-text">(3401)000293</div>
                    <div class="price">COVER PRICE: ${{ $l['usd'] }} USD / ${{ $l['cad'] }} CAD</div>
                    <div class="barcode-wrapper">{!! DNS1D::getBarcodeHTML('(9012Q)999USD', 'C128', 1.0, 38) !!}</div>
                    <div class="barcode-text">(9012Q)999USD</div>
                </td>
            </tr>
        </table>
    </div>
    @endforeach
</body>
</html>