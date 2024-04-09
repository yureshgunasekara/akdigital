import Card from "@/Components/Card";
import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";
import { Button } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Template from "@/Components/Icons/Template";
import { Head, router, useForm } from "@inertiajs/react";
import InputDropdown from "@/Components/InputDropdown";
import Dashboard from "@/Layouts/Dashboard";

const Update = ({ template }) => {
   const { id, title, access_plan, status, slug, description } = template;
   const { data, setData, patch } = useForm({
      title: title,
      slug: slug,
      type: access_plan,
      status: status,
      description: description,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      patch(route("templates.update", id));
   };

   return (
      <>
         <Head title="Templates Management" />
         <Breadcrumb Icon={Template} title="Templates Update" />

         <Card className="shadow-card max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Update {title} Template
               </p>
            </div>
            <form onSubmit={submit} className="p-7">
               <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                  <Input
                     fullWidth
                     name="title"
                     value={data.title}
                     placeholder="Enter the template name"
                     onChange={onHandleChange}
                     label="Template Name"
                     required
                  />
                  <Input
                     fullWidth
                     name="slug"
                     value={data.slug}
                     placeholder="Enter the template slug"
                     onChange={onHandleChange}
                     label="Template Slug"
                     required
                  />
                  <InputDropdown
                     required
                     fullWidth
                     label="Template Status"
                     defaultValue={data.status}
                     onChange={(e) => setData("status", e.value)}
                     itemList={[
                        { key: "Active", value: "active" },
                        { key: "Deactive", value: "deactive" },
                     ]}
                  />
                  <InputDropdown
                     required
                     fullWidth
                     label="Template Type"
                     defaultValue={data.type}
                     onChange={(e) => setData("type", e.value)}
                     itemList={[
                        { key: "Free", value: "Free" },
                        { key: "Standard", value: "Standard" },
                        { key: "Premium", value: "Premium" },
                     ]}
                  />
                  <TextArea
                     rows={4}
                     name="description"
                     value={data.description}
                     onChange={onHandleChange}
                     label="Template Description"
                     placeholder="Enter the short description of template"
                     className="min-h-0"
                     maxLength={120}
                     required
                  />
               </div>

               <div className="flex items-center">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
                  >
                     Save
                  </Button>
                  <Button
                     variant="outlined"
                     color="white"
                     onClick={() => router.get(route("templates.admin"))}
                     className="ml-4 capitalize text-gray-900 border-gray-900 text14"
                  >
                     Cancel
                  </Button>
               </div>
            </form>
         </Card>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
