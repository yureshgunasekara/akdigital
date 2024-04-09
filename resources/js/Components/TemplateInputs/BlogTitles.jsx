import TextArea from "@/Components/TextArea";

const BlogTitles = ({ data, errors, onHandleChange }) => {
   return (
      <TextArea
         rows={4}
         name="details"
         value={data.details}
         label="What is your blog post is about?"
         placeholder="e.g. Describe your blog post"
         onChange={onHandleChange}
         maxLength={400}
         required
      />
   );
};

export default BlogTitles;
