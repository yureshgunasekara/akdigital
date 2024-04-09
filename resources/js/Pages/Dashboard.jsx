import Code from "@/Components/Icons/Code";
import Audio from "@/Components/Icons/Audio";
import Image from "@/Components/Icons/Image";
import { Head, Link } from "@inertiajs/react";
import { Card } from "@material-tailwind/react";
import DashboardLayout from "@/Layouts/Dashboard";
import Template from "@/Components/Icons/Template";
import Microphone from "@/Components/Icons/Microphone";
import templatesIcon from "@/Components/Icons/template_icons";
import LeftArrowCorner from "@/Components/Icons/LeftArrowCorner";
import SavedContentOverview from "@/Components/Charts/SavedContentOverview";
import ContentGenerationOverview from "@/Components/Charts/ContentGenerationOverview";
import { eachDayOfInterval, startOfMonth, endOfMonth, format } from "date-fns";

export default function Dashboard(props) {
   const { mostUsesTemplates } = props;
   const saved = savedHandler(props);
   const generated = generatedHandler(props);

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
      monthlyDataHandler("Codes", props.monthlyCodes),
      monthlyDataHandler("Texts", props.monthlyTexts),
      monthlyDataHandler("Images", props.monthlyImages),
      monthlyDataHandler("Speeches", props.monthlySpeeches),
      monthlyDataHandler("Templates", props.monthlyTemplateContents),
   ];

   const totalSaved = [
      props.savedCodes,
      props.savedTexts,
      props.savedImages,
      props.savedSpeeches,
      props.savedTemplateContents,
   ];

   return (
      <>
         <Head title="Dashboard" />
         <Card className="shadow-card p-7 mb-7">
            <p className="text18 font-bold text-gray-800 mb-6">
               Generated Contents Overview
            </p>
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
               {generated.map((item, ind) => (
                  <div key={ind} className="overflow-hidden relative">
                     <h2 className="text-3xl md:text-[40px] font-bold">
                        {item.quantity}
                     </h2>
                     <small className="text-gray-500">{item.title}</small>
                  </div>
               ))}
            </div>
         </Card>

         <Card className="shadow-card pr-3 mb-7 relative pl-1 md:pl-0 pt-14 md:pt-5">
            <p className="absolute top-6 left-6 z-10 text18 font-bold text-gray-800 mb-6">
               Generated Contents Overview
            </p>

            <ContentGenerationOverview
               data={monthlyGenerated}
               label={formattedDates}
            />
         </Card>

         <div className="grid grid-cols-12 gap-7">
            <Card className="col-span-12 lg:col-span-4 shadow-card p-6">
               <p className="text18 font-bold text-gray-800 mb-6">
                  Generated Contents Overview
               </p>

               {saved.map((item, ind) => (
                  <div
                     key={ind}
                     className="flex items-center justify-between mb-8 last:mb-0"
                  >
                     <div className="flex items-center">
                        <div className="w-6 h-6 rounded-full bg-primary-50 flex items-center justify-center">
                           <item.Icon className="w-[13px] h-[13px] text-gray-500" />
                        </div>
                        <p className="text-lg font-medium text-gray-600 ml-2">
                           {item.title}
                        </p>
                     </div>
                     <p className="text-lg font-bold text-gray-800">
                        {item.quantity}
                     </p>
                  </div>
               ))}
            </Card>

            <Card className="col-span-12 lg:col-span-8 shadow-card p-4 relative pt-14 md:pt-4">
               <p className="absolute top-6 left-6 z-10 text18 font-bold text-gray-800 mb-6">
                  Generated Contents Overview
               </p>
               <SavedContentOverview data={totalSaved} />
            </Card>
         </div>

         <Card className="shadow-card p-7 mt-7">
            <div>
               <p className="text18 font-bold text-gray-900">
                  Most Used Templates
               </p>
               <small className="text-gray-700">
                  Save time and resources with intelligent writing assistance.
               </small>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 mt-12">
               {mostUsesTemplates.map((item, index) => {
                  const { title, slug, description, icon } = item.template;
                  const Icon = templatesIcon[icon];

                  return (
                     <Link key={index} href={`/templates/${slug}`}>
                        <Card key={index} className="template group">
                           <div className="mb-7 flex items-start justify-between">
                              <Icon className="h-12 w-12" />
                              <div className="w-[30px] h-[30px] rounded-full group-hover:bg-primary-500/80 flex items-center justify-center">
                                 <LeftArrowCorner className="group-hover:rotate-180 transition-all duration-300" />
                              </div>
                           </div>
                           <p className="text18 font-bold text-gray-900 group-hover:text-white mb-3">
                              {title}
                           </p>
                           <small className="text12  font-medium">
                              {description}
                           </small>
                        </Card>
                     </Link>
                  );
               })}
            </div>
         </Card>
      </>
   );
}

function generatedHandler(props) {
   const {
      generatedCodes,
      generatedTexts,
      generatedImages,
      generatedSpeeches,
      generatedTemplateContents,
   } = props;

   return [
      {
         title: "Generated Images",
         quantity: generatedImages,
      },
      {
         title: "Generated Codes",
         quantity: generatedCodes,
      },
      {
         title: "Text To Speeches",
         quantity: generatedSpeeches,
      },
      {
         title: "Speech To Texts",
         quantity: generatedTexts,
      },
      {
         title: "Template Contents",
         quantity: generatedTemplateContents,
      },
   ];
}

function savedHandler(props) {
   const {
      savedCodes,
      savedImages,
      savedTexts,
      savedSpeeches,
      savedTemplateContents,
   } = props;

   return [
      {
         title: "Saved Codes",
         quantity: savedCodes,
         Icon: Code,
      },
      {
         title: "Saved Images",
         quantity: savedImages,
         Icon: Image,
      },
      {
         title: "Speech To Text",
         quantity: savedTexts,
         Icon: Microphone,
      },
      {
         title: "Text To Speech",
         quantity: savedSpeeches,
         Icon: Audio,
      },
      {
         title: "Saved Contents",
         quantity: savedTemplateContents,
         Icon: Template,
      },
   ];
}

Dashboard.layout = (page) => <DashboardLayout children={page} />;
