import Audio from "./Components/Icons/Audio";
import Chat from "./Components/Icons/Chat";
import Code from "./Components/Icons/Code";
import Control from "./Components/Icons/Control";
import Dashboard from "./Components/Icons/Dashboard";
import Finance from "./Components/Icons/Finance";
import Image from "./Components/Icons/Image";
import Microphone from "./Components/Icons/Microphone";
import Page from "./Components/Icons/Page";
import Pricing from "./Components/Icons/Pricing";
import SaveDocument from "./Components/Icons/SaveDocument";
import Setting from "./Components/Icons/Setting";
import Support from "./Components/Icons/Support";
import Template from "./Components/Icons/Template";
import User from "./Components/Icons/User";
import Users from "./Components/Icons/Users";

const icon = {
   className: "w-4 h-4 text-inherit",
};

export const routes = [
   {
      title: "Overview",
      role: "user-admin",
      pages: [
         {
            icon: <Dashboard {...icon} />,
            name: "Dashboard",
            path: "/dashboard",
            active: true,
         },
         {
            icon: <SaveDocument {...icon} />,
            name: "Saved Documents",
            path: "/saved-documents",
            active: true,
            children: [
               { name: "Template Contents", path: "/template-contents" },
               { name: "Generated Images", path: "/generated-images" },
               { name: "Generated Codes", path: "/generated-codes" },
               { name: "Speech To Texts", path: "/speech-to-text" },
               { name: "Text To Speeches", path: "/text-to-speeches" },
            ],
         },
      ],
   },
   {
      title: "Creations",
      role: "user-admin",
      pages: [
         {
            icon: <Template {...icon} />,
            name: "Templates",
            path: "/templates",
            active: true,
         },
         {
            icon: <Image {...icon} />,
            name: "AI Images",
            path: "/ai-images",
            active: true,
         },
         {
            icon: <Chat {...icon} />,
            name: "AI Chats",
            path: "/ai-chats",
            active: true,
         },
         {
            icon: <Code {...icon} />,
            name: "AI Code",
            path: "/ai-code",
            active: true,
         },
         {
            icon: <Microphone {...icon} />,
            name: "Speech to Text",
            path: "/speech-to-text",
            active: true,
         },
         {
            icon: <Audio {...icon} />,
            name: "Text to Speech",
            path: "/text-to-speech",
            active: true,
         },
      ],
   },
   {
      title: "Account",
      role: "user-admin",
      pages: [
         {
            icon: <User {...icon} />,
            name: "Profile",
            path: "/profile",
            active: true,
         },
         {
            icon: <Pricing {...icon} />,
            name: "Current Plan",
            path: "/current-plan",
            active: true,
         },
         {
            icon: <Support {...icon} />,
            name: "Support Request",
            path: "/support-request",
            active: true,
         },
         {
            icon: <Setting {...icon} />,
            name: "Settings",
            path: "/settings",
            active: true,
            children: [
               { name: "Profile Settings", path: "/profile" },
               { name: "Account Settings", path: "/account" },
            ],
         },
      ],
   },
   {
      title: "Admin Panel",
      role: "admin",
      pages: [
         {
            icon: <Dashboard {...icon} />,
            name: "Dashboard",
            path: "/admin/dashboard",
            active: true,
         },
         {
            icon: <Users {...icon} />,
            name: "Testimonials",
            path: "/admin/testimonials",
            active: true,
         },
         {
            icon: <Support {...icon} />,
            name: "Support Requests",
            path: "/admin/support-requests",
            active: true,
         },
         {
            icon: <Template {...icon} />,
            name: "Templates Management",
            path: "/admin/templates-management",
            active: true,
         },
         {
            icon: <User {...icon} />,
            name: "User Management",
            path: "/admin/user-management",
            active: true,
         },
         {
            icon: <Pricing {...icon} />,
            name: "Pricing Management",
            path: "/admin/pricing-management",
            active: true,
         },
         {
            icon: <Page {...icon} />,
            name: "Page Management",
            path: "/admin/page-management",
            active: true,
         },
         {
            icon: <Finance {...icon} />,
            name: "Finance Management",
            path: "/admin/finance-management",
            active: true,
            children: [
               { name: "Transactions", path: "/transactions" },
               { name: "Subscriptions", path: "/subscriptions" },
            ],
         },
         {
            icon: <Setting {...icon} />,
            name: "Settings",
            path: "/admin/settings",
            active: true,
            children: [
               { name: "Auth Settings", path: "/auth" },
               { name: "Global Settings", path: "/global" },
               { name: "OpenAI Settings", path: "/openai" },
               { name: "SMTP Settings", path: "/smtp" },
               { name: "Payment Settings", path: "/payment" },
            ],
         },
         {
            icon: <Control {...icon} />,
            name: "App Control",
            path: "/admin/app-control",
            active: true,
         },
      ],
   },
];

export default routes;
