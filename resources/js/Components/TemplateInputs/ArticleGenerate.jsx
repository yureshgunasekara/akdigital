import Input from "../Input";

const ArticleGenerate = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="title"
            value={data.title}
            onChange={onHandleChange}
            label="Article Title"
            placeholder="e.g. Amazing cuisine culture of Mexico"
            maxLength={200}
            required
         />

         <Input
            name="keywords"
            label="Focus Keywords"
            value={data.keywords}
            onChange={onHandleChange}
            placeholder="e.g. key1, key2, (comma seperated)"
            maxLength={200}
            required
         />
      </>
   );
};

export default ArticleGenerate;
