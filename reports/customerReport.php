<?php
include_once "../services/pdfGenerate.php";

class CustomerReport
{
    function generate($start, $end, $customers)
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
        <h3><u>Customer Performance</u></h3><table>
            <thead>
                <tr>
                    <th> User ID </th>
                    <th> Email </th>
                    <th> Name </th>
                    <th> No. of Purchases </th>
                    <th> Units Purchased </th>
                    <th> Expence(Rs.) </th>
                </tr>
            </thead>
            <tbody>";
        foreach ($customers as $customer) {
            $html = $html . "
                            <tr>
                                <td>" . sprintf("%05d", $customer[0]) . "</td>
                                <td>" . ucwords($customer[1]) . "</td>
                                <td>" . ucwords($customer[2]." ".$customer[3]) . "</td>
                                <td>" . $customer[4] . "</td>
                                <td>" . $customer[5] . "</td>
                                <td>" . $customer[6] . "</td>
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
