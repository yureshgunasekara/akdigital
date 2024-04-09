import "katex/dist/katex.min.css";
import "react-quill/dist/quill.snow.css";
import { useEffect } from "react";
import ReactQuill from "react-quill";
import { formats } from "@/utils/utils";
import CustomToolbar from "./CustomToolbar";
import { Button } from "@material-tailwind/react";
import { useForm } from "@inertiajs/react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import katex from "katex";
window.katex = katex;

const TextSaveEditor = (props) => {
   const { textInfo, request, isSubmit, clearHandler } = props;
   const modules = { toolbar: { container: "#toolbar" } };

   const { data, setData, post, put, reset } = useForm({
      title: "",
      description: "",
      text: "",
   });

   useEffect(() => {
      setData(textInfo);
   }, [textInfo]);

   const submit = (e) => {
      e.preventDefault();
      if (request === "POST") {
         post(route("text-save"));
      } else {
         put(route("speech-to-text-update", textInfo.id));
      }
   };

   return (
      <Card>
         <form onSubmit={submit}>
            {request === "PUT" && (
               <div className="px-5 pt-5">
                  <Input
                     required
                     flexLabel
                     name="title"
                     label="Document Name"
                     value={data.title}
                     onChange={(e) => setData("title", e.target.value)}
                     maxLength={50}
                  />
               </div>
            )}

            <CustomToolbar />
            <ReactQuill
               value={data.text}
               onChange={(html) => setData("text", html)}
               modules={modules}
               formats={formats}
               className="border-0 min-h-[480px] max-h-[480px] overflow-y-auto"
            />

            <div className="flex justify-end items-center p-5">
               <Button
                  variant="outlined"
                  color="white"
                  disabled={!isSubmit}
                  onClick={() => clearHandler()}
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
         </form>
      </Card>
   );
};

export default TextSaveEditor;
