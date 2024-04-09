import { Head } from "@inertiajs/react";
import Dashboard from "@/Layouts/Dashboard";
import Breadcrumb from "@/Components/Breadcrumb";
import OpenAISetup from "@/Components/Forms/OpenAISetup";
import OpenAIIcon from "@/Components/Icons/OpenAIIcon";
import OpenAIModel from "@/Components/Forms/OpenAIModel";

const OpenAI = (props) => {
   return (
      <>
         <Head title="OpenAI Settings" />
         <Breadcrumb Icon={OpenAIIcon} title="OpenAI Settings" />

         <OpenAISetup openaiKey={props.app.openai_key} />
         <OpenAIModel model={props.global.model} />
      </>
   );
};

OpenAI.layout = (page) => <Dashboard children={page} />;

export default OpenAI;
