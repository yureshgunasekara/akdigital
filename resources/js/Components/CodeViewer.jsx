import Copy from "./Icons/Copy";
import Code from "./Icons/Code";
import Check from "./Icons/Check";
import Delete from "./Icons/Delete";
import { router, useForm } from "@inertiajs/react";
import { useEffect, useRef, useState } from "react";
import { Button, Card } from "@material-tailwind/react";
import { Prism as SyntaxHighlighter } from "react-syntax-highlighter";
import { dracula } from "react-syntax-highlighter/dist/esm/styles/prism";

const CodeViewer = (props) => {
   const { parentClass, childClass, className, codeInfo, request } = props;
   const [isCopy, setIsCopy] = useState(false);
   const [isSubmit, setIsSubmit] = useState(false);

   const { data, setData, post, put, reset } = useForm({
      title: "",
      language: "",
      description: "",
      code: "",
   });

   const submit = async (e) => {
      e.preventDefault();

      if (request === "POST") {
         post(route("code-save"));
      } else {
         put(route("code-update", codeInfo.id));
      }
   };

   useEffect(() => {
      setData(codeInfo);
   }, [codeInfo]);

   useEffect(() => {
      if (
         data.title.length > 0 &&
         data.language.length > 0 &&
         data.description.length > 0 &&
         data.code.length > 0
      ) {
         setIsSubmit(true);
      } else {
         setIsSubmit(false);
      }
   }, [data]);

   const handleCopy = async () => {
      try {
         setIsCopy(true);
         await navigator.clipboard.writeText(data.code);
      } catch (error) {
         setIsCopy(false);
      }
   };

   useEffect(() => {
      if (isCopy) setTimeout(() => setIsCopy(false), 1000);
   }, [isCopy]);

   const handleDelete = (id) => {
      router.delete(route("generated-codes-delete", id));
   };

   const childRef = useRef(null);

   useEffect(() => {
      if (childRef.current) {
         let childElement = childRef.current.firstChild;
         const classes = childClass.split(" ");
         childElement.classList.add(...classes);
      }
   }, []);

   return (
      <Card className={parentClass}>
         <form onSubmit={submit}>
            <div className="p-5 border-b border-gray-100 flex items-center justify-between">
               <div className="flex items-center">
                  <Code className="w-5 h-5 text-gray-400 mr-2" />
                  <p className="text18 text-gray-600">Produced Result</p>
               </div>
               <div className="flex items-center">
                  <Button
                     color="white"
                     variant="text"
                     onClick={handleCopy}
                     className="w-8 h-8 p-0 flex rounded-full items-center justify-center bg-gray-50 hover:bg-primary-50 active:bg-primary-50 text-gray-500 hover:text-primary-500"
                  >
                     {isCopy ? (
                        <Check className="w-4 h-6" />
                     ) : (
                        <Copy className="w-4 h-6" />
                     )}
                  </Button>
                  {request === "DELETE" && (
                     <Button
                        color="white"
                        variant="text"
                        onClick={() => handleDelete(codeInfo.id)}
                        className="w-8 h-8 p-0 ml-3 flex rounded-full items-center justify-center bg-gray-50 hover:bg-red-50 active:bg-red-50 text-gray-500 hover:text-red-500"
                     >
                        <Delete className="w-4 h-6" />
                     </Button>
                  )}
               </div>
            </div>

            <div ref={childRef} className="p-5">
               <SyntaxHighlighter
                  style={dracula}
                  language={data.language}
                  showLineNumbers="true"
               >
                  {data.code.trim()}
               </SyntaxHighlighter>
               <div className="flex justify-end items-center pt-5">
                  <Button
                     variant="outlined"
                     color="white"
                     disabled={!isSubmit}
                     onClick={() => reset()}
                     className="capitalize border-primary-500 text-primary-500 text-sm ml-5 px-5 py-0 h-10"
                  >
                     Clear
                  </Button>
                  <Button
                     type="submit"
                     color="white"
                     disabled={!isSubmit}
                     className="capitalize bg-primary-500 text-white text-sm ml-5 px-5 py-0 h-10"
                  >
                     Save
                  </Button>
               </div>
            </div>
         </form>
      </Card>
   );
};

export default CodeViewer;
