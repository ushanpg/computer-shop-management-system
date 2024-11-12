<?php
include_once "../services/pdfGenerate.php";

class MostSellingReport
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
        <h3><u>Most Selling Products</u></h3><table>
            <thead>
                <tr>
                    <th> Product ID </th>
                    <th> Name </th>
                    <th> Category </th>
                    <th> Brand </th>
                    <th> No. of Sales </th>
                    <th> Units Sold </th>
                    <th> Revenue(Rs.) </th>
                </tr>
            </thead>
            <tbody>";
        foreach ($products as $product) {
            if ($product[4] > 0) {
            $html = $html . "
                            <tr>
                                <td>" . sprintf("%05d", $product[0]) . "</td>
                                <td>" . ucwords($product[1]) . "</td>
                                <td>" . ucwords($product[2]) . "</td>
                                <td>" . ucwords($product[3]) . "</td>
                                <td>" . $product[4] . "</td>
                                <td>" . $product[5] . "</td>
                                <td>" . $product[6] . "</td>
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
