import axios from "axios";
import { useState } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import Spinner from "@/Components/Spinner";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import TextArea from "@/Components/TextArea";
import Code from "@/Components/Icons/Code";
import * as languages from "react-syntax-highlighter/dist/esm/languages/hljs";
import InputDropdown from "@/Components/InputDropdown";
import CodeViewer from "@/Components/CodeViewer";
import Dashboard from "@/Layouts/Dashboard";
import { error, warning } from "@/utils/toast";

const AiCode = (props) => {
   let langs = [];
   const { auth, todaysCodes } = props;
   Object.entries(languages).forEach(([name, language]) => {
      const item = { key: name, value: name };
      langs.push(item);
   });

   const [isLoading, setIsLoading] = useState(false);
   const [result, setResult] = useState({
      title: "",
      language: "",
      description: "",
      code: "",
   });

   const { data, setData } = useForm({
      title: "",
      language: "javascript",
      details: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const [errors, setErrors] = useState({
      title: null,
      language: null,
      details: null,
   });

   const submit = async (e) => {
      e.preventDefault();
      setIsLoading(true);
      setErrors({
         title: null,
         language: null,
         details: null,
      });

      try {
         const res = await axios.post("/ai-code", data);
         if (res.data.error) {
            error(res.data.error);
            setIsLoading(false);
         } else if (res.data.warning) {
            warning(res.data.warning);
            setIsLoading(false);
         } else {
            setResult(res.data);
            setIsLoading(false);
         }
      } catch (error) {
         setIsLoading(false);
         const { title, language, details } = error.response.data.errors;

         if (title && title[0])
            setErrors((prev) => ({ ...prev, title: title[0] }));
         if (details && details[0])
            setErrors((prev) => ({ ...prev, details: details[0] }));
         if (language && language[0])
            setErrors((prev) => ({ ...prev, language: language[0] }));
      }
   };

   return (
      <>
         <Head title="Content Create" />
         {auth.user.role === "admin" ? (
            <Breadcrumb Icon={Code} title="Ai Code" />
         ) : (
            <Breadcrumb
               Icon={Code}
               title="Ai Code"
               totalCount={todaysCodes || 0}
               maxLimit={auth.user.subscription_plan.code_generation}
            />
         )}

         <div className="grid grid-cols-12 gap-7">
            <div className=" col-span-12 lg:col-span-4">
               <Card>
                  <div className="p-5 border-b border-gray-100 flex items-center">
                     <Code className="w-5 h-5 text-gray-400 mr-2" />
                     <p className="text18 text-gray-600">Ai Code</p>
                  </div>
                  <form onSubmit={submit} className="p-5">
                     <p className="text14 bg-gray-25 rounded-lg text-gray-400 p-5">
                        You can generate code for any programming language
                        according to your questions.
                     </p>
                     <div className="mt-5">
                        <Input
                           name="title"
                           value={data.title}
                           onChange={onHandleChange}
                           label="Title"
                           placeholder="New Code"
                           maxLength={110}
                           required
                        />
                        {errors.title && (
                           <p className="text-sm text-red-500 mt-1">
                              {errors.title}
                           </p>
                        )}
                     </div>
                     <div className="mt-5">
                        <InputDropdown
                           required
                           fullWidth
                           label="Language"
                           defaultValue={data.language}
                           itemList={langs}
                           onChange={(e) => setData("language", e.value)}
                        />
                        {errors.language && (
                           <p className="text-sm text-red-500 mt-1">
                              {errors.language}
                           </p>
                        )}
                     </div>
                     <div className="mt-5">
                        <TextArea
                           rows={10}
                           name="details"
                           value={data.details}
                           onChange={onHandleChange}
                           label="Description"
                           placeholder="e.g. describe about your code"
                           className="min-h-0"
                           maxLength={600}
                           required
                        />
                        {errors.details && (
                           <p className="text-sm text-red-500 mt-1">
                              {errors.details}
                           </p>
                        )}
                     </div>

                     <Button
                        type="submit"
                        className="capitalize bg-primary-500 text-white text-sm px-5 mt-6 py-0 h-10"
                        color="white"
                        fullWidth
                     >
                        {isLoading ? (
                           <Spinner className="text-white !w-6 !h-6 !border-2" />
                        ) : (
                           <span>Submit</span>
                        )}
                     </Button>
                  </form>
               </Card>
            </div>

            <div className=" col-span-12 lg:col-span-8">
               <CodeViewer
                  request="POST"
                  codeInfo={result}
                  parentClass=""
                  childClass="min-h-[494px] !m-0"
               />
            </div>
         </div>
      </>
   );
};

AiCode.layout = (page) => <Dashboard children={page} />;

export default AiCode;
