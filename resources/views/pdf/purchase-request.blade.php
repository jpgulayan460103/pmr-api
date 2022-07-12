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
            @if(isset($view) && $view == "preview")
            background: url("{{ public_path('images/watermark.png') }}") no-repeat 0 0;
            @endif
            
        }
        #pr-table{
            width: 98%;
            /* border: 1px solid black; */
            border-collapse: collapse;
            border-top: 0;
        }
        #pr-table tr td{
            padding-left: 2pt;
            padding-right: 2pt;
            border: 1px solid black;
        }
        *{
            line-height: 1;
        }
        /* table {page-break-inside: auto;} */
    </style>
</head>
<body>
<!-- <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; text-align: center;z-index: -1000; ">
    <img src="{{ public_path('images/watermark.png') }}" style="width: 100%;">
</div> -->
<div id="pr-container">
        <table id="pr-table">
            <thead>
                <tr>
                    <td colspan="6" style="border: 0;text-align:right">Appendix 60</td>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;height:25pt">PURCHASE REQUEST</th>
                </tr>
                <tr>
                    <td colspan="4">Entity Name: <br> <b>Department of Social Welfare and Development Field Office XI</b></td>
                    <td colspan="2">Fund Cluster: <b>{{ $fund_cluster }}</b></td>
                </tr>
                <tr>
                    <td colspan="2">Office/Section:</td>
                    <td colspan="2"><b>{{ $end_user['name'] }}</b></td>
                    <td colspan="2">PR No.: <b>{{ $pr_number }}</b></td>
                </tr>
                <tr>
                    <td colspan="2"  style="text-align: center;"></td>
                    <td colspan="2">Responsibility Center Code: <b>{{ $center_code }}</b></td>
                    <td colspan="2">Date: <b>{{ $pr_date }}</b></td>
                </tr>
                <tr>
                    <td style="text-align: center">Stock/ Property No.</td>
                    <td style="text-align: center; width: 30pt;">Unit</td>
                    <td style="text-align: center; width: 220pt;">Item Description</td>
                    <td style="text-align: center; ">Quantity</td>
                    <td style="text-align: center;">Unit Cost</td>
                    <td style="text-align: center;">Total Cost</td>
                </tr>

            </thead>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>        @if( isset($form_process) )
        <!-- {{ $form_process['process_description'] }}:<br> -->
        <div style="font-size: 9pt;">
            @php
            $i = 0;
            @endphp
            @foreach($form_process['form_routes'] as $key => $route)
                @if($i != 0 && $route['status'] == "approved")
                    <span><span style='font-family:helvetica'>&#10004;</span>{{ $route['description_code'] == 'pr_approval_from_twg' ? "TWG: " : "" }}{{ $route['office_name'] }}</span><br>
                    @if($route['office_name'] == "Budget Section")
                    <div>
                        <span>&emsp;&emsp;Charge To: <b style="font-size: 9pt;">{{ $charge_to }}</b> </span><br>
                        <span>&emsp;&emsp;Amount:<b style="font-size: 9pt;">{{ number_format($alloted_amount, 2) }}</b></span><br>
                        <span>&emsp;&emsp;UACS Code:<b style="font-size: 9pt;">{{ $uacs_code['name'] }}</b></span><br>
                        <span>&emsp;&emsp;SA/OR:<b style="font-size: 9pt;">{{ $sa_or }}</b></span><br> 
                    </div>
                    @endif
                @endif
                
                @php
                $i++;
                @endphp
            @endforeach
        </div>
        @endif</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="text-align: center;font-weight: bold;">Total</td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right">{{ number_format($total_cost,2) }}</td>
                </tr>
                <tr>
                    <td colspan="6">Purpose: {{ $purpose }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 0"><br /><br />Signature:</td>
                    <td style="border-bottom: 0">Requested By:<br /><br />&nbsp;</td>
                    <td colspan="3" style="border-bottom: 0">Approved by:<br /><br />&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 0; border-bottom: 0">Printed Name:</td>
                    <td nowrap="nowrap" style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0">{{ $requested_by_name }}</td>
                    <td nowrap="nowrap" colspan="3" style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0; width: 220pt;">{{ $approved_by_name }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 0">Designation:</td>
                    <td nowrap="nowrap" style=" text-align: center; border-top: 0">{{ $requested_by_designation }}</td>
                    <td nowrap="nowrap" colspan="3" style=" text-align: center; border-top: 0">{{ $approved_by_designation }}</td>
                </tr>
                <!-- <tr>
                    <td colspan="6" style="border: 0;"></td>
                </tr> -->
            </tfoot>
            <tbody>
                <tr>
                    <td style="text-align: center;" colspan="2"><b>Title:</b></td>
                    <td colspan="4"><b>{{ $title }}</b></td>
                </tr>
                @foreach($items['data'] as $key => $item)
                <tr>
                    <td style="vertical-align: top; text-align: center">{{ $item['item_code'] }}</td>
                    <td style="vertical-align: top; text-align: center;">{{ $item['unit_of_measure']['name'] }}</td>
                    <td style="vertical-align: top; text-align: left;">{!! nl2br(e($item['item_name'])) !!}</td>
                    <!-- <td>{{ $item['item_name'] }}</td> -->
                    <td style="vertical-align: top; text-align: center;">{{ $item['quantity'] }}</td>
                    <td style="vertical-align: top; text-align: right;">{{ number_format($item['unit_cost'], 2) }}</td>
                    <td style="vertical-align: top; text-align: right;">{{ number_format($item['total_unit_cost'], 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="text-align: center"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"><b>*** NOTHING FOLLOWS ***</b></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"></td>
                </tr>
                @for($i = 0; $i<=(19 - $count_items); $i ++)
                <tr>
                    <td style="text-align: center">&nbsp;</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"></td>
                </tr>
                @endfor
            </tbody>
        </table>
</div>
</body>
</html>