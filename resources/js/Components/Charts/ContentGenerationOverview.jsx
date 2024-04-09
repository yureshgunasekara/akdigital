import ReactApexChart from "react-apexcharts";

const ContentGenerationOverview = ({ data, label }) => {
   const options = {
      chart: {
         toolbar: {
            show: false,
         },
      },
      dataLabels: {
         enabled: false,
      },
      stroke: {
         curve: "smooth",
         width: 2,
      },
      xaxis: {
         categories: label,
      },
      grid: {
         xaxis: {
            lines: {
               show: false,
            },
         },
         yaxis: {
            lines: {
               show: false,
            },
         },
         padding: {
            top: 20,
            right: 4,
            bottom: 0,
            left: 10,
         },
      },
      legend: {
         position: "top",
         horizontalAlign: "right",
      },
      tooltip: {
         x: {
            format: "dd/MM/yy HH:mm",
         },
      },
      responsive: [
         {
            breakpoint: 1280,
            options: { chart: { height: 500 } },
         },
         {
            breakpoint: 1024,
            options: { chart: { height: 400 } },
         },
         {
            breakpoint: 768,
            options: {
               chart: { height: 300 },
               grid: { padding: { top: 0 } },
               legend: { horizontalAlign: "left" },
            },
         },
      ],
   };

   return (
      <div id="chart">
         <ReactApexChart
            options={options}
            series={data}
            type="area"
            height={500}
         />
      </div>
   );
};

export default ContentGenerationOverview;
