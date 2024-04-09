import "katex/dist/katex.min.css";
import "react-quill/dist/quill.snow.css";
import ReactQuill from "react-quill";
import { formats } from "@/utils/utils";
import CustomToolbar from "./CustomToolbar";
import { useEffect } from "react";
import { Button, Card } from "@material-tailwind/react";
import { useForm } from "@inertiajs/react";
import katex from "katex";
import Input from "@/Components/Input";
window.katex = katex;

const DocumentUpdateEditor = (props) => {
   const modules = { toolbar: { container: "#toolbar" } };
   const { id, document_name, document, word_count } = props.document;

   const { data, setData, put, reset } = useForm({
      document_name: document_name,
      document: document,
      word_count: word_count,
   });

   useEffect(() => {
      const words = data.document.split(" ").length;
      setData("word_count", words);
   }, [data.document]);

   const submit = (e) => {
      e.preventDefault();
      put(route("template-content-update", id));
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
                  maxLength={50}
               />
            </div>
            <CustomToolbar />
            <ReactQuill
               value={data.document}
               onChange={(html) => setData("document", html)}
               modules={modules}
               formats={formats}
               className="border-0 min-h-[calc(100vh-488px)] overflow-y-auto"
            />
            <div className="flex justify-start items-center p-5">
               <Button
                  variant="outlined"
                  color="white"
                  className="capitalize border-primary-500 text-primary-500 text-sm px-5 py-0 h-10"
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

export default DocumentUpdateEditor;
