import { Head } from "@inertiajs/react";
import { Link } from "@inertiajs/react";
import Chat from "@/Components/Icons/Chat";
import Dashboard from "@/Layouts/Dashboard";
import { Card } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Messenger from "@/Components/Icons/Messenger";

const Badge = ({ access }) => {
   return (
      <span className="absolute top-2.5 right-0 rounded-l-full bg-warning-500 text-xs text-gray-900 px-2 py-0.5">
         {access}
      </span>
   );
};

const ChatBots = (props) => {
   const { auth, chat_bots, current_plan } = props;

   const getUrl = (bot) => {
      if (bot.chats.length > 0) {
         const first = bot.chats[bot.chats.length - 1];
         return `/ai-chats/bot/${bot.id}?chat=${first.id}`;
      } else {
         return `/ai-chats/bot/${bot.id}`;
      }
   };

   const badge = (access) => {
      if (auth.user.role === "admin") {
         return <Badge access={access} />;
      }
      if (current_plan.access_chat_bot === "Free") {
         if (access === "Free") {
            return;
         } else {
            return <Badge access={access} />;
         }
      } else if (current_plan.access_chat_bot === "Standard") {
         if (access === "Free" || access === "Standard") {
            return;
         } else {
            return <Badge access={access} />;
         }
      } else if (current_plan.access_chat_bot === "Premium") {
         return;
      } else {
         return <Badge access={access} />;
      }
   };

   return (
      <>
         <Head title="Dashboard" />
         <Breadcrumb Icon={Chat} title="Chat Bots" />

         <Card className="!shadow-card p-7 overflow-hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
            {chat_bots.map((item) => (
               <Card
                  key={item.id}
                  className="shadow-card rounded-lg bg-gray-100 hover:bg-primary-50 flex items-center group p-7"
               >
                  {badge(item.access_plan)}
                  <img
                     src={item.image}
                     alt="ui-lib chat bots"
                     className="w-[120px] h-[120px] mx-auto rounded-full shadow-card"
                  />
                  <p className="text-lg text-gray-900 font-bold mt-3">
                     {item.name}
                  </p>
                  <p className="text-sm text-gray-700 mt-1 mb-4">{item.role}</p>

                  <Link href={getUrl(item)}>
                     <button
                        type="button"
                        className="relative flex items-center justify-center hover:scale-110 active:scale-100 h-11 w-11  duration-700"
                     >
                        <div className="bg-primary-500 absolute inset-0 w-full rounded-full group-hover:animate-ping group-hover:button-ripple"></div>
                        <div className="absolute inset-0 w-full rounded-full shadow-xl bg-primary-500"></div>
                        <div className="relative">
                           <Messenger className="text-white w-6 h-6" />
                        </div>
                     </button>
                  </Link>
               </Card>
            ))}
         </Card>
      </>
   );
};

ChatBots.layout = (page) => <Dashboard children={page} />;

export default ChatBots;
