import Card from "@/Components/Card";
import { Head } from "@inertiajs/react";
import Prompt from "@/Components/Icons/Prompt";
import Support from "@/Components/Icons/Support";
import DashboardLayout from "@/Layouts/Dashboard";
import Documents from "@/Components/Icons/Documents";
import ProfileIcon from "@/Components/Icons/ProfileIcon";
import UsersOverview from "@/Components/Charts/UsersOverview";
import RegisteredUsers from "@/Components/Table/RegisteredUsers";
import { eachDayOfInterval, startOfMonth, endOfMonth, format } from "date-fns";
import ContentGenerationOverview from "@/Components/Charts/ContentGenerationOverview";

const Dashboard = (props) => {
   const {
      newUsers,
      proUsers,
      freeUsers,
      totalUsers,
      recentUsers,
      totalFreeUsers,
      totalStandardUsers,
      totalPremiumUsers,
   } = props;

   // Get the current date
   const currentDate = new Date();
   const startDate = startOfMonth(currentDate);
   const endDate = endOfMonth(currentDate);
   const dates = eachDayOfInterval({ start: startDate, end: endDate });
   const formattedDates = dates.map((date) => format(date, "dd"));

   function monthlyDataHandler(name, obj) {
      const values = [];
      Object.keys(obj).forEach((key) => {
         let value = obj[key];
         values.push(value);
      });

      return {
         name,
         data: values,
      };
   }

   const monthlyGenerated = [
      monthlyDataHandler("Free", props.monthlyFreeUsers),
      monthlyDataHandler("Standard", props.monthlyStandardUsers),
      monthlyDataHandler("Premium", props.monthlyPremiumUsers),
   ];

   return (
      <>
         <Head title="Admin Dashboard" />

         <div className="grid grid-cols-1 lg:grid-cols-2 gap-7">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-7">
               <Card className="shadow-card p-7 flex flex-col justify-between h-48 md:h-56">
                  <div className="flex items-center">
                     <div className="w-10 h-10 rounded-md p-2 bg-primary-50">
                        <Prompt className="h-6 w-6 text-primary-500" />
                     </div>
                     <p className="ml-3 md:text-lg font-bold text-gray-900">
                        Generated Prompts
                     </p>
                  </div>

                  <h2 className="text-gray-900 font-bold">{totalUsers}</h2>
               </Card>

               <Card className="shadow-card p-7 flex flex-col justify-between h-48 md:h-56">
                  <div className="flex items-center">
                     <div className="w-10 h-10 rounded-md p-2 bg-success-50">
                        <ProfileIcon className="h-6 w-6 text-success-500" />
                     </div>
                     <p className="ml-3 md:text-lg font-bold text-gray-900">
                        New Users
                     </p>
                  </div>

                  <div>
                     <h2 className="text-gray-900 font-bold">{newUsers}</h2>
                     <small className="text-gray-500 mt-1">Current Month</small>
                  </div>
               </Card>

               <Card className="shadow-card p-7 flex flex-col justify-between h-48 md:h-56">
                  <div className="flex items-center">
                     <div className="w-10 h-10 rounded-md p-2 bg-error-50">
                        <Documents className="h-6 w-6 text-error-500" />
                     </div>
                     <p className="ml-3 md:text-lg font-bold text-gray-900">
                        Free Users
                     </p>
                  </div>

                  <div>
                     <h2 className="text-gray-900 font-bold">{freeUsers}</h2>
                     <small className="text-gray-500 mt-1">Current Month</small>
                  </div>
               </Card>

               <Card className="shadow-card p-7 flex flex-col justify-between h-48 md:h-56">
                  <div className="flex items-center">
                     <div className="w-10 h-10 rounded-md p-2 bg-warning-50">
                        <Support className="h-6 w-6 text-warning-500" />
                     </div>
                     <p className="ml-3 md:text-lg font-bold text-gray-900">
                        Pro Users
                     </p>
                  </div>

                  <div>
                     <h2 className="text-gray-900 font-bold">{proUsers}</h2>
                     <small className="text-gray-500 mt-1">Current Month</small>
                  </div>
               </Card>
            </div>
            <Card className="relative pl-1 pt-14">
               <p className="absolute top-6 left-6 text18 font-bold text-gray-900 pb-10">
                  Users Overview
               </p>
               <div className="flex justify-center items-center">
                  <UsersOverview
                     data={[
                        totalFreeUsers,
                        totalStandardUsers,
                        totalPremiumUsers,
                     ]}
                  />
               </div>
            </Card>
         </div>

         <Card className="shadow-card pr-3 my-7 relative pl-1 md:pl-0 pt-14 md:pt-5">
            <p className="absolute top-6 left-6 z-10 text18 font-bold text-gray-800 mb-6">
               Monthly Users Overview
            </p>

            <ContentGenerationOverview
               data={monthlyGenerated}
               label={formattedDates}
            />
         </Card>

         <Card>
            <div className="px-7 pt-7 pb-4">
               <p className="text18 font-bold text-gray-900">
                  Recent Registered Users
               </p>
            </div>
            <RegisteredUsers users={recentUsers} />
         </Card>
      </>
   );
};

Dashboard.layout = (page) => <DashboardLayout children={page} />;

export default Dashboard;
