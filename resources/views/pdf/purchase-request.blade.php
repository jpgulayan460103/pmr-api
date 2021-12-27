<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
         @page {
            /* margin: 0px 0px 0px 0px !important; */
            /* padding: 0px 0px 0px 0px !important; */
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

        #pr-container{
            width: 7.5in;
            font-size: 12pt;
        }
    </style>
</head>
<body>
<div id="pr-container">
        <table id="pr-table" page-break-inside: auto;>
            <thead>
                <tr>
                    <td colspan="6" style="border: 0;text-align:right">Appendix 60</td>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;height:25pt">PURCHASE REQUEST</th>
                </tr>
                <tr>
                    <td colspan="3">Entity Name: DSWD FO XI</td>
                    <td colspan="3">Fund Cluster: {{ $fund_cluster }}</td>
                </tr>
                <tr>
                    <td colspan="2">Office/Section:</td>
                    <td colspan="2">PR No.: {{ $purchase_request_number }}</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"  style="text-align: center;">{{ $end_user['name'] }}</td>
                    <td colspan="2">Responsibility Center Code: {{ $center_code }}</td>
                    <td colspan="2">Date: {{ $pr_date }}</td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 100pt;">Stock/ Property No.</td>
                    <td style="text-align: center; width: 30pt;">Unit</td>
                    <td style="text-align: center; width: 250pt;">Item Description</td>
                    <td style="text-align: center; width: 55pt;">Quantity</td>
                    <td style="text-align: center;">Unit Cost</td>
                    <td style="text-align: center;">Total Cost</td>
                </tr>

            </thead>
            <tbody>
               
            </tbody>
            <tbody>
                @foreach($items['data'] as $key => $item)
                <tr>
                    <td style="text-align: center">{{ $item['item_code'] }}</td>
                    <td style="text-align: center;">{{ $item['unit_of_measure']['name'] }}</td>
                    <td style="text-align: center; height: 5">{!! nl2br(e($item['item_name'])) !!}</td>
                    <!-- <td>{{ $item['item_name'] }}</td> -->
                    <td style="text-align: center;">{{ $item['quantity'] }}</td>
                    <td style="text-align: right;">{{ number_format($item['unit_cost'], 2) }}</td>
                    <td style="text-align: right;">{{ number_format($item['total_unit_cost'], 2) }}</td>
                </tr>
                @endforeach
                @for($i = 0; $i<=50; $i ++)
                <tr>
                    <td style="text-align: center">&nbsp;</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"></td>
                </tr>
                @endfor
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
                    <td style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0">MERLINDA A. PARAGAMAC</td>
                    <td colspan="3" style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0">RONALD RYAN R. CUI</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 0">Designation:</td>
                    <td style=" text-align: center; border-top: 0">OIC-ARD for Administration</td>
                    <td colspan="3" style=" text-align: center; border-top: 0">OIC - Regional Director</td>
                </tr>
            </tbody>
        </table>
</div>
</body>
</html>