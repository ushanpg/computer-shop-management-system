<?php
include_once "../services/pdfGenerate.php";

class SalesReport
{
    function generate($start, $end, $sales)
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
        <p>Period: " . $start . " - " . $end . "</p>
        <h3><u>Sales Summary</u></h3><table>
            <thead>
                <tr>
                    <th> Order ID </th>
                    <th> Customer </th>
                    <th> No. of Products </th>
                    <th> Total Price(Rs.) </th>
                    <th> Pay With </th>
                    <th> Date </th>
                    <th> Status </th>
                </tr>
            </thead>
            <tbody>";
        foreach ($sales as $sale) {
            $html = $html . "
                            <tr>
                                <td>" . $sale[1] . "</td>
                                <td>" . sprintf("%05d", $sale[2]) . " " . ucwords($sale[6]) . "</td>
                                <td>" . $sale[7] . "</td>
                                <td>" . $sale[8] . "</td>
                                <td>" . strtoupper($sale[3]) . "</td>
                                <td>" . $sale[4] . "</td>
                                <td>" . $sale[5] . "</td>
                            </tr>";
        }

        $html = $html . "
                        </tbody>
                        </table><p>Copyright © " . date("Y") . " Com-Shop (Pvt) Ltd. All Rights Reserved.</p>
    </div></body>";

        $report = new PDF($html);
        return $report;
    }
}
