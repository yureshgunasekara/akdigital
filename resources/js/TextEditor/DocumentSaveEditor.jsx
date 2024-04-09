import "katex/dist/katex.min.css";
import "react-quill/dist/quill.snow.css";
import ReactQuill from "react-quill";
import { formats } from "@/utils/utils";
import CustomToolbar from "./CustomToolbar";
import { useEffect, useState } from "react";
import { Button } from "@material-tailwind/react";
import { useForm, usePage } from "@inertiajs/react";
import katex from "katex";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
window.katex = katex;

const DocumentSaveEditor = (props) => {
   const page = usePage();
   const { template, language, content } = props;
   const modules = { toolbar: { container: "#toolbar" } };

   const { data, setData, post, processing, errors, reset } = useForm({
      user_id: page.props.auth.user.id,
      template_id: template.id,
      document_name: "New Document",
      language: language,
      document: "",
      word_count: "",
   });

   useEffect(() => {
      if (content) {
         const formattedText = content.slice(2).replace(/\n/g, "<br/>");
         setData("document", formattedText);
      }
   }, [content]);

   useEffect(() => {
      const words = data.document.split(" ").length;
      setData("word_count", words);
   }, [data.document]);

   const submit = (e) => {
      e.preventDefault();
      post(route("content-store"));
   };

   return (
      <Card>
         <form onSubmit={submit}>
            <div className="px-5 pt-5">
               <Input
                  required
                  flexLabel
                  name="document_name"
                  label="Document Name"
                  value={data.document_name}
                  onChange={(e) => setData("document_name", e.target.value)}
               />
            </div>
            <CustomToolbar />
            <ReactQuill
               value={data.document}
               onChange={(html) => setData("document", html)}
               modules={modules}
               formats={formats}
               className="border-0 h-[400px] overflow-y-auto"
            />
            <div className="flex justify-end items-center p-5">
               <Button
                  variant="outlined"
                  color="white"
                  className="capitalize border-primary-500 text-primary-500 text-sm ml-5 px-5 py-0 h-10"
                  disabled={data.document.length > 0 ? false : true}
                  onClick={() => reset("document")}
               >
                  Clear
               </Button>
               <Button
                  type="submit"
                  color="white"
                  className="capitalize bg-primary-500 text-white text-sm ml-5 px-5 py-0 h-10"
               >
                  Save
               </Button>
            </div>
         </form>
      </Card>
   );
};

export default DocumentSaveEditor;
