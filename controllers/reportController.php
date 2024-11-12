<?php
if (isset($_REQUEST["req"])) {
    include "../models/reportModel.php";
    include "../reports/salesReport.php";
    include "../reports/mostSellingReport.php";
    include "../reports/stockReport.php";
    include "../reports/customerReport.php";
    include "../reports/profitLossReport.php";
    include "../services/session.php";
    $req = $_REQUEST["req"];

    if (!isset($_SESSION['userData'])) {
?>
        <script>
            window.location = "authController.php?req=login";
        </script>
        <?php
        throw new Exception("Error Processing Request", 1);
    }

    switch ($req) {
        case 'report':
            $reportObject = new Report();
            $start = date("Y-m-d h:i:s", time() - 606024 * 29);
            $end = date("Y-m-d h:i:s", time() + 606024);

            $result = $reportObject->barChartData($start, $end);
            $barChartData = [];
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($barChartData, $row);
            }
            $chart1 = base64_encode(serialize($barChartData)); //Bar chart data

            $result = $reportObject->pieChartData($start, $end);
            $pieChartData = [];
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($pieChartData, $row);
            }
            $chart2 = base64_encode(serialize($pieChartData)); //Pie chart data
        ?>
            <script>
                window.location = "../views/reports.php?chart1=<?php echo ($chart1) ?>&chart2=<?php echo ($chart2) ?>";
            </script>
<?php
            break;

        case 'reportGen':
            if (isset($_POST)) {
                $report_id = $_POST['id'];

                switch ($report_id) {
                    case '1': // Sales Summary report
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $reportObject = new Report();
                        $result = $reportObject->salesReport($start, $end);
                        $sales = [];
                        while ($row = mysqli_fetch_row($result)) {
                            array_push($sales, $row);
                        }

                        $salesReport = new SalesReport();
                        $result = $salesReport->generate($start, $end, $sales);
                        break;

                    case '2': // Most Selling Products report
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $reportObject = new Report();
                        $result = $reportObject->mostSellingReport($start, $end);
                        $products = [];
                        while ($row = mysqli_fetch_row($result)) {
                            array_push($products, $row);
                        }

                        $mostSellingReport = new MostSellingReport();
                        $result = $mostSellingReport->generate($start, $end, $products);
                        break;

                    case '3': // Stock Movement report    
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $reportObject = new Report();
                        $result = $reportObject->stockReport($start, $end);
                        $stocks = [];
                        while ($row = mysqli_fetch_row($result)) {
                            array_push($stocks, $row);
                        }

                        $stockReport = new StockReport();
                        $result = $stockReport->generate($start, $end, $stocks);
                        break;

                    case '4': // Customer Performance report
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $reportObject = new Report();
                        $result = $reportObject->customerReport($start, $end);
                        $customers = [];
                        while ($row = mysqli_fetch_row($result)) {
                            array_push($customers, $row);
                        }

                        $customerReport = new CustomerReport();
                        $result = $customerReport->generate($start, $end, $customers);
                        break;

                    case '5': // Profit & Loss report
                        $start = $_POST['start'];
                        $end = $_POST['end'];
                        $reportObject = new Report();
                        $result = $reportObject->profitLossReport($start, $end);
                        $products = [];
                        while ($row = mysqli_fetch_row($result)) {
                            array_push($products, $row);
                        }

                        $profitLossReport = new ProfitLossReport();
                        $result = $profitLossReport->generate($start, $end, $products);
                        break;
                }
            }
            break;
    }
}
