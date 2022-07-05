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
<htmlpageheader name="page-header">
{PAGENO}
</htmlpageheader>

<htmlpagefooter name="page-footer">
	Your Footer Content
</htmlpagefooter>
<!-- <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; text-align: center;z-index: -1000; ">
    <img src="{{ public_path('images/watermark.png') }}" style="width: 100%;">
</div> -->
<div id="pp-container">
        <p id="txt-header">{{ strtoupper($procurement_plan_type['name']) }}</p>
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
                <tr>
                    <th colspan="16" style="background-color: #D6EEEE; text-align:left;">PART I. AVAILABLE AT PROCUREMENT SERVICE STORES</th>
                </tr>
                @foreach($itemsA as $key => $item)
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
                <!-- @for($i = 0; $i<=(3 - $count_items_a); $i ++)
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
                @endfor -->
                <tr>
                    <th colspan="3" style="background-color: #EED6D6; text-align:left;">GRAND TOTAL FOR ANNEX A</th>
                    <th style="background-color: #EED6D6; text-align:right;">{{ number_format(($total_price_a), 2) }}</th>
                    <th colspan="12" style="background-color: #EED6D6; text-align:left;"></th>
                </tr>
                <tr>
                    <th colspan="16" style="background-color: #D6EEEE; text-align:left;">PART II. OTHER ITEMS NOT AVALABLE AT PS BUT REGULARLY PURCHASED FROM OTHER SOURCES (Note: Please indicate price of items)</th>
                </tr>
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
                @foreach($itemsB as $key => $item)
                <tr>
                    <td style="height: 40pt;"></td>
                    <td>{{ $item['description'] }}</td>
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
                <!-- @for($i = 0; $i<=(3 - $count_items_b); $i ++)
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
                @endfor -->
                <tr>
                    <th colspan="3" style="background-color: #EED6D6; text-align:left;">GRAND TOTAL FOR ANNEX B</th>
                    <th style="background-color: #EED6D6; text-align:right;">{{ number_format(($total_price_b), 2) }}</th>
                    <th colspan="12" style="background-color: #EED6D6; text-align:left;"></th>
                </tr>
            </tbody>
        </table>
        <br>
        <table id="pp-footer">
            <tr>
                <td>
                    <b>TOTAL BUDGET:</b>
                </td>
                <td style="text-align: right;">
                    {{ number_format(($total_price_a + $total_price_b), 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>+ 10% Provision for Inflation</b>
                </td>
                <td style="text-align: right;">
                    {{ number_format(($inflation_a + $inflation_b), 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>+ 10% Contingency</b>
                </td>
                <td style="text-align: right;">
                    {{ number_format(($contingency_a + $contingency_b), 2) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>TOTAL ESTIMATED BUDGET:  </b>
                </td>
                <td style="text-align: right;">
                    {{ number_format(($total_estimated_budget_a + $total_estimated_budget_b), 2) }}
                </td>
            </tr>
        </table>
        <p>
        NOTE:      Technical Specifications for each Item/Project being proposed shall be submitted as part of the PPMP
        </p>
        <table id="pp-sig">
            <tr>
                <td style="width: 33%;">Prepared by:</td>
                <td style="width: 33%;">Certified by:</td>
                <td style="width: 33%;">Approved by:</td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <br>    
                    <b>{{ $is_prepared_signed ? strtoupper($prepared_by_name) : ""}}</b><br>
                    {{ $is_prepared_signed ? $prepared_by_designation : "" }}
                </td>
                <td style="text-align: center;">
                    <br>    
                    <b>{{ $is_certified_signed ? strtoupper($certified_by_name) : "" }}</b><br>
                    {{ $is_certified_signed ? $certified_by_designation : "" }}
                </td>
                <td style="text-align: center;">
                    <br>    
                    <b>{{ $is_approved_signed ? strtoupper($approved_by_name) : "" }}</b><br>
                    {{ $is_approved_signed ? $approved_by_designation : ""}}
                </td>
            </tr>
        </table>
</div>
</body>
</html> 