import Card from "@/Components/Card";
import { Head, Link } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Pricing from "@/Components/Icons/Pricing";
import { Button } from "@material-tailwind/react";
import CheckOutline from "@/Components/Icons/CheckOutline";
import Dashboard from "@/Layouts/Dashboard";

const Show = (props) => {
   const { auth, plan } = props;
   const chatLimit =
      plan.access_chat_bot === "Standard"
         ? "(Include Free)"
         : plan.access_chat_bot === "Premium"
         ? "(Include Free + Standard)"
         : "";
   const templateLimit =
      plan.access_template === "Standard"
         ? "(Include Free)"
         : plan.access_template === "Premium"
         ? "(Include Free + Standard)"
         : "";

   const features = [
      `Code Generation ${plan.code_generation} (Per day)`,
      `Image Generation ${plan.image_generation} (Per day)`,
      `Speech To Text Generation ${plan.speech_to_text_generation} (Per day)`,
      `Speech Duration ${plan.speech_duration} Minute`,
      `Text To Speech Generation ${plan.text_to_speech_generation} (Per day)`,
      `Text Character Length ${plan.text_character_length}`,
      `Template Prompt Generation ${plan.prompt_generation} (Per day)`,
      `Support Request Sent ${plan.support_request} (Per day)`,
      `Max Token Limit ${plan.content_token_length}`,
      `Access Chat Bot ${plan.access_chat_bot} ${chatLimit}`,
      `Access Template ${plan.access_template} ${templateLimit}`,
   ];

   return (
      <>
         <Head title="Update Plan" />
         <Breadcrumb Icon={Pricing} title="Update Plan" className="mb-20" />

         <Card className="max-w-sm mx-auto">
            <div
               className={`group relative p-7 rounded-lg bg-gray-100 outline outline-3 outline-primary-500`}
            >
               <div className="absolute -top-4 left-0 right-0 flex justify-center">
                  <span className="py-1.5 px-[11px] bg-primary-500 rounded-full text12 text-white">
                     Current Plan
                  </span>
               </div>

               <h6 className="font-bold text-gray-900">{plan.name}</h6>
               <small className="text-gray-700 mt-1">
                  For individual designer and developer.
               </small>

               {plan.name === "Free" ? (
                  <p className="font-medium text-gray-700 my-8">
                     <span className="text-[40px] font-bold text-gray-900">
                        0
                     </span>
                  </p>
               ) : (
                  <>
                     {auth.user.recurring === "monthly" ? (
                        <p className="font-medium text-gray-700 dark:text-gray-300 my-8">
                           <span className="text-[40px] font-bold text-gray-900">
                              {plan.monthly_price}
                           </span>
                           {plan.currency} Monthly
                        </p>
                     ) : (
                        <p className="font-medium text-gray-700 dark:text-gray-300 my-8">
                           <span className="text-[40px] font-bold text-gray-900">
                              {plan.yearly_price}
                           </span>
                           {plan.currency} Yearly
                        </p>
                     )}
                  </>
               )}

               {auth.user.role === "admin" ? (
                  <Button
                     variant="outlined"
                     color="white"
                     className="capitalize border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500"
                  >
                     Update Plan
                  </Button>
               ) : (
                  <Link href={route("plans.select")}>
                     <Button
                        variant="outlined"
                        color="white"
                        className="capitalize border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500"
                     >
                        Update Plan
                     </Button>
                  </Link>
               )}

               {features.map((item, ind) => (
                  <div
                     key={ind}
                     className="flex items-center text-gray-700 mb-4 last:mb-0"
                  >
                     <CheckOutline className="w-4 h-4 mr-2" />
                     <small>{item}</small>
                  </div>
               ))}
            </div>
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
