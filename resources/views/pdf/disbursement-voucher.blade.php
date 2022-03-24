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
            
        }
        #po-table{
            width: 98%;
            /* border: 1px solid black; */
            border-collapse: collapse;
            border-top: 0;
        }
        #po-table tr td{
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
<div id="po-container">
        <table id="po-table">
            <tbody>
                <tr>
                    <td colspan="6" style="border: 0;text-align:right">Appendix 32</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">Department of Social Welfare and Development Field Office XI</td>
                    <td colspan="2">Fund Cluster</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">Entity Name</td>
                    <td colspan="2">Fund Cluster</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="2" style="text-align: center;">DISBURSEMENT  VOUCHER</td>
                    <td colspan="2">Date</td>
                </tr>
                <tr>
                    <td colspan="2">DV No.</td>
                </tr>
                <tr>
                    <td rowspan="2">Mode of Payment</td>
                    <td colspan="4" style="border-bottom: 0;border-right: 0;">
                        <input type="checkbox" name="" id="">MDS Check
                        <input type="checkbox" name="" id="">Commercial Check
                        <input type="checkbox" name="" id="">ADA
                    </td>
                    <td style="border-bottom: 0;border-left: 0;"><input type="checkbox" name="" id="">Others (Please specify)	</td>
                </tr>
                <tr>
                    <td colspan="4" style="border-top: 0;border-right: 0;">&nbsp;</td>
                    <td style="border-top: 0;border-left: 0;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Payee:</td>
                    <td colspan="3">TIN/Employee No.</td>
                    <td colspan="2">ORS/BURS No.:</td>
                </tr>
                <tr>
                    <td colspan="6">Address:</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Particulars</td>
                    <td style="text-align: center;" colspan="2">Responsibility Center</td>
                    <td style="text-align: center;" colspan="2">MFO/PAP</td>
                    <td style="text-align: center;" colspan="2">Amount</td>
                </tr>
                @for($i = 0; $i<=(4); $i ++)
                <tr>
                    <td style="text-align: center; border-bottom: 0;border-top: 0;">&nbsp;</td>
                    <td style="border-bottom: 0;border-top: 0;" colspan="2"></td>
                    <td style="border-bottom: 0;border-top: 0;" colspan="2"></td>
                    <td style="border-bottom: 0;border-top: 0;" colspan="2"></td>
                </tr>
                @endfor
                <tr>
                    <td style="text-align: center;">Amount Due</td>
                    <td style="text-align: center;" colspan="2"></td>
                    <td style="text-align: center;" colspan="2"></td>
                    <td style="text-align: center;" colspan="2"></td>
                </tr>
            </tbody>
        </table>

</div>
</body>
</html>