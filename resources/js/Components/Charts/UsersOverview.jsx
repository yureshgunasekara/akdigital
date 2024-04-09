import React, { useState } from "react";
import ReactApexChart from "react-apexcharts";

const UsersOverview = ({ data }) => {
   const [chartData, setChartData] = useState({
      series: data,
      options: {
         chart: {
            type: "donut",
         },
         plotOptions: {
            pie: {
               startAngle: -90,
               endAngle: 270,
            },
         },
         dataLabels: {
            enabled: false,
         },
         fill: {
            type: "gradient",
         },
         horizontalAlign: "start",
         colors: ["#FEBF06", "#06D7A1", "#6950E8"],
         labels: ["Free", "Standard", "Premium"],
         legend: {
            position: "top",
            horizontalAlign: "left",
         },
         responsive: [
            {
               breakpoint: 1280,
               options: { chart: { height: 400 } },
            },
            {
               breakpoint: 1024,
               options: { chart: { height: 400 } },
            },
            {
               breakpoint: 768,
               options: { chart: { height: 300 } },
            },
         ],
      },
   });

   return (
      <div id="chart" className="w-full">
         <ReactApexChart
            options={chartData.options}
            series={chartData.series}
            type="donut"
            height={400}
         />
      </div>
   );
};

export default UsersOverview;
