import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Microphone from "@/Components/Icons/Microphone";
import TextSaveEditor from "@/TextEditor/TextSaveEditor";
import { useEffect, useState } from "react";
import Dashboard from "@/Layouts/Dashboard";

const Update = (props) => {
   const [result, setResult] = useState(props.text);
   const [isSubmit, setIsSubmit] = useState(false);

   const clearHandler = () => {
      setResult({
         title: "",
         description: "",
         audio: "",
      });
   };

   useEffect(() => {
      setResult(props.text);
   }, []);

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
         <Head title="Notifications" />
         <Breadcrumb Icon={Microphone} title="Update Document" />
         <div className="max-w-[920px] w-full mx-auto">
            <TextSaveEditor
               textInfo={result}
               request="PUT"
               isSubmit={isSubmit}
               clearHandler={clearHandler}
            />
         </div>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
