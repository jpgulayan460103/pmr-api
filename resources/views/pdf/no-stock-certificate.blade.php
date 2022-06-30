<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <title>Requisition and Issue Slip</title>
    <style>
         @page {
            /* margin: 0px 0px 0px 0px !important; */
            /* margin: 0px 0px 0px 0px !important; */
            /* padding: 10px 10px 10px 10px !important; */
            size: 8.5in 13in;
            font-size: 12pt;
            margin: 5%;
            background-image-resize: 6;
            opacity: 0.75;
            header: page-header;
            footer: page-footer;
            /* background: url("{{ public_path('images/watermark.png') }}") no-repeat 0 0; */
            
        }
        #pp-table{
            width: 100%;
            /* border: 1px solid black; */
            border-collapse: collapse;
            border-top: 0;
            font-size: 9pt;
        }
        #pp-table tr th{
            padding-left: 2pt;
            padding-right: 2pt;
            border: 1px solid black;
        }
        #pp-table tr td{
            padding-left: 2pt;
            padding-right: 2pt;
            border: 1px solid black;
        }
        *{
            line-height: 1;
        }
        #txt-header{
            text-align: center;
            font-weight: bold;
        }
        #txt-unit-head{
            font-weight: bold;
            text-decoration: underline;
        }

        #form-footer{
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        #form-footer tr td{
            padding-left: 2pt;
            padding-right: 2pt;
            border: 1px solid black;
        }

        #pp-sig{
            width: 100%;
        }
        #txt-appendix{
            text-align: right;
            line-height: 0;
            padding: 0;
            margin: 0;
            font-style: italic;
        }
        #form-header{
            font-size: 9pt;
            width: 100%;
            border-collapse: collapse;
        }
        /* table {page-break-inside: auto;} */
    </style>
</head>
<body>

<!-- <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; text-align: center;z-index: -1000; ">
    <img src="{{ public_path('images/watermark.png') }}" style="width: 100%;">
</div> -->
<div id="pp-container">
        <!-- <p id="txt-appendix">Appendix 63</p> -->
        <br>
        <br>
        <p id="txt-header">
            CERTIFICATE OF NON-AVAILABILITY OF STOCKS<br>
            (CNAS)
        </p>
        <br>
        <p>
            <b>{{ $cnas_number }}</b>
        </p>
        <table id="pp-table">
            <thead>
                <tr>
                    <th style="width: 70%;text-align: left">Item</th>
                    <th style="width: 20%;text-align: center">Unit Of Measure</th>
                    <th style="width: 10%;text-align: center">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items['data'] as $item)
                <tr>
                    <td style="width: 70%;text-align: left">{{ $item['description'] }}</td>
                    <td style="width: 20%;text-align: center">{{ $item['unit_of_measure'] }}</td>
                    <td style="width: 10%;text-align: center">{{ $item['quantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
</div>
</body>
</html> 