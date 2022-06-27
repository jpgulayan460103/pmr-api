<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <title>Stock Card</title>
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

        #pp-footer{
            width: 50%;
            border-collapse: collapse;
        }
        #pp-footer tr td{
            padding-left: 2pt;
            padding-right: 2pt;
            border: 1px solid black;
        }

        #pp-sig{
            width: 100%;
        }
        /* table {page-break-inside: auto;} */
    </style>
</head>
<body>

<!-- <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; text-align: center;z-index: -1000; ">
    <img src="{{ public_path('images/watermark.png') }}" style="width: 100%;">
</div> -->
<div id="pp-container">
        <p id="txt-header">STOCK CARD</p>
        <p>
            <i>
            ITEM <span id="txt-unit-head">{{ $item_name }}</span><br>
            </i>
        </p>
        <table id="pp-table">
            <thead>
                <tr>
                    <th>DATE</th>
                    <th>R.I.S</th>
                    <th>QTY</th>
                    <th>QTY</th>
                    <th>OFFICE</th>
                    <th>QTY</th>
                    <th>REMARK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item_supply_histories['data'] as $item_supply_history)
                <tr>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">{{  $item_supply_history['created_at_str'] }}</td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">{{  isset($item_supply_history['form_sourceable']) ? $item_supply_history['form_sourceable']['form_number'] : ""  }}</td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">
                        @if($item_supply_history['movement_type'] == "in")
                            {{ $item_supply_history['movement_quantity'] }}
                        @else
                            
                        @endif
                    </td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">
                        @if($item_supply_history['movement_type'] == "out")
                            {{ abs($item_supply_history['movement_quantity']) }}
                        @else
                            
                        @endif
                    </td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">
                        {{ isset($item_supply_history['form_sourceable']) ? $item_supply_history['form_sourceable']['end_user']['name'] : ""  }}
                    </td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">{{ $item_supply_history['remaining_quantity'] }}</td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;vertical-align: top;">{{ $item_supply_history['remarks'] }}</td>
                </tr>
                @endforeach
                @for($i = 0; $i<=(45 - count($item_supply_histories['data'])); $i ++)
                <tr>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;">&nbsp;</td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;"></td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;"></td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;"></td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;"></td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;"></td>
                    <td style="text-align: center;border-bottom: 0;border-top: 0;"></td>
                </tr>
                @endfor
            </tbody>
            <tfoot>
            <tr>
                    <td style="text-align: center;border-top: 0;">&nbsp;</td>
                    <td style="text-align: center;border-top: 0;"></td>
                    <td style="text-align: center;border-top: 0;"></td>
                    <td style="text-align: center;border-top: 0;"></td>
                    <td style="text-align: center;border-top: 0;"></td>
                    <td style="text-align: center;border-top: 0;"></td>
                    <td style="text-align: center;border-top: 0;"></td>
                </tr>
            </tfoot>
        </table>
</div>
</body>
</html> 