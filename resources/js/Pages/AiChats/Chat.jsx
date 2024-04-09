import axios from "axios";
import { format } from "date-fns";
import { useEffect, useState } from "react";
import Dashboard from "@/Layouts/Dashboard";
import MenuIcon from "@/Components/Icons/Menu";
import Search from "@/Components/Icons/search";
import ChatIcon from "@/Components/Icons/Chat";
import { Head, router } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import EditIcon from "@/Components/Icons/EditIcon";
import LeftArrow from "@/Components/Icons/LeftArrow";
import ChatMessages from "@/Components/ChatMessages";
import CheckOutline from "@/Components/Icons/CheckOutline";
import InfiniteScroll from "react-infinite-scroll-component";
import { Button, Card, IconButton } from "@material-tailwind/react";
import debounce from "@/utils/debounce";
import { error, formErrors } from "@/utils/toast";

const Chat = (props) => {
   const { auth, active, chat_bot, global } = props;
   const [chats, setChats] = useState(props.chats.data);
   const [chatInfo, setChatInfo] = useState(props.chats);
   const [activeChat, setActiveChat] = useState(null);
   const [sidebarOpen, setSidebarOpen] = useState(false);
   const [hasMore, setHasMore] = useState(true);

   const [title, setTitle] = useState({
      id: "",
      value: "",
   });
   const [titleEdit, setTitleEdit] = useState(null);

   const chatCreate = async () => {
      const chat = {
         chat_bot_id: chat_bot.id,
         title: "New Conversation",
      };
      const res = await axios.post("/ai-chats/chat/create", chat);
      setChats((prev) => [res.data, ...prev]);
      setActiveChat(res.data);
   };

   useEffect(() => {
      if (active) {
         const id = parseInt(active);
         const activeItem = chats.find((item) => item.id === id);
         setActiveChat(activeItem);
      } else {
         setActiveChat(chats[1]);
      }
   }, []);

   const fetchMore = async (info) => {
      const { current_page, last_page } = info;
      if (current_page < last_page) {
         const res = await axios.get(
            `/ai-chats/chats?page=${current_page + 1}&bot_id=${chat_bot.id}`
         );

         setChats((prev) => [...prev, ...res.data.data]);
         setChatInfo(res.data);

         if (res.data.current_page >= res.data.last_page) {
            setHasMore(false);
         } else {
            setHasMore(true);
         }
      } else {
         setHasMore(false);
      }
   };

   const titleSubmit = async (e) => {
      e.preventDefault();
      setTitleEdit(false);

      if (title.value.length > 0) {
         try {
            const res = await axios.put(
               `/ai-chats/chat/update/${title.id}`,
               title
            );

            if (res.data.success) {
               const updated = chats.map((chat) => {
                  if (res.data.result.id === chat.id) {
                     return res.data.result;
                  } else {
                     return chat;
                  }
               });
               setChats(updated);
            } else if (res.data.error) {
               error(res.data.error);
            }
         } catch (error) {
            formErrors(error.response.data.errors.value);
         }
      }
   };

   const searchHandler = debounce(async (e) => {
      const query = e.target.value;
      const res = await axios.get(`/ai-chats/chat/search?value=${query}`);
      setChats(res.data);
      if (res.data.length <= 0) setHasMore(false);
   }, 300);

   return (
      <>
         <Head title="Dashboard" />
         <Breadcrumb Icon={ChatIcon} title={chat_bot.name} />

         <Card className="shadow-card h-[calc(100vh-232px)] md:h-[calc(100vh-266px)] overflow-hidden flex-row justify-end relative">
            <div
               className={`absolute top-0 left-0 z-10 h-full w-0 lg:w-[246px] bg-white  border-r border-gray-100 overflow-hidden transition-all duration-300 ${
                  sidebarOpen ? "w-[246px] shadow-card" : "w-0"
               }`}
            >
               <div className="w-[246px]">
                  <div className="w-full p-7 relative border-b border-gray-100 flex items-center">
                     <div className="w-full md:max-w-[260px] relative">
                        <input
                           type="text"
                           placeholder="Search"
                           onChange={searchHandler}
                           className="h-9 pr-12 pl-4 py-[15px] placeholder:text-gray-400 border border-gray-100 focus:border-primary-500 focus:ring-0 focus:outline-0 rounded-md w-full text-sm font-normal text-gray-500 bg-gray-100"
                        />
                        <Search className="absolute w-4 h-4 top-2.5 right-3 text-gray-400 z-10" />
                     </div>
                     <button
                        className="block lg:hidden absolute top-7 right-0 bg-gray-200 hover:bg-gray-200 active:bg-gray-200 w-5 h-9 text-gray-500 rounded-l-md"
                        onClick={() => setSidebarOpen(false)}
                     >
                        <LeftArrow />
                     </button>
                  </div>

                  <div
                     id="scrollableDiv"
                     className="flex flex-col h-[calc(100vh-420px)] md:h-[calc(100vh-454px)] overflow-auto"
                  >
                     <InfiniteScroll
                        inverse={false}
                        hasMore={hasMore}
                        dataLength={chats.length}
                        scrollableTarget="scrollableDiv"
                        next={() => fetchMore(chatInfo)}
                        style={{ display: "flex", flexDirection: "column" }}
                        loader={<p className="text-center">Loading...</p>}
                        endMessage={
                           <p className="text-center my-2">
                              Yay! You have seen it all
                           </p>
                        }
                     >
                        {chats.map((item) => (
                           <div
                              key={item.id}
                              className={`relative p-5 ${
                                 active == item.id
                                    ? "bg-gray-100 hover:bg-gray-200"
                                    : "bg-gray-25 hover:bg-gray-100"
                              }`}
                           >
                              <div
                                 className="cursor-pointer w-full"
                                 onClick={() =>
                                    titleEdit !== item.id &&
                                    router.get(
                                       `/ai-chats/bot/${chat_bot.id}?chat=${item.id}`
                                    )
                                 }
                              >
                                 {titleEdit === item.id ? (
                                    <form
                                       onSubmit={titleSubmit}
                                       className="relative rounded-md"
                                    >
                                       <input
                                          required
                                          type="text"
                                          placeholder="Edit title"
                                          value={title.value}
                                          onChange={(e) =>
                                             setTitle({
                                                id: item.id,
                                                value: e.target.value,
                                             })
                                          }
                                          className="h-8 pl-2.5 pr-12 py-[12px] placeholder:text-gray-400 outline outline-1 outline-gray-200 focus:outline-primary-500 focus:ring-0 rounded-md w-full text-sm font-normal text-gray-700"
                                          maxLength={20}
                                       />
                                       <button
                                          type="submit"
                                          className="absolute top-0 right-0 w-8 h-full flex items-center justify-center bg-gray-200 rounded-r-md"
                                       >
                                          <CheckOutline className=" text-gray-400 z-10" />
                                       </button>
                                    </form>
                                 ) : (
                                    <p className="text-sm text-gray-700 font-medium">
                                       {item.title}
                                    </p>
                                 )}

                                 <p className="text-sm text-gray-400">
                                    {format(
                                       new Date(item.created_at),
                                       "dd-MM-yyyy ss:mm:hh a"
                                    )}
                                 </p>
                              </div>
                              <div className="absolute top-4 right-4 z-10 w-4 h-4 cursor-pointer">
                                 {titleEdit !== item.id && (
                                    <EditIcon
                                       onClick={() => {
                                          setTitle({
                                             id: item.id,
                                             value: item.title,
                                          });
                                          setTitleEdit(item.id);
                                       }}
                                       className="w-4 h-4 text-gray-400"
                                    />
                                 )}
                              </div>
                           </div>
                        ))}
                     </InfiniteScroll>
                  </div>

                  <div className="p-7">
                     <Button
                        color="white"
                        onClick={chatCreate}
                        className="w-full capitalize bg-primary-500 text-white text-sm !rounded px-7 py-2.5"
                     >
                        New Conversation
                     </Button>
                  </div>
               </div>
            </div>
            <div className="w-full lg:w-[calc(100%-246px)]">
               <div className="p-7 border-b border-gray-100 flex items-center">
                  <IconButton
                     variant="text"
                     color="blue-gray"
                     className="block lg:hidden mr-4"
                     onClick={() => setSidebarOpen(true)}
                  >
                     <MenuIcon />
                  </IconButton>

                  <img
                     src={`/${chat_bot.image}`}
                     alt="ai-bot"
                     className="w-9 h-9 border border-white rounded-lg shadow-card"
                  />
                  <p className="text-lg text-gray-900 font-bold ml-3">
                     {chat_bot.name}
                  </p>
               </div>

               {activeChat && chat_bot && (
                  <ChatMessages
                     auth={auth}
                     chat={activeChat}
                     chat_bot={chat_bot}
                     model={global.model}
                  />
               )}
            </div>
         </Card>
      </>
   );
};

Chat.layout = (page) => <Dashboard children={page} />;

export default Chat;
