import axios from "axios";
import React, { useEffect } from "react";
import { useState } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import Spinner from "@/Components/Spinner";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import InputDropdown from "@/Components/InputDropdown";
import CompletionInput from "@/Components/CompletionInput";
import DocumentSaveEditor from "@/TextEditor/DocumentSaveEditor";
import { error, warning } from "@/utils/toast";
import Breadcrumb from "@/Components/Breadcrumb";
import Template from "@/Components/Icons/Template";
import Dashboard from "@/Layouts/Dashboard";

const Create = (props) => {
   const { auth, template, todaysTemplate, global } = props;
   const [result, setResult] = useState(null);
   const [isSubmit, setIsSubmit] = useState(false);
   const [isLoading, setIsLoading] = useState(false);

   const { data, setData, errors } = useForm({
      prompt: null,
      language: "English",
      title: "",
      name: "",
      subheadings: "",
      keywords: "",
      details: "",
      description: "",
      audience: "",
      creativity: "medium",
      tone: "Casual",
      results: 1,
      length: 200,
      template_id: template.id,
      model: global.model,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const handlePrompt = (data) => {
      const fields = [
         { title: "title", value: data.title },
         { title: "name", value: data.name },
         { title: "subheadings", value: data.subheadings },
         { title: "keywords", value: data.keywords },
         { title: "details", value: data.details },
         { title: "description", value: data.description },
         { title: "audience", value: data.audience },
         { title: "language", value: data.language },
         { title: "tone", value: data.tone },
      ];

      let prompt = template.prompt;
      fields.map((field) => {
         if (template.prompt.includes(`_${field.title}_`)) {
            prompt = prompt.replace(
               new RegExp(`_${field.title}_`, "g"),
               field.value
            );
         }
      });

      setData("prompt", prompt);
   };

   const submit = async (e) => {
      e.preventDefault();
      await handlePrompt(data);
      setIsSubmit(true);
      setIsLoading(true);
   };

   useEffect(() => {
      if (data.prompt && isSubmit) {
         try {
            axios.post("/templates/content", data).then((res) => {
               if (res.data.error) {
                  error(res.data.error);
               } else if (res.data.warning) {
                  warning(res.data.warning);
               } else {
                  res.data.choices.forEach((element, index) => {
                     const br = index > 0 ? "<br/><br/>" : "";
                     setResult(
                        (prev) => `${prev} ${br} ${element.message.content}`
                     );
                  });
               }
               setIsSubmit(false);
               setIsLoading(false);
            });
         } catch (error) {
            setIsSubmit(false);
            setIsLoading(false);
         }
      }
   }, [isSubmit]);

   const languages = [
      { key: "English", value: "English" },
      { key: "French", value: "French" },
      { key: "Russian", value: "Russian" },
      { key: "Spanish", value: "Spanish" },
   ];

   const creativity = [
      { key: "Low", value: "low" },
      { key: "Medium", value: "medium" },
      { key: "High", value: "high" },
   ];

   const tonsOfVoice = [
      { key: "Funny", value: "Funny" },
      { key: "Casual", value: "Casual" },
      { key: "Exited", value: "Exited" },
   ];

   return (
      <>
         <Head title="Content Create" />
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

         <div className="grid grid-cols-12 gap-7">
            <div className=" col-span-12 lg:col-span-4">
               <Card className="p-5">
                  <p className="text18 font-medium text-gray-900 mb-2">
                     {template.title}
                  </p>
                  <small className="text-gray-700">
                     {template.description}
                  </small>
                  <form onSubmit={submit} className="flex flex-col gap-5 mt-5">
                     <InputDropdown
                        fullWidth
                        label="Language"
                        defaultValue="English"
                        itemList={languages}
                        onChange={(e) => setData("language", e.value)}
                     />

                     <CompletionInput
                        data={data}
                        errors={errors}
                        template={template.slug}
                        onHandleChange={onHandleChange}
                     />

                     <div className="grid grid-cols-2 gap-6">
                        <InputDropdown
                           fullWidth
                           label="Creativity"
                           defaultValue="medium"
                           itemList={creativity}
                           onChange={(e) => setData("creativity", e.value)}
                        />
                        <InputDropdown
                           fullWidth
                           label="Tone of Voice"
                           defaultValue="Casual"
                           itemList={tonsOfVoice}
                           onChange={(e) => setData("tone", e.value)}
                        />
                     </div>

                     <div className="grid grid-cols-2 gap-6">
                        <InputDropdown
                           fullWidth
                           label="Number of results"
                           defaultValue={"1"}
                           itemList={[
                              { key: "1", value: "1" },
                              { key: "2", value: "2" },
                              { key: "3", value: "3" },
                           ]}
                           onChange={(e) =>
                              setData("results", parseInt(e.value))
                           }
                        />

                        <Input
                           type="number"
                           name="length"
                           label="Token Length "
                           value={data.length}
                           onChange={onHandleChange}
                           required
                        />
                     </div>

                     <Button
                        type="submit"
                        className="capitalize bg-primary-500 text-white text-sm px-5 mt-2 py-0 h-10"
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
               <DocumentSaveEditor
                  template={template}
                  language={data.language}
                  content={result}
               />
            </div>
         </div>
      </>
   );
};

Create.layout = (page) => <Dashboard children={page} />;

export default Create;
