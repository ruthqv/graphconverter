<!DOCTYPE doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <meta content="width=device-width, initial-scale=1" name="viewport">
                    <meta content="{{ csrf_token() }}" name="csrf-token">
                      <link rel="shortcut icon" href="/favicon.ico">

                        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
                         
                        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
                        <script src="//d3js.org/d3.v3.min.js" charset="utf-8"></script>

                            <title>
                                Api example Laravel and D3
                            </title>
                        </link>
                    </meta>
                </meta>
            </meta>
        </meta>
    </head>
    <body>
   <div class="container">
       <div class="row">
           <div class="col-sm-12 text-center">
                    <h2>API CONSUMER EXAMPLE</h2>
                    <p>Using Laravel, and D3.js Library</p>
                    <p id="chart"></p>
                    <div id="app">
                    <router-view>
                    </router-view>
                </div>
           </div>
       </div>
   </div>


<script>

// Load the data.
d3.json('http://crudevolution.dev.com/api/apidatas', function(nations) {
function x(d) { return d.inversion_recived; }
function y(d) { return d.employees; }
function radius(d) { return d.capital; }
function color(d) { return d.industry; }
function key(d) { return d.name; }

// Chart dimensions.
var margin = {top: 19.5, right: 19.5, bottom: 19.5, left: 69.5},
    width = 960 - margin.right,
    height = 500 - margin.top - margin.bottom;

// Various scales. These domains make assumptions of data, naturally.
var xScale = d3.scale.linear().domain([0, 100]).range([0, width]),
    yScale = d3.scale.linear().domain([0, 100]).range([height, 0]),
    radiusScale = d3.scale.sqrt().domain([0, 100]).range([0, 40]),
    colorScale = d3.scale.category10();

// The x & y axes.
var xAxis = d3.svg.axis().orient("bottom").scale(xScale).ticks(12, d3.format(",d")),
    yAxis = d3.svg.axis().scale(yScale).orient("left");

// Create the SVG container and set the origin.
var svg = d3.select("#chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Add the x-axis.
svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(xAxis);

// Add the y-axis.
svg.append("g")
    .attr("class", "y axis")
    .call(yAxis);

// Add an x-axis label.
svg.append("text")
    .attr("class", "x label")
    .attr("text-anchor", "end")
    .attr("x", width)
    .attr("y", height - 6)
    .text("inversion_recived");

// Add a y-axis label.
svg.append("text")
    .attr("class", "y label")
    .attr("text-anchor", "end")
    .attr("y", 6)
    .attr("dy", ".75em")
    .attr("transform", "rotate(-90)")
    .text("employees");

// Add the year label; the value is set on transition.
var label = svg.append("text")
    .attr("class", "year label")
    .attr("text-anchor", "end")
    .attr("y", height - 24)
    .attr("x", width)
    .text(2000);
  // A bisector since many nation's data is sparsely-defined.
  var bisect = d3.bisector(function(d) { return d[0]; });

  // Add a dot per nation. Initialize the data at 2000, and set the colors.
  var dot = svg.append("g")
      .attr("class", "dots")
    .selectAll(".dot")
      .data(interpolateData(2000))
    .enter().append("circle")
      .attr("class", "dot")
      .style("fill", function(d) { return colorScale(color(d)); })
      .call(position)
      .sort(order);

  // Add a title.
  dot.append("title")
      .text(function(d) { return d.name; });

  // Add an overlay for the year label.
  var box = label.node().getBBox();

  var overlay = svg.append("rect")
        .attr("class", "overlay")
        .attr("x", box.x)
        .attr("y", box.y)
        .attr("width", box.width)
        .attr("height", box.height)
        .on("mouseover", enableInteraction);

  // Start a transition that interpolates the data based on year.
  svg.transition()
      .duration(30000)
      .ease("linear")
      .tween("year", tweenYear)
      .each("end", enableInteraction);

  // Positions the dots based on data.
  function position(dot) {
    dot .attr("cx", function(d) { return xScale(x(d)); })
        .attr("cy", function(d) { return yScale(y(d)); })
        .attr("r", function(d) { return radiusScale(radius(d)); });
  }

  // Defines a sort order so that the smallest dots are drawn on top.
  function order(a, b) {
    return radius(b) - radius(a);
  }

  // After the transition finishes, you can mouseover to change the year.
  function enableInteraction() {
    var yearScale = d3.scale.linear()
        .domain([2000, 2005])
        .range([box.x + 10, box.x + box.width - 10])
        .clamp(true);

    // Cancel the current transition, if any.
    svg.transition().duration(0);

    overlay
        .on("mouseover", mouseover)
        .on("mouseout", mouseout)
        .on("mousemove", mousemove)
        .on("touchmove", mousemove);

    function mouseover() {
      label.classed("active", true);
    }

    function mouseout() {
      label.classed("active", false);
    }

    function mousemove() {
      displayYear(yearScale.invert(d3.mouse(this)[0]));
    }
  }

  // Tweens the entire chart by first tweening the year, and then the data.
  // For the interpolated data, the dots and label are redrawn.
  function tweenYear() {
    var year = d3.interpolateNumber(2000, 2005);
    return function(t) { displayYear(year(t)); };
  }

  // Updates the display to show the specified year.
  function displayYear(year) {
    dot.data(interpolateData(year), key).call(position).sort(order);
    label.text(Math.round(year));
  }

  // Interpolates the dataset for the given (fractional) year.
  function interpolateData(year) {
    return nations.map(function(d) {
      return {
        name: d.name,
        industry: d.industry,
        inversion_recived: interpolateValues(d.inversion_recived, year),
        capital: interpolateValues(d.capital, year),
        employees: interpolateValues(d.employees, year)
      };
    });
  }

  // Finds (and possibly interpolates) the value for the specified year.
  function interpolateValues(values, year) {
    var i = bisect.left(values, year, 0, values.length - 1),
        a = values[i];
    if (i > 0) {
      var b = values[i - 1],
          t = (year - a[0]) / (b[0] - a[0]);
      return a[1] * (1 - t) + b[1] * t;
    }
    return a[1];
  }
});     


</script>
<script src="{{ asset('js/app.js') }}"></script>

<style>


#chart {
  margin-left: -40px;
  height: 506px;
}

text {
  font: 10px sans-serif;
}

.dot {
  stroke: #000;
}

.axis path, .axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.label {
  fill: #777;
}

.year.label {
  font: 500 196px "Helvetica Neue";
  fill: #ddd;
}

.year.label.active {
  fill: #aaa;
}

.overlay {
  fill: none;
  pointer-events: all;
  cursor: ew-resize;
}

</style>
    </body>
</html>
