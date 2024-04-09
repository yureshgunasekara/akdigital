import { useState } from "react";
import "katex/dist/katex.min.css";
import "react-quill/dist/quill.snow.css";
import Page from "@/Components/Icons/Page";
import Dashboard from "@/Layouts/Dashboard";
import Breadcrumb from "@/Components/Breadcrumb";
import Input from "@/Components/Input";
import { Head, useForm } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";
import ReactQuill from "react-quill";
import { formats } from "@/utils/utils";
import CustomToolbar from "@/TextEditor/CustomToolbar";
import katex from "katex";
window.katex = katex;

const Update = ({ custom_page }) => {
   const [validRoute, setValidRoute] = useState(true);
   const modules = { toolbar: { container: "#toolbar" } };

   const { data, setData, put, errors, clearErrors } = useForm({
      name: custom_page.name ?? "",
      route: custom_page.route ?? "",
      content: custom_page.content ?? "",
   });

   const onHandleChange = (event) => {
      if (event.target.name === "route") {
         const value = event.target.value;
         setData(event.target.name, value);

         if (value.length > 0) {
            // Input validation for characters and hyphen
            const regex = /^[a-z]+(-[a-z]+)*$/;
            const isValidInput = regex.test(event.target.value);

            setValidRoute(isValidInput);
         } else {
            setValidRoute(true);
         }
      } else {
         setData(event.target.name, event.target.value);
      }
   };

   const submit = (e) => {
      e.preventDefault();
      if (validRoute) {
         clearErrors();
         put(route("custom-page.save", custom_page.id));
      }
   };

   return (
      <>
         <Head title="Update Custom Page" />
         <Breadcrumb Icon={Page} title="Update Custom Page" />

         <Card className="max-w-[1200px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">Update New Page</p>
            </div>
            <form onSubmit={submit} className="p-7">
               <div className="mb-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                  <Input
                     fullWidth
                     name="name"
                     value={data.name}
                     error={errors.name}
                     placeholder="Name of the page"
                     onChange={onHandleChange}
                     label="Full Name"
                     required
                  />

                  <Input
                     fullWidth
                     name="route"
                     value={data.route}
                     error={
                        errors.route ?? !validRoute
                           ? "Route should be characters and you can use hyphen(-) for separation"
                           : false
                     }
                     placeholder="Page route or url"
                     onChange={onHandleChange}
                     label="Route"
                     required
                  />
               </div>

               <div>
                  <small className="w-full mb-1 whitespace-nowrap flex items-center font-medium text-gray-500">
                     <span className="mr-1">Page Content</span>
                     <span className="block text-red-500">*</span>
                  </small>
                  <div className="border border-gray-300 rounded-md">
                     <CustomToolbar />
                     <ReactQuill
                        modules={modules}
                        formats={formats}
                        value={data.content}
                        onChange={(html) => setData("content", html)}
                        className="page-create border-0"
                     />
                  </div>
               </div>

               <Button
                  type="submit"
                  variant="text"
                  color="white"
                  disabled={!validRoute}
                  className="mt-10 bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
               >
                  Update Page
               </Button>
            </form>
         </Card>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
