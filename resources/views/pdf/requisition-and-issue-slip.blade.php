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
        <p id="txt-appendix">Appendix 63</p>
        <p id="txt-header">REQUISITION AND ISSUE SLIP</p>
        <table id="form-header">
            <tr>
                <td style="width: 60%;">Entity Name: <b>Department of Social Welfare and Development</b></td>
                <td>Fund Cluster:</td>
            </tr>
            <tr>
                <td style="border: 1px solid black;vertical-align: top;">
                    Division: <b>{{ $end_user['parent']['name'] }}</b><br>
                    Office: <b>{{ $end_user['name'] }}</b>
                </td>
                <td style="border: 1px solid black;vertical-align: top;">
                    Responsibility Center Code: <br>
                    RIS No.: <b>{{ $ris_number }}</b>
                </td>
            </tr>
        </table>
        <table id="pp-table">
            <thead>
                <tr>
                    <th colspan="4">Requisition</th>
                    <th colspan="2">Stock Available</th>
                    <th colspan="2">Issue</th>
                </tr>
                <tr>
                    <td style="text-align: center; width: 45pt;">Stock No.</td>
                    <td style="text-align: center; width: 55pt;">Unit</td>
                    <td style="text-align: center; width: 220pt;">Description</td>
                    <td style="text-align: center; width: 35pt;">Quantity</td>
                    <td style="text-align: center; width: 45pt;">Yes</td>
                    <td style="text-align: center; width: 45pt;">No</td>
                    <td style="text-align: center; width: 35pt;">Quantity</td>
                    <td style="text-align: center;">Remarks</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items['data'] as $item)
                <tr>
                    <td>
                        {{ isset($item['item']) ? $item['item']['item_code'] : "" }}
                    </td>
                    <td style="vertical-align: top; text-align: center;">{{ $item['unit_of_measure'] ? $item['unit_of_measure']['name'] : "" }}</td>
                    <td style="vertical-align: top; text-align: center;">
                        <!-- <div style="white-space: pre-line;">{{ $item['description'] }}</div> -->
                        <div style="white-space: pre-line;">{!! nl2br(e($item['description'])) !!}</div>
                    </td>
                    <td style="vertical-align: top; text-align: center;">{{ $item['request_quantity'] }}</td>
                    <td style="vertical-align: top; text-align: center;">
                        @if($item['has_stock'] == 1 && $issued_by_date)
                            <span style='font-family:helvetica'>&#10004;</span>
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align: center;">
                        @if($item['has_stock'] == 0 && $issued_by_date)
                            <span style='font-family:helvetica'>&#10004;</span>
                        @endif
                    <td style="vertical-align: top; text-align: center;">
                        @if($issued_by_date)
                            <span>{{ $item['issue_quantity'] }}</span>
                        @endif
                    </td>
                    <td style="vertical-align: top; text-align: left;">
                        @if($issued_by_date)
                            <span>{{ $item['is_pr_recommended'] == 1 ? "PR Recommended" : "" }}</span>
                            <span>{{ $item['remarks'] ? $item['remarks'] : "" }}</span>
                        @endif
                    </td>

                </tr>
                @endforeach
                @for($i = 0; $i<=(19 - $count_items); $i ++)
                <tr>
                    <td style="text-align: center">&nbsp;</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"></td>
                    <td style="text-align: right;"></td>
                </tr>
                @endfor
                <tr>
                    <td colspan="8">
                        Purpose: <b>{{ $purpose }}</b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table id="form-footer">
            <tr>
                <td style="width: 15%;"></td>
                <td style="width: 21%;">Requested by:</td>
                <td style="width: 21%;">Approved by:</td>
                <td style="width: 21%;">Issued by:</td>
                <td style="width: 21%;">Received by:</td>
            </tr>
            <tr>
                <td style="height: 30pt;">Signature:</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Printed Name:</td>
                <td style="text-align: center;"  nowrap="nowrap">
                    <b>{{ $requested_by_date ? $requested_by_name : "" }}</b>
                </td>
                <td style="text-align: center;"  nowrap="nowrap">
                    <b>{{ $approved_by_date ? $approved_by_name : "" }}</b>
                </td>
                <td style="text-align: center;"  nowrap="nowrap">
                    <b>{{ $issued_by_date ? $issued_by_name : "" }}</b>
                </td>
                <td style="text-align: center;"  nowrap="nowrap">
                    <b>{{ $received_by_name }}</b>
                </td>
            </tr>
            <tr>
                <td>Designation:</td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $requested_by_date ? $requested_by_designation : "" }}</b>
                </td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $approved_by_date ? $approved_by_designation : "" }}</b>
                </td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $issued_by_date ? $issued_by_designation : "" }}</b>
                </td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $received_by_designation }}</b>
                </td>
            </tr>
            <tr>
                <td>Date:</td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $requested_by_date }}</b>
                </td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $approved_by_date }}</b>
                </td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $issued_by_date }}</b>
                </td>
                <td style="text-align: center;" nowrap="nowrap">
                    <b>{{ $received_by_date }}</b>
                </td>
            </tr>
        </table>
        <br>
</div>
</body>
</html> 