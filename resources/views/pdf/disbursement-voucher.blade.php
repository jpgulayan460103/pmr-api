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
            <thead>
                <tr>
                    <td colspan="6" style="border: 0;text-align:right">Appendix 61</td>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;height:25pt">PURCHASE ORDER</th>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;height:25pt">Department of Social Welfare and Development Field Office XI</th>
                </tr>
                <tr>
                    <th colspan="6" style="border: 0;height:25pt">Entity Name</th>
                </tr>
                <tr>
                    <td colspan="3">Supplier: </td>
                    <td colspan="3">P.O. No. </td>
                </tr>
                <tr>
                    <td colspan="3">Address: </td>
                    <td colspan="3">Date: </td>
                </tr>
                <tr>
                    <td colspan="3">TIN: </td>
                    <td colspan="3">Mode of Procurement: </td>
                </tr>
                <tr>
                    <td colspan="6">
                        Gentlemen: <br>
                        Please furnish this Office the following articles subject to the terms and conditions contained herein:
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Place of Delivery: </td>
                    <td colspan="3">Date of Delivery: </td>
                </tr>
                <tr>
                    <td colspan="3">Delivery Term: </td>
                    <td colspan="3">Payment Term: </td>
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
            <tbody>
                @for($i = 0; $i<=(19 - 2); $i ++)
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
            <tfoot>
                <tr>
                    <td colspan="6">(Total Amount in Words)</td>
                </tr>
                <tr>
                    <td colspan="6" style="border-bottom: 0;"><br>&nbsp;&nbsp;&nbsp;&nbsp; In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day of delay shall be imposed on the undelivered item/s.</td>
                </tr>
                <tr>
                    <td style="border-bottom: 0;border-top: 0;; border-right: 0" colspan="3"><br>Conforme:<br /><br />&nbsp;</td>
                    <td colspan="3" style="border-bottom: 0;border-top: 0;; border-left: 0"><br>Very truly yours,<br /><br />&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0; border-right: 0" colspan="3">NAME</td>
                    <td colspan="3" style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0; border-left: 0; width: 220pt;">NAME</td>
                </tr>
                <tr>
                    <td style=" text-align: center; border-top: 0; border-bottom: 0; border-right: 0" colspan="3">Signature over Printed Name of Supplier</td>
                    <td colspan="3" style=" text-align: center; border-top: 0; border-bottom: 0; border-left: 0">Signature over Printed Name of Authorized Official</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0; border-right: 0" colspan="3">Date</td>
                    <td colspan="3" style="font-weight: bold;text-align: center; border-top: 0; border-bottom: 0; border-left: 0; width: 220pt;">Designation</td>
                </tr>
                <tr>
                    <td style=" text-align: center; border-top: 0; border-right: 0" colspan="3">Date</td>
                    <td colspan="3" style=" text-align: center; border-top: 0; border-left: 0">Designation</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; border-top: 0; border-bottom: 0" colspan="3">Fund Cluster: </td>
                    <td colspan="3" style="font-weight: bold; border-top: 0; border-bottom: 0; width: 220pt;">ORS/BURS No.</td>
                </tr>
                <tr>
                    <td style="border-top: 0;border-bottom: 0;font-weight: bold;" colspan="3">Fund Available: </td>
                    <td colspan="3" style="border-top: 0;border-bottom: 0;font-weight: bold;">Date of the ORS/BURS:</td>
                </tr>
                <tr>
                    <td style="border-top: 0; border-bottom: 0; border-right: 0;;font-weight: bold;" colspan="2"></td>
                    <td style="border-top: 0;border-left: 0;font-weight: bold;text-align:center"></td>
                    <td colspan="3" style="border-top: 0; border-bottom: 0;font-weight: bold;">Amount:</td>
                </tr>
                <tr>
                    <td style="border-top: 0; border-right: 0;;font-weight: bold;" colspan="2"></td>
                    <td style="border-top: 0;border-left: 0;font-weight: bold;text-align:center">Signature over Printed Name of Chief Accountant/Head of Accounting Division/Unit</td>
                    <td colspan="3" style="border-top: 0;font-weight: bold;"></td>
                </tr>
            </tfoot>
        </table>
</div>
</body>
</html>