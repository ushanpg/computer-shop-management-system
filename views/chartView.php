<head>
    <script type="text/javascript" src="../vendor/amcharts/index.js"></script>
    <script type="text/javascript" src="../vendor/amcharts/xy.js"></script>
    <script type="text/javascript" src="../vendor/amcharts/percent.js"></script>
    <script type="text/javascript" src="../vendor/amcharts/themes/Animated.js"></script>
</head>

<body>
    <h4 class="mb-3" align="center">Last 30Days Orders at a Glance...</h4>
    <div class="d-flex">
        <div id="chartdiv"></div>
        <div id="chartdiv2"></div>
    </div>
</body>

<script>
    // Create a bar chart
    // Create root and chart
    var root = am5.Root.new("chartdiv");

    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    var chart = root.container.children.push(
        am5xy.XYChart.new(root, {
            panY: false,
            wheelY: "zoomX",
            layout: root.verticalLayout
        })
    );

    // Define data
    var data = [<?php
                $counter = 1;
                foreach ($chart1 as $chartVar) {
                    if ($counter < 5) {
                        echo ("{ category: " . "'" . ucwords($chartVar['category']) . "'" . ", value: " . $chartVar['value'] . "}, ");
                        $counter = $counter + 1;
                    }
                } ?>];

    // Craete Y-axis
    let yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {})
        })
    );

    // Create X-Axis
    var xAxis = chart.xAxes.push(
        am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.2,
            renderer: am5xy.AxisRendererX.new(root, {}),
            categoryField: "category"
        })
    );
    xAxis.data.setAll(data);

    // Create series
    var series1 = chart.series.push(
        am5xy.ColumnSeries.new(root, {
            name: "Deliveries",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            categoryXField: "category",
            tooltip: am5.Tooltip.new(root, {})
        })
    );
    series1.data.setAll(data);

    // Add legend
    var legend = chart.children.push(am5.Legend.new(root, {}));
    legend.data.setAll(chart.series.values);
</script>

<script>
    // Create a pie chart
    // Create root and chart
    var root = am5.Root.new("chartdiv2");

    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    var chart = root.container.children.push(
        am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        })
    );

    // Define data
    var data = [<?php foreach ($chart2 as $chartVar) {
                    echo ("{ category: " . "'" . ucwords($chartVar['category']) . "'" . ", value: " . $chartVar['value'] . "}, ");
                } ?>];

    // Create series
    var series = chart.series.push(
        am5percent.PieSeries.new(root, {
            name: "Series",
            valueField: "value",
            categoryField: "category"
        })
    );
    series.data.setAll(data);

    // Add legend
    var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        layout: root.horizontalLayout
    }));

    legend.data.setAll(series.dataItems);
</script>