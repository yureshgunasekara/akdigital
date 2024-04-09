import TextArea from "@/Components/TextArea";

const SocialMediaPostPersonal = ({ data, errors, onHandleChange }) => {
   return (
      <TextArea
         rows={4}
         name="details"
         value={data.details}
         label="What is this post about?"
         placeholder="e.g. I got fluent in Spanish in I week"
         onChange={onHandleChange}
         maxLength={400}
         required
      />
   );
};

export default SocialMediaPostPersonal;
