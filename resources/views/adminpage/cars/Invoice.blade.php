<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 35px;
            line-height: 0px;
            color: #333;
        }

        .invoice-box table tr.information table td {
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>


    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h5 style="width:100%;">{{$info->name}}</h5>
                            </td>

                            <td>
                                <br>
                                Invoice #: {{$car->carid}}<br>
                                Date of Sale: {{$car->dateofsale}}<br>
                                Time of Sale: {{$car->timeofsale}}<br> 
                                Created: {{date('m-d-Y')}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {!! $info->contactaddress !!}<br>
                                {{$info->contactphone}}
                            </td>

                            <td>
                                {{$car->salesrep}}<br>
                                {{$info->contactemail}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Price
                </td>
            </tr>

            <tr class="item">
                <td>
                    {{$car->carname}}
                </td>

                <td>
                    {{$car->carprice}}
                </td>
            </tr>

            <tr class="item">
                <td>
                    Goverment Fees
                </td>

                <td>
                    {{$car->govfees}}
                </td>
            </tr>

            <tr class="item">
                <td>
                    Dealer Service
                </td>
            
                <td>
                    {{$car->dealerservice}}
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Service Contract
                </td>
            
                <td>
                    {{$car->servicecontract}}
                </td>
            </tr>

            <tr class="item last">
                <td>
                    Sales Tax
                </td>

                <td>
                    {{$car->salestax}}
                </td>
            </tr>

            <tr class="total">
                <td></td>

                <td>
                    Total: {{$car->totalprice}}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>