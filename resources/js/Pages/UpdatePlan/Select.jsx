import {
   Tab,
   Tabs,
   TabsBody,
   TabPanel,
   TabsHeader,
} from "@material-tailwind/react";
import Card from "@/Components/Card";
import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Pricing from "@/Components/Icons/Pricing";
import { Button } from "@material-tailwind/react";
import CheckOutline from "@/Components/Icons/CheckOutline";
import Dashboard from "@/Layouts/Dashboard";

const Select = (props) => {
   const { plans } = props;

   return (
      <>
         <Head title="Update Plan" />
         <Breadcrumb Icon={Pricing} title="Update Plan" />

         <Card className="p-7 max-w-[1200px] w-full mx-auto">
            <p className="text-sm text-gray-700 text-center mt-4 mb-12">
               Find the Perfect Plan for Your Business Goals with Our
               Comprehensive Pricing Options
            </p>

            <Tabs value="monthly">
               <TabsHeader
                  className="bg-transparent"
                  indicatorProps={{
                     className: "bg-blue-500/10 shadow-none text-blue-500",
                  }}
               >
                  <div className="max-w-[200px] w-full flex mx-auto">
                     <Tab value="monthly" className="py-2">
                        Monthly
                     </Tab>
                     <Tab value="yearly" className="py-2">
                        Yearly
                     </Tab>
                  </div>
               </TabsHeader>
               <TabsBody>
                  <TabPanel value="monthly">
                     <div className="grid grid-cols-1 md:grid-cols-3 gap-7">
                        {plans.map((item, ind) => {
                           const chatLimit =
                              item.access_chat_bot === "Standard"
                                 ? "(Include Free)"
                                 : item.access_chat_bot === "Premium"
                                 ? "(Include Free + Standard)"
                                 : "";
                           const templateLimit =
                              item.access_template === "Standard"
                                 ? "(Include Free)"
                                 : item.access_template === "Premium"
                                 ? "(Include Free + Standard)"
                                 : "";
                           const features = [
                              `Code Generation ${item.code_generation} (Per day)`,
                              `Image Generation ${item.image_generation} (Per day)`,
                              `Speech To Text Generation ${item.speech_to_text_generation} (Per day)`,
                              `Speech Duration ${item.speech_duration} Minute`,
                              `Text To Speech Generation ${item.text_to_speech_generation} (Per day)`,
                              `Text Character Length ${item.text_character_length}`,
                              `Template Prompt Generation ${item.prompt_generation} (Per day)`,
                              `Support Request Sent ${item.support_request} (Per day)`,
                              `Max Token Limit ${item.content_token_length}`,
                              `Access Chat Bot ${item.access_chat_bot} ${chatLimit}`,
                              `Access Template ${item.access_template} ${templateLimit}`,
                           ];

                           return (
                              <div
                                 key={ind}
                                 className={`group relative p-7 rounded-lg bg-gray-100 hover:outline hover:outline-3 hover:outline-primary-500 hover:bg-white`}
                              >
                                 <h6 className="font-bold text-gray-900">
                                    {item.name}
                                 </h6>
                                 <small className="text-gray-700 mt-1">
                                    For individual designer and developer.
                                 </small>

                                 {item.name === "Free" ? (
                                    <>
                                       <p className="font-medium text-gray-700 my-8">
                                          <span className="text-[40px] font-bold text-gray-900">
                                             0
                                          </span>
                                       </p>

                                       <Button
                                          variant="outlined"
                                          color="white"
                                          className="capitalize border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500"
                                       >
                                          Update Plan
                                       </Button>
                                    </>
                                 ) : (
                                    <>
                                       <p className="font-medium text-gray-700 my-8">
                                          <span className="text-[40px] font-bold text-gray-900">
                                             {item.monthly_price}{" "}
                                          </span>
                                          {item.currency} Monthly
                                       </p>
                                       <a
                                          href={route("plans.selected", [
                                             { id: item.id },
                                             { type: "monthly" },
                                          ])}
                                       >
                                          <Button
                                             variant="outlined"
                                             color="white"
                                             className="capitalize border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500"
                                          >
                                             Update Plan
                                          </Button>
                                       </a>
                                    </>
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
                           );
                        })}
                     </div>
                  </TabPanel>
                  <TabPanel value="yearly">
                     <div className="grid grid-cols-1 md:grid-cols-3 gap-7">
                        {plans.map((item, ind) => {
                           const chatLimit =
                              item.access_chat_bot === "Standard"
                                 ? "(Include Free)"
                                 : item.access_chat_bot === "Premium"
                                 ? "(Include Free + Standard)"
                                 : "";
                           const templateLimit =
                              item.access_template === "Standard"
                                 ? "(Include Free)"
                                 : item.access_template === "Premium"
                                 ? "(Include Free + Standard)"
                                 : "";

                           const features = [
                              `Code Generation ${item.code_generation} (Per day)`,
                              `Image Generation ${item.image_generation} (Per day)`,
                              `Speech To Text Generation ${item.speech_to_text_generation} (Per day)`,
                              `Speech Duration ${item.speech_duration} Minute`,
                              `Text To Speech Generation ${item.text_to_speech_generation} (Per day)`,
                              `Text Character Length ${item.text_character_length}`,
                              `Template Prompt Generation ${item.prompt_generation} (Per day)`,
                              `Support Request Sent ${item.support_request} (Per day)`,
                              `Max Token Limit ${item.content_token_length}`,
                              `Access Chat Bot ${item.access_chat_bot} ${chatLimit}`,
                              `Access Template ${item.access_template} ${templateLimit}`,
                           ];

                           return (
                              <div
                                 key={ind}
                                 className={`group relative p-7 rounded-lg bg-gray-100 hover:outline hover:outline-3 hover:outline-primary-500 hover:bg-white`}
                              >
                                 <h6 className="font-bold text-gray-900">
                                    {item.name}
                                 </h6>
                                 <small className="text-gray-700 mt-1">
                                    For individual designer and developer.
                                 </small>

                                 {item.name === "Free" ? (
                                    <>
                                       <p className="font-medium text-gray-700 my-8">
                                          <span className="text-[40px] font-bold text-gray-900">
                                             0
                                          </span>
                                       </p>

                                       <Button
                                          variant="outlined"
                                          color="white"
                                          className="capitalize border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500"
                                       >
                                          Update Plan
                                       </Button>
                                    </>
                                 ) : (
                                    <>
                                       <p className="font-medium text-gray-700 my-8">
                                          <span className="text-[40px] font-bold text-gray-900">
                                             {item.yearly_price}{" "}
                                          </span>
                                          {item.currency} Yearly
                                       </p>
                                       <a
                                          href={route("plans.selected", [
                                             { id: item.id },
                                             { type: "yearly" },
                                          ])}
                                       >
                                          <Button
                                             variant="outlined"
                                             color="white"
                                             className="capitalize border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500"
                                          >
                                             Update Plan
                                          </Button>
                                       </a>
                                    </>
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
                           );
                        })}
                     </div>
                  </TabPanel>
               </TabsBody>
            </Tabs>
         </Card>
      </>
   );
};

Select.layout = (page) => <Dashboard children={page} />;

export default Select;
