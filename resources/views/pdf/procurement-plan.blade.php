<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <title>Purchase Request</title>
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
        <p id="txt-header">PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)</p>
        <p>
            <i>
            END-USER/UNIT <span id="txt-unit-head">{{ $end_user['name'] }}</span><br>
            <b>Charged to GAA</b><br>
            Projects, Programs and Activities (PAPs)
            </i>
        </p>
        <table id="pp-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 80pt;">CODE</th>
                    <th rowspan="2" style="width: 250pt;">GENERAL DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th rowspan="2"  style="width: 80pt;">ESTIMATED BUDGET</th>
                    <th colspan="12">SCHEDULE/MILESTONE OF ACTIVITIES</th>
                </tr>										 	

                <tr>
                    <th>SIZE</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>July</th>
                    <th>Aug</th>
                    <th>Sept</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items['data'] as $key => $item)
                <tr>
                    <td style="height: 40pt;">{{ $item['item']['item_code'] }}</td>
                    <td>{{ $item['item']['item_name'] }}</td>
                    <td style="text-align: center;">{{ $item['total_quantity'] }}</td>
                    <td style="text-align: right;">{{ number_format($item['total_price'], 2) }}</td>
                    <td style="text-align: center;">{{ $item['mon1'] }}</td>
                    <td style="text-align: center;">{{ $item['mon2'] }}</td>
                    <td style="text-align: center;">{{ $item['mon3'] }}</td>
                    <td style="text-align: center;">{{ $item['mon4'] }}</td>
                    <td style="text-align: center;">{{ $item['mon5'] }}</td>
                    <td style="text-align: center;">{{ $item['mon6'] }}</td>
                    <td style="text-align: center;">{{ $item['mon7'] }}</td>
                    <td style="text-align: center;">{{ $item['mon8'] }}</td>
                    <td style="text-align: center;">{{ $item['mon9'] }}</td>
                    <td style="text-align: center;">{{ $item['mon10'] }}</td>
                    <td style="text-align: center;">{{ $item['mon11'] }}</td>
                    <td style="text-align: center;">{{ $item['mon12'] }}</td>
                </tr>
                @endforeach
                @for($i = 0; $i<=(3 - $count_items); $i ++)
                <tr>
                    <td style="height: 40pt;"></td>
                    <td></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                </tr>
                @endfor
            </tbody>
        </table>
        <br>
        <table id="pp-footer">
            <tr>
                <td>
                    <b>TOTAL BUDGET:</b>
                </td>
                <td style="text-align: right;">
                    {{ number_format($total_price, 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>+ 10% Provision for Inflation</b>
                </td>
                <td style="text-align: right;">
                    {{ number_format($inflation, 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>+ 10% Contingency</b>
                </td>
                <td style="text-align: right;">
                    {{ number_format($contingency, 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>TOTAL ESTIMATED BUDGET:  </b>
                </td>
                <td style="text-align: right;">
                    {{ number_format($total_estimated_budget, 2) }}
                </td>
            </tr>
        </table>
        <p>
        NOTE:      Technical Specifications for each Item/Project being proposed shall be submitted as part of the PPMP
        </p>
        <table id="pp-sig">
            <tr>
                <td style="width: 33%;">Prepared by:</td>
                <td style="width: 33%;">Noted by:</td>
                <td style="width: 33%;">Approved by:</td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <br>    
                    <b>Prepared Name</b><br>
                    Position
                </td>
                <td style="text-align: center;">
                    <br>    
                    <b>Noted Name</b><br>
                    Position
                </td>
                <td style="text-align: center;">
                    <br>    
                    <b>Approved Name</b><br>
                    Position
                </td>
            </tr>
        </table>
</div>
</body>
</html> 