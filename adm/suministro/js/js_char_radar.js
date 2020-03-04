var EchartsCandlesticksOthers = function() {

    // Candlestick and other charts
    var _candlesticksOthersExamples = function() {
        
        // Define elements
        var gauge_basic_element = document.getElementById('gauge_basic');

        // Basic gauge
        if (gauge_basic_element) {

            // Initialize chart
            var gauge_basic = echarts.init(gauge_basic_element);

            // Options
            var gauge_basic_options = {
                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },
                // Add title
                title: {
                    text: 'Server resources usage',
                    subtext: 'Random demo data',
                    left: 'center',
                    textStyle: {
                        fontSize: 17,
                        fontWeight: 500,
                        color: '#008acd'
                    }
                },
                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: '{a} <br/>{b}: {c}%'
                },
                // Add series
                series: [
                    {
                        name: 'Stock',
                        type: 'gauge',
                        center: ['50%', '62%'],
                        radius: '90%',
                        axisLine: {
                            lineStyle: {
                                color: [[0.2, '#EC1F04'], [0.4, '#EDF056'], [1, '#55B452']], 
                                width: 15
                            }
                        },
                        axisTick: {
                            splitNumber: 10,
                            length: 20,
                            lineStyle: {
                                color: 'auto'
                            }
                        },
                        splitLine: {
                            length: 22,
                            lineStyle: {
                                color: 'auto'
                            }
                        },
                        title: {
                            offsetCenter: [0, '60%'],
                            textStyle: {
                                fontSize: 13
                            }
                        },
                        detail: {
                            offsetCenter: [0, '80%'],
                            formatter: '{value} %',
                            textStyle: {
                                fontSize: 20,
                                fontWeight: 500
                            }
                        },
                        pointer: {
                            width: 5
                        },
                        data: [{value: 50, name: 'Stock'}]
                    }
                ]
            };

            gauge_basic.setOption(gauge_basic_options);

            // Add random data
            clearInterval(timeTicket);
            var timeTicket = setInterval(function () {
                gauge_basic_options.series[0].data[0].value = (Math.random()*100).toFixed(2) - 0;
                gauge_basic.setOption(gauge_basic_options, true);
            }, 2000);
        }

        // Resize function
        var triggerChartResize = function() {
            gauge_basic_element && gauge_basic.resize();
        };

        // On sidebar width change
        $(document).on('click', '.sidebar-control', function() {
            setTimeout(function () {
                triggerChartResize();
            }, 0);
        });

        // On window resize
        var resizeCharts;
        window.onresize = function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        };
    };

    return {
        init: function() {
            _candlesticksOthersExamples();
        }
    };
}();

document.addEventListener('DOMContentLoaded', function() {
    EchartsCandlesticksOthers.init();
});
