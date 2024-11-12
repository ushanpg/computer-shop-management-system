<?php
include_once "../services/pdfGenerate.php";

class Invoice
{
    function generate($order_id, $items, $payment)
    {
        $html = "<body>
    <style>
    body {
        text-align: center;
    }
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            height: 5vh;
            padding: 0px 5px 0px;
        }
    </style>
    <div>
        <p>User:" . ucwords($_SESSION['userData']['email']) . " @ " . date("Y-m-d h:i:s") . "</p>
        <h1>Com-Shop</h1>
        <p>The Technology Store</p>
        <p>Order ID: " . $order_id . "</p>
        <h3><u>Invoice</u></h3><table>
            <thead>
                <tr>
                    <th> Item ID </th>
                    <th> Product </th>
                    <th> Unit Price(Rs.) </th>
                    <th> Quantity </th>
                    <th> Subtotal(Rs.) </th>
                </tr>
            </thead>
            <tbody>";
        $total = 0;
        foreach ($items as $item) {
            $html = $html . "
                            <tr>
                                <td>" . sprintf("%05d", $item[0]) . "</td>
                                <td>" . sprintf("%05d", $item[2]) . " " . ucwords($item[5]) . "</td>
                                <td>" . $item[4] . "</td>
                                <td>" . $item[3] . "</td>";
            $subtotal = $item[4] * $item[3];
            $html = $html . "
                                <td>" . $subtotal . "</td>
                            </tr>";
            $total = $total + $subtotal;
        }

        $html = $html . "
                        <tr>
                            <td><h3>Total: </h3></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h3>" . $total . "</h3></td>
                        </tr>
                        </tbody>
                        </table>
                        <br/>
                        <p>Payment Info:</p>";

        foreach ($payment as $entry) {
            $html = $html . "<span>" . $entry . "</span>&nbsp;";
        }

        $html = $html . "<p>Copyright © " . date("Y") . " Com-Shop (Pvt) Ltd. All Rights Reserved.</p>
                        </div>
                        </body>";

        $report = new PDF($html);
        return $report;
    }
}
