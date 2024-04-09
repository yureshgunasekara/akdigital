import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const BlogIntros = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="title"
            value={data.title}
            onChange={onHandleChange}
            label="Blog Post Title"
            placeholder="e.g. describe blog title"
            maxLength={200}
            required
         />

         <TextArea
            rows={4}
            name="details"
            value={data.details}
            onChange={onHandleChange}
            label="What is your blog post about?"
            placeholder="e.g. describe your blog post"
            className="min-h-0"
            maxLength={300}
            required
         />
      </>
   );
};

export default BlogIntros;
