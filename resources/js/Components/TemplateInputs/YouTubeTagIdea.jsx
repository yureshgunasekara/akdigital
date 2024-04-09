import TextArea from "@/Components/TextArea";

const YouTubeTagIdea = ({ data, errors, onHandleChange }) => {
   return (
      <TextArea
         rows={2}
         name="title"
         value={data.title}
         label="Enter your video title"
         placeholder="e.g. Describe your video title"
         onChange={onHandleChange}
         maxLength={200}
         required
      />
   );
};

export default YouTubeTagIdea;
