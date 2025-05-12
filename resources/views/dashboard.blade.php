<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <h2 class="mb-4">Dashboard</h2>

                        <div class="row">
                            <!-- Total Sales Card -->
                            <div class="col-md-3">
                                <div class="card bg-primary text-white mb-3">
                                    <div class="card-header">Total Sales</div>
                                    <div class="card-body">
                                        <h5 class="card-title">RM {{ number_format($totalSales, 2) }}</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Products Card -->
                            <div class="col-md-3">
                                <div class="card bg-success text-white mb-3">
                                    <div class="card-header">Total Products</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalProducts }}</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Customers Card -->
                            <div class="col-md-3">
                                <div class="card bg-warning text-white mb-3">
                                    <div class="card-header">Total Customers</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalCustomers }}</h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Expenses Card -->
                            <div class="col-md-3">
                                <div class="card bg-danger text-white mb-3">
                                    <div class="card-header">Total Expenses</div>
                                    <div class="card-body">
                                        <h5 class="card-title">RM {{ number_format($totalExpenses, 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Expense Breakdown Pie Chart -->
                        <div class="row">
                            <div class="mb-4">
                                <label for="chartType" class="block mb-1 text-sm font-medium text-gray-700">View Breakdown:</label>
                                <select id="chartType" class="border-gray-300 rounded-md shadow-sm">
                                    <option value="overview">Sales vs Expenses</option>
                                    <option value="sales">Sales by Product (This Month)</option>
                                </select>
                            </div>

                            <div class="col-md-12">

                                <div id="chartdiv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
am5.ready(function () {
    let chart;
    let series;
    const root = am5.Root.new("chartdiv");

    root.setThemes([am5themes_Animated.new(root)]);

    chart = root.container.children.push(
        am5percent.PieChart.new(root, {
            endAngle: 270
        })
    );

    series = chart.series.push(
        am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
            endAngle: 270
        })
    );

    function loadChart(data) {
        series.data.setAll(data);
    }

    // Default data: Sales vs Expenses
    const defaultData = [
        { category: "Sales", value: {{ $totalSales }} },
        { category: "Expenses", value: {{ $totalExpenses }} }
    ];
    loadChart(defaultData);

    document.getElementById('chartType').addEventListener('change', function (e) {
        const type = e.target.value;

        if (type === 'sales') {
            fetch('/dashboard/sales-breakdown')
                .then(res => res.json())
                .then(data => {
                    loadChart(data);
                });
        } else {
            loadChart(defaultData);
        }
    });

    series.appear(1000, 100);
});
</script>


</x-app-layout>