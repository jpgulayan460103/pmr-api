<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
         @page {
            /* margin: 0px 0px 0px 0px !important; */
            /* margin: 0px 0px 0px 0px !important; */
            /* padding: 10px 10px 10px 10px !important; */
            size: 8.5in 13in;
            margin: 5%;
            opacity: 0.75;
            
        }
        #qt-table{
            width: 98%;
            /* border: 1px solid black; */
            border-collapse: collapse;
            border-top: 0;
        }
        #qt-table tr td{
            padding-left: 2pt;
            padding-right: 2pt;
            border: 1px solid black;
        }
        *{
            line-height: 1;
        }
        .font-normal{
            font-size: 6pt;
        }
        /* table {page-break-inside: auto;} */
    </style>
</head>
<body>
<!-- <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; text-align: center;z-index: -1000; ">
    <img src="{{ public_path('images/watermark.png') }}" style="width: 100%;">
</div> -->
<div  id="qt-container">
            <p style="text-align: right;"  class="font-normal">Appendix A: RFQ
            <br />
            <span class="font-normal">RFQ No.:</span> ____________<br />
            <span class="font-normal">Date:</span>  <br /></p>
            <span class="font-normal">Company Name:</span><br />
            <span class="font-normal">Company Address:</span><br />
            <span class="font-normal">Contact Person:</span><br />
            <span class="font-normal">Contact No.:</span> <br />
            <span class="font-normal">Email Address:</span> <br />

            <table  id="qt-table" class="font-normal">
                <thead>
                    <tr>
                        <td style="text-align: center;"><b>Item No.</b></td>
                        <td style="text-align: center;"><b>Qty</b></td>
                        <td style="text-align: center;"><b>Unit</b></td>
                        <td style="text-align: center;width:25%"><b>Purchaser's Specifications</b> </td>
                        <td style="text-align: center;width:25%"><b>Supplier/Service Provider's Specifications (Please write td detailed specifications in the space provided)</b> </td>
                        <td style="text-align: center;"><b>Unit Cost</b></td>
                        <td style="text-align: center;"><b>Total Cost</b></td>
                    </tr>
                </thead>
                <tbody>
                <tr key={item.key}>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <b>TOTAL:</b>
                        </td>
                        <td>
                            <b></b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <b>
                            <div class="font-normal">
                                <div>
                                    Approved Budget Cost:
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            </b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <br />
            <p class="font-normal"><b>Purpose:</b> { props.selectedPurchaseRequest.purpose }</p>
            <p class="font-normal"><b>PR No.:</b> { props.selectedPurchaseRequest.purchase_request_number }</p>
            <br />
            <p class="font-normal">
                IMPORTANT: The winning supplier/Service Provider MUST SIGN the original copy of the Purchase Order (P.O.) or Letter Order (L.O.) within three (3) days from the date of receipt. FAILURE to sign the original P.O./L.O. means that the bidder is not interested and will be a ground for suspension or blacklisting in DSWD's future biddings.
            </p>
            <div className="flex justify-evenly ...">
                <div class="font-normal">
                    <b><u>VEN LOUWE M. SANIEL</u></b>
                    <br />
                    Administrative Assistant III
                </div>
                <div class="font-normal">
                    _____________________________
                    <br />
                    (Signature over printed name)
                </div>
            </div>
        </div>
</body>
</html> 