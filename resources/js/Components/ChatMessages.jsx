import axios from "axios";
import { useForm } from "@inertiajs/react";
import { useEffect, useState } from "react";
import UserCircle from "./Icons/UserCircle";
import { error, warning } from "@/utils/toast";
import { Button } from "@material-tailwind/react";
import InfiniteScroll from "react-infinite-scroll-component";

const ChatMessages = (props) => {
   const { auth, chat, model, chat_bot } = props;
   const [hasMore, setHasMore] = useState(true);
   const [messages, setMessages] = useState([]);
   const [messageInfo, setMessageInfo] = useState(null);
   const [botTyping, setBotTyping] = useState(false);

   const { data, setData, reset } = useForm({
      message: "",
      bot_id: chat_bot.id,
      chat_id: chat.id,
      prompt: chat_bot.prompt,
      model: model,
   });

   const submit = async (e) => {
      e.preventDefault();
      setBotTyping(true);

      if (data.message.length > 0) {
         const userMessage = {
            role: "user",
            message: data.message,
         };
         setMessages((prev) => [...prev, userMessage]);
         reset("message");

         const res = await axios.post("/ai-chats", data);
         if (res.data.error) {
            error(res.data.error);
            setBotTyping(false);
         } else if (res.data.warning) {
            warning(res.data.warning);
            setBotTyping(false);
         } else {
            setMessages((prev) => [...prev, res.data]);
            setBotTyping(false);
         }
      }
   };

   useEffect(() => {
      (async () => {
         const res = await axios.get(
            `/ai-chats/bot/messages/${chat_bot.id}/${chat.id}`
         );
         setMessages((prev) => [...prev, ...res.data.data]);
         setMessageInfo(res.data);
         if (res.data.current_page >= res.data.last_page) {
            setHasMore(false);
         } else {
            setHasMore(true);
         }
      })();
   }, []);

   const fetchMore = async (info) => {
      const res = await axios.get(info.next_page_url);
      setMessages((prev) => [...res.data.data, ...prev]);
      setMessageInfo(res.data);

      if (res.data.current_page >= res.data.last_page) {
         setHasMore(false);
      } else {
         setHasMore(true);
      }
   };

   return (
      <>
         <div
            id="scrollableDiv"
            className="flex flex-col-reverse overflow-auto h-[calc(100vh-420px)] md:h-[calc(100vh-454px)]"
         >
            <InfiniteScroll
               inverse={true} //
               hasMore={hasMore}
               dataLength={messages.length}
               next={() => fetchMore(messageInfo)}
               scrollableTarget="scrollableDiv"
               style={{ display: "flex", flexDirection: "column-reverse" }}
               loader={<p className="text-center">Loading...</p>}
               endMessage={
                  <p className="text-center">Yay! You have seen it all</p>
               }
            >
               <div className="px-7 py-3.5 flex flex-col">
                  {messages.length > 0 &&
                     messages.map((item) =>
                        item.role === "user" ? (
                           <dib key={item.id} className="w-full py-3.5 ">
                              <div className="max-w-[80%] flex float-right">
                                 <p className="p-5 text-sm bg-primary-25 text-gray-700 rounded-lg">
                                    {item.message}
                                 </p>
                                 {auth.user.image ? (
                                    <img
                                       src={`/${auth.user.image}`}
                                       alt="ai-bot"
                                       className="w-9 h-9 ml-5 border border-white rounded-lg shadow-card"
                                    />
                                 ) : (
                                    <UserCircle className="h-10 w-10 text-blue-gray-500 lg:m-1 cursor-pointer" />
                                 )}
                              </div>
                           </dib>
                        ) : (
                           <div
                              key={item.id}
                              className="py-3.5 max-w-[80%] flex"
                           >
                              <img
                                 src={`/${chat_bot.image}`}
                                 alt="ai-bot"
                                 className="w-9 h-9 mr-5 border border-white rounded-lg shadow-card"
                              />
                              <div className="w-full flex flex-col">
                                 <pre className="p-5 text-sm bg-primary-25 text-gray-700 rounded-lg whitespace-pre-wrap">
                                    {item.message}
                                 </pre>
                              </div>
                           </div>
                        )
                     )}

                  {botTyping && (
                     <div className="py-3.5 max-w-[80%] flex">
                        <img
                           src={`/${chat_bot.image}`}
                           alt="ai-bot"
                           className="w-9 h-9 mr-5 border border-white rounded-lg shadow-card"
                        />
                        <p className="p-5 text-sm bg-primary-25 text-gray-700 rounded-lg">
                           Typing...
                        </p>
                     </div>
                  )}
               </div>
            </InfiniteScroll>
         </div>

         <form
            onSubmit={submit}
            className="p-7 border-t border-gray-100 flex items-center"
         >
            <input
               type="text"
               value={data.message}
               onChange={(e) => setData("message", e.target.value)}
               placeholder="Enter a message here To send, press (shift + enter)."
               className="w-full h-[38px] placeholder:text-gray-400 text-sm outline-0 pr-2"
            />
            <Button
               type="submit"
               color="white"
               className="capitalize bg-primary-500 text-white text-sm !rounded px-7 py-2.5"
            >
               Send
            </Button>
         </form>
      </>
   );
};

export default ChatMessages;
