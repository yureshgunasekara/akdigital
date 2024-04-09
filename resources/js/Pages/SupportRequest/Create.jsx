import Card from "@/Components/Card";
import Input from "@/Components/Input";
import Dashboard from "@/Layouts/Dashboard";
import TextArea from "@/Components/TextArea";
import { Button } from "@material-tailwind/react";
import { Head, useForm } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Support from "@/Components/Icons/Support";
import InputDropdown from "@/Components/InputDropdown";

const Create = (props) => {
   const { data, setData, post } = useForm({
      category: "General Inquiry",
      priority: "Support Priority",
      subject: "",
      attachment: "",
      description: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = async (e) => {
      e.preventDefault();
      post(route("support-request.store"));
   };

   const generalInquiry = [
      { key: "General Inquiry", value: "General Inquiry" },
      { key: "Technical Issue", value: "Technical Issue" },
      { key: "Improvement Idea", value: "Improvement Idea" },
      { key: "Feedback", value: "Feedback" },
   ];

   const supportPriority = [
      { key: "Low", value: "Low" },
      { key: "Normal", value: "Normal" },
      { key: "High", value: "High" },
      { key: "Critical", value: "Critical" },
   ];

   return (
      <>
         <Head title="Support Request Create" />
         <Breadcrumb Icon={Support} title="Support Request Create" />

         <Card className="max-w-[1000px] w-full mx-auto mt-8">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Create Support Request
               </p>
            </div>

            <form
               onSubmit={submit}
               encType="multipart/form-data"
               className="p-7"
            >
               <div className="mt-1">
                  <InputDropdown
                     required
                     fullWidth
                     flexLabel
                     label="Support Category"
                     defaultValue="General Inquiry"
                     itemList={generalInquiry}
                     onChange={(e) => setData("category", e.value)}
                  />
               </div>

               <div className="mt-8">
                  <InputDropdown
                     required
                     fullWidth
                     flexLabel
                     label="Support Priority"
                     defaultValue="Low"
                     itemList={supportPriority}
                     onChange={(e) => setData("priority", e.value)}
                  />
               </div>

               <div className="mt-8">
                  <Input
                     flexLabel
                     name="subject"
                     value={data.subject}
                     onChange={onHandleChange}
                     label="Subject"
                     placeholder="Subject of your support session"
                     maxLength={100}
                     required
                  />
               </div>

               <div className="mt-8 flex flex-col items-start md:flex-row md:items-center">
                  <small className="max-w-[164px] w-full mb-1 whitespace-nowrap font-medium text-gray-500">
                     <span className="mr-1">Attachment</span>
                  </small>
                  <input
                     type="file"
                     onChange={(e) => setData("attachment", e.target.files[0])}
                     className="relative m-0 block w-full min-w-0 flex-auto rounded-md border border-solid border-neutral-300 dark:border-neutral-600 bg-clip-padding py-[8px] px-2.5 text-sm font-normal text-neutral-700 dark:text-neutral-200 transition duration-300 ease-in-out file:-mx-3 file:-my-[8px] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 dark:file:bg-neutral-700 file:px-3 file:py-[8px] file:text-neutral-700 dark:file:text-neutral-100 file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200 !border-gray-300 focus:!border-primary-500 focus:outline-0 shadow-sm"
                  />
               </div>

               <div className="mt-8">
                  <TextArea
                     rows={4}
                     flexLabel
                     fullWidth
                     name="description"
                     value={data.description}
                     label="Description"
                     placeholder="Describe what we can do for you."
                     onChange={onHandleChange}
                     maxLength={400}
                     required
                  />
               </div>

               <div className="flex items-center mt-10 md:pl-[164px]">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md"
                  >
                     Create
                  </Button>
                  <Button
                     variant="outlined"
                     color="red"
                     type="button"
                     className="ml-3 capitalize"
                  >
                     <span>Cancel</span>
                  </Button>
               </div>
            </form>
         </Card>
      </>
   );
};

Create.layout = (page) => <Dashboard children={page} />;

export default Create;
