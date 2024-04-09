import {
   Tab,
   Tabs,
   TabsBody,
   TabPanel,
   TabsHeader,
} from "@material-tailwind/react";
import { useState } from "react";
import Dashboard from "@/Layouts/Dashboard";
import { Head, Link } from "@inertiajs/react";
import Search from "@/Components/Icons/search";
import { Card } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Template from "@/Components/Icons/Template";
import templatesIcon from "@/Components/Icons/template_icons";
import LeftArrowCorner from "@/Components/Icons/LeftArrowCorner";

const Badge = ({ access }) => {
   return (
      <span className="absolute top-2.5 right-0 rounded-l-full bg-warning-500 text-xs text-gray-900 px-2 py-0.5">
         {access}
      </span>
   );
};

const Templates = (props) => {
   const { auth, templates, templateAccess, todaysTemplate } = props;
   const [query, setQuery] = useState("");

   const badge = (access) => {
      if (templateAccess === "Free") {
         if (access === "Free") {
            return;
         } else {
            return <Badge access={access} />;
         }
      } else if (templateAccess === "Standard") {
         if (access === "Free" || access === "Standard") {
            return;
         } else {
            return <Badge access={access} />;
         }
      } else if (templateAccess === "Premium") {
         return;
      } else {
         return <Badge access={access} />;
      }
   };

   const filteredPeople =
      query === ""
         ? templates
         : templates.filter((item) =>
              item.title
                 .toLowerCase()
                 .replace(/\s+/g, "")
                 .includes(query.toLowerCase().replace(/\s+/g, ""))
           );

   const getElements = (category) => {
      return filteredPeople.filter((element) => element.category === category);
   };

   const templateGroup = [
      {
         label: "All",
         value: "all",
         elements: filteredPeople,
      },
      {
         label: "Blog",
         value: "blog",
         elements: getElements("blog"),
      },
      {
         label: "Text",
         value: "text",
         elements: getElements("text"),
      },
      {
         label: "Social",
         value: "social",
         elements: getElements("social"),
      },
      {
         label: "Video",
         value: "video",
         elements: getElements("video"),
      },
      {
         label: "Discussion",
         value: "discussion",
         elements: getElements("discussion"),
      },
      {
         label: "Faq",
         value: "faq",
         elements: getElements("faq"),
      },
      {
         label: "Others",
         value: "other",
         elements: getElements("other"),
      },
   ];

   return (
      <>
         <Head title="Templates" />
         {auth.user.role === "admin" ? (
            <Breadcrumb Icon={Template} title="Templates" />
         ) : (
            <Breadcrumb
               Icon={Template}
               title="Templates"
               totalCount={todaysTemplate || 0}
               maxLimit={auth.user.subscription_plan.prompt_generation}
            />
         )}

         <Card className="shadow-card p-7">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
               <div>
                  <p className="text18 font-bold text-gray-900">
                     All Templates
                  </p>
                  <small className="text-gray-700">
                     Efficiently Streamline Your Writing Process with a
                     Comprehensive Collection of Templates.
                  </small>
               </div>
               <div className="w-full md:max-w-[260px] relative ml-auto">
                  <input
                     type="text"
                     placeholder="Search"
                     value={query}
                     onChange={(e) => setQuery(e.target.value)}
                     className="h-10 pl-12 pr-4 py-[15px] border border-gray-200 rounded-md w-full focus:ring-primary-500 focus:border-primary-500 text-sm font-normal text-gray-500"
                  />
                  <Search className="absolute w-4 h-4 top-3 left-4 text-gray-700 z-10" />
               </div>
            </div>

            <Tabs value="all">
               <TabsHeader className="mt-7 p-3 rounded-xl overflow-x-auto">
                  {templateGroup.map(({ label, value }) => (
                     <Tab
                        key={value}
                        value={value}
                        activeClassName="font-medium text-primary-500"
                     >
                        {label}
                     </Tab>
                  ))}
               </TabsHeader>
               <TabsBody className="mt-7">
                  {templateGroup.map(({ value, elements }) => (
                     <TabPanel key={value} value={value} className="p-0">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7">
                           {elements.map((item, index) => {
                              const {
                                 id,
                                 title,
                                 description,
                                 icon,
                                 access_plan,
                              } = item;
                              const Icon = templatesIcon[icon];

                              return (
                                 <Link
                                    key={id}
                                    href={`/templates/content/${id}`}
                                 >
                                    <Card
                                       key={index}
                                       className="template group relative"
                                    >
                                       {badge(access_plan)}
                                       <div className="mb-7 flex items-start justify-between">
                                          <Icon className="h-12 w-12" />
                                          <div className="w-[30px] h-[30px] rounded-full group-hover:bg-primary-500/80 flex items-center justify-center">
                                             <LeftArrowCorner className="group-hover:rotate-180 transition-all duration-300" />
                                          </div>
                                       </div>
                                       <p className="text18 text-gray-900 group-hover:text-white font-bold mb-3">
                                          {title}
                                       </p>
                                       <small className="text12 font-medium">
                                          {description}
                                       </small>
                                    </Card>
                                 </Link>
                              );
                           })}
                        </div>
                     </TabPanel>
                  ))}
               </TabsBody>
            </Tabs>
         </Card>
      </>
   );
};

Templates.layout = (page) => <Dashboard children={page} />;

export default Templates;
