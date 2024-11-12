<?php
include_once "../services/pdfGenerate.php";

class ProfitLossReport
{
    function generate($start, $end, $products)
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
        <h3><u>Profit & Loss</u></h3><table>
            <thead>
                <tr>
                    <th> Product ID </th>
                    <th> Name </th>
                    <th> Units Sold </th>
                    <th> Revenue(Rs.) </th>
                    <th> Cost(Rs.) </th>
                    <th> Gain(Rs.) </th>
                    <th> Gain( % ) </th>
                </tr>
            </thead>
            <tbody>";
        $totUnits =  $totRevenue = $totCost = 0;
        foreach ($products as $product) {
            if ($product[2] != "") {
                $html = $html . "
                            <tr>
                                <td>" . sprintf("%05d", $product[0]) . "</td>
                                <td>" . ucwords($product[1]) . "</td>
                                <td>" . $product[2] . "</td>
                                <td>" . $product[3] . "</td>
                                <td>" . $product[4] . "</td>
                                <td>" . $product[3] - $product[4] . "</td>
                                <td>" . substr(($product[3] - $product[4]) / $product[4] * 100, 0, 7) . "%</td>
                            </tr>";
                $totUnits = $totUnits + $product[2];
                $totRevenue = $totRevenue + $product[3];
                $totCost = $totCost + $product[4];
            }
        }

        $html = $html . "
                        <tr>
                            <td><h3>Total: </h3></td>
                            <td></td>
                            <td><h3>" . $totUnits . "</h3></td>
                            <td><h3>" . $totRevenue . "</h3></td>
                            <td><h3>" . $totCost . "</h3></td>
                            <td><h3>" . $totRevenue - $totCost . "</h3></td>
                            <td><h3>" . substr(($totRevenue - $totCost) / $totCost * 100, 0, 7) . "%</h3></td>
                        </tr>
                        </tbody>
                        </table><p>Copyright © " . date("Y") . " Com-Shop (Pvt) Ltd. All Rights Reserved.</p>
    </div></body>";

        $report = new PDF($html);
        return $report;
    }
}
