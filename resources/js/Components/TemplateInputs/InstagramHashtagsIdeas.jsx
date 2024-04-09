import Input from "@/Components/Input";

const InstagramHashtagsIdeas = ({ data, errors, onHandleChange }) => {
   return (
      <Input
         name="keywords"
         value={data.keywords}
         onChange={onHandleChange}
         label="Enter a keyword"
         placeholder="e.g. makeup"
         maxLength={100}
         required
      />
   );
};

export default InstagramHashtagsIdeas;
