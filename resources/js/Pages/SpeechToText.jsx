import axios from "axios";
import { useState } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import React, { useEffect } from "react";
import Spinner from "@/Components/Spinner";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import TextSaveEditor from "@/TextEditor/TextSaveEditor";
import TextArea from "@/Components/TextArea";
import Code from "@/Components/Icons/Code";
import { error } from "@/utils/toast";
import Microphone from "@/Components/Icons/Microphone";
import Dashboard from "@/Layouts/Dashboard";
import { getAudioLength } from "@/utils/utils";

const SpeechToText = (props) => {
   const { auth, todaysTexts } = props;
   const [isSubmit, setIsSubmit] = useState(false);
   const [isLoading, setIsLoading] = useState(false);
   const [result, setResult] = useState({
      title: "",
      description: "",
      text: "",
   });

   const { data, setData, reset } = useForm({
      title: "",
      description: "",
      audio: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const [errors, setErrors] = useState({
      title: null,
      audio: null,
      description: null,
   });

   const handleImageChange = (e) => {
      const files = e.target.files;
      if (files && files[0]) {
         setData("audio", files[0]);
      }
   };

   const submit = async (e) => {
      e.preventDefault();
      setIsLoading(true);
      const duration = await getAudioLength(data.audio);

      setResult({
         title: data.title,
         description: data.description,
         text: "",
      });
      setErrors({
         title: null,
         audio: null,
         description: null,
      });

      try {
         const formData = new FormData();
         formData.append("audio", data.audio);
         formData.append("title", data.title);
         formData.append("description", data.description);
         formData.append("audio_length", duration);

         const res = await axios.post("/speech-to-text", formData);
         if (res.data.error) {
            error(res.data.error);
            setIsLoading(false);
         } else {
            reset();
            setIsLoading(false);
            setResult((prev) => ({
               ...prev,
               text: res.data.text,
            }));
         }
      } catch (error) {
         setIsLoading(false);
         const { audio, title, description } = error.response.data.errors;

         if (audio && audio[0])
            setErrors((prev) => ({ ...prev, audio: audio[0] }));
         if (title && title[0])
            setErrors((prev) => ({ ...prev, title: title[0] }));
         if (description && description[0])
            setErrors((prev) => ({ ...prev, description: description[0] }));
      }
   };

   const clearHandler = () => {
      setResult({
         title: "",
         description: "",
         audio: "",
      });
   };

   useEffect(() => {
      if (
         result.title.length > 0 &&
         result.description.length > 0 &&
         result.text.length > 0
      ) {
         setIsSubmit(true);
      } else {
         setIsSubmit(false);
      }
   }, [result]);

   return (
      <>
         <Head title="Speech to text" />
         {auth.user.role === "admin" ? (
            <Breadcrumb Icon={Microphone} title="Speech to text" />
         ) : (
            <Breadcrumb
               Icon={Code}
               title="Speech to text"
               totalCount={todaysTexts || 0}
               maxLimit={auth.user.subscription_plan.speech_to_text_generation}
            />
         )}

         <div className="grid grid-cols-12 gap-7">
            <div className=" col-span-12 lg:col-span-4">
               <Card>
                  <div className="p-5 border-b border-gray-100 flex items-center">
                     <Microphone className="w-5 h-5 text-gray-400 mr-2" />
                     <p className="text18 text-gray-600">Speech To Text</p>
                  </div>
                  <form onSubmit={submit} className="p-5">
                     <div>
                        <Input
                           name="title"
                           label="Title"
                           value={data.title}
                           error={errors.title}
                           onChange={onHandleChange}
                           placeholder="New Code"
                           maxLength={50}
                           required
                        />
                     </div>

                     <div className="mt-5">
                        <p className="mb-4 text-sm font-medium text-gray-500">
                           Upload audio <span className="text-red-500">*</span>
                        </p>
                        <label
                           htmlFor="audio"
                           className="border border-gray-200 hover:border-primary-500 px-5 py-3 text-sm text-gray-500 hover:text-primary-500 h-10 font-bold rounded-lg cursor-pointer"
                        >
                           Upload Audio
                        </label>
                        <input
                           id="audio"
                           type="file"
                           name="audio"
                           onChange={handleImageChange}
                           required
                           hidden
                        />
                        <p className="text-xs text-gray-500 mt-4">
                           {`Max speech duration ${
                              auth.user.role === "admin"
                                 ? "unlimited for admin"
                                 : auth.user.subscription_plan.speech_duration +
                                   " minutes"
                           }`}
                        </p>
                        {errors.audio && (
                           <p className="text-sm text-red-500 mt-1">
                              {errors.audio}
                           </p>
                        )}
                     </div>

                     <div className="mt-6">
                        <TextArea
                           rows={8}
                           name="description"
                           label="Description"
                           value={data.description}
                           error={errors.description}
                           onChange={onHandleChange}
                           placeholder="e.g. describe about your code"
                           className="min-h-0"
                           maxLength={200}
                           required
                        />
                        <p className="text-xs text-gray-500 mt-2">
                           To assist the AI, describe the speech from the file.
                        </p>
                     </div>

                     <Button
                        type="submit"
                        className="capitalize bg-primary-500 text-white text-sm px-5 mt-10 py-0 h-10"
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

            <div className="col-span-12 lg:col-span-8">
               <TextSaveEditor
                  textInfo={result}
                  request="POST"
                  isSubmit={isSubmit}
                  clearHandler={clearHandler}
               />
            </div>
         </div>
      </>
   );
};

SpeechToText.layout = (page) => <Dashboard children={page} />;

export default SpeechToText;
