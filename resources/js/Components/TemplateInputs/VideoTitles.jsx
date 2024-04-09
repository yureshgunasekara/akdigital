import TextArea from "@/Components/TextArea";

const VideoTitles = ({ data, errors, onHandleChange }) => {
   return (
      <TextArea
         rows={4}
         name="details"
         value={data.details}
         label="What is your video about?"
         placeholder="e.g. Describe your video description"
         onChange={onHandleChange}
         maxLength={400}
         required
      />
   );
};

export default VideoTitles;
