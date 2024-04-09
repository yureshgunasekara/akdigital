import ReactApexChart from "react-apexcharts";

const SavedContentOverview = ({ data }) => {
   const options = {
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
      colors: ["#6950E8", "#06D7A1", "#FEBF06", "#EF4770", "#6b7280"],
      labels: ["Codes", "Texts", "Images", "Speeches", "Templates"],
      legend: { position: "left" },
      responsive: [
         {
            breakpoint: 1280,
            options: { chart: { height: 320 } },
         },
         {
            breakpoint: 768,
            options: { chart: { height: 260 } },
         },
      ],
   };

   return (
      <div id="chart" className="saved-content">
         <ReactApexChart
            options={options}
            series={data}
            type="donut"
            height={320}
         />
      </div>
   );
};

export default SavedContentOverview;
