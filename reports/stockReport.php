<?php
include_once "../services/pdfGenerate.php";

class StockReport
{
    function generate($start, $end, $stocks)
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
        <h3><u>Stock Movement</u></h3><table>
            <thead>
                <tr>
                    <th> Stock ID </th>
                    <th> Product </th>
                    <th> Quantity </th>
                    <th> Grade </th> 
                    <th> Date </th>
                    <th> Unit Cost(Rs.) </th>
                    <th> Remaining </th>
                </tr>
            </thead>
            <tbody>";
        foreach ($stocks as $stock) {
            if ($stock[2] != "") {
            $html = $html . "
                            <tr>
                                <td>" . sprintf("%05d", $stock[0]) . "</td>
                                <td>" . sprintf("%05d", $stock[1]) . " " . ucwords($stock[2]) . "</td>
                                <td>" . $stock[3] . "</td>
                                <td>" . $stock[4] . "</td>
                                <td>" . $stock[5] . "</td>
                                <td>" . $stock[6] . "</td>
                                <td>" . $stock[7] . "</td>
                            </tr>";
            }
        }

        $html = $html . "
                        </tbody>
                        </table><p>Copyright © " . date("Y") . " Com-Shop (Pvt) Ltd. All Rights Reserved.</p>
    </div></body>";

        $report = new PDF($html);
        return $report;
    }
}
