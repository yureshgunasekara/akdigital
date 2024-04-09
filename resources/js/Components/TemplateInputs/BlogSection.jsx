import TextArea from "../TextArea";

const BlogSection = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <TextArea
            rows={3}
            name="title"
            value={data.title}
            onChange={onHandleChange}
            label="Title of your blog article?"
            placeholder="e.g. 5 best places to visit Spain"
            className="min-h-0"
            maxLength={300}
            required
         />

         <TextArea
            rows={3}
            name="subheadings"
            value={data.subheadings}
            onChange={onHandleChange}
            label="Subheadings"
            placeholder="e.g. Barcelona, San Sebastian, Madrid"
            className="min-h-0"
            maxLength={300}
            required
         />
      </>
   );
};

export default BlogSection;
