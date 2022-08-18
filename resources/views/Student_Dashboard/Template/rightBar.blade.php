<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <div class="donut-main">
        <h4>COMPLETED ACTIONS & PROGRESS</h4>
        <canvas id="newchart" height="130" width="130"></canvas>
        <script>
            var doughnutData = [{
                value: 70,
                color: "#4ECDC4"
            },
                {
                    value: 30,
                    color: "#fdfdfd"
                }
            ];
            var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
        </script>
    </div>
    <!--NEW EARNING STATS -->
    <div class="panel terques-chart">
        <div class="panel-body">
            <div class="chart">
                <div class="sparkline" data-type="line" data-resize="true" data-height="75"
                     data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff"
                     data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4"
                     data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
            </div>
        </div>
    </div>
    <!--new earning end-->
    <!-- RECENT ACTIVITIES SECTION -->
    <h4 class="centered mt">@yield("notificationHead", "")</h4>
    @yield("notifications", "")
    <!-- CALENDAR-->
    <div id="calendar" class="mb">
        <div class="panel green-panel no-margin">
            <div class="panel-body">
                <div id="date-popover" class="popover top"
                     style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title" style="disadding: none;"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                </div>
                <div id="my-calendar"></div>
            </div>
        </div>
    </div>
    <!-- / calendar -->
</div>
