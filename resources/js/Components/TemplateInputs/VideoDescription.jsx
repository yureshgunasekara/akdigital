import TextArea from "@/Components/TextArea";

const VideoDescription = ({ data, errors, onHandleChange }) => {
   return (
      <TextArea
         rows={4}
         name="title"
         value={data.title}
         label="What is the title of your video?"
         placeholder="e.g. Describe title of your video"
         onChange={onHandleChange}
         maxLength={400}
         required
      />
   );
};

export default VideoDescription;
