import "./bootstrap";
import "../css/app.css";
import "simplebar-react/dist/simplebar.min.css";
import { Toaster } from "react-hot-toast";
import { createRoot } from "react-dom/client";
import { createInertiaApp } from "@inertiajs/react";
import { ThemeProvider } from "@material-tailwind/react";
import { AppContextProvider } from "./context/AppContext";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

const appName =
   window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
   title: (title) => `${title} - ${appName}`,
   resolve: async (name) => {
      return resolvePageComponent(
         `./Pages/${name}.jsx`,
         import.meta.glob("./Pages/**/*.jsx")
      );

      // const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true });
      // let page = resolvePageComponent(pages[`./Pages/${name}.jsx`]);
      // page.default.layout =
      //    page.default.layout || ((page) => <DashboardLayout children={page} />);
      // return page;
   },
   setup({ el, App, props }) {
      const root = createRoot(el);

      root.render(
         <ThemeProvider>
            <AppContextProvider>
               <App {...props} />
            </AppContextProvider>

            <Toaster
               position="top-right"
               containerClassName="mt-[90px] overflow-hidden"
               toastOptions={{
                  duration: 5000,
                  className: "mt-6 mr-2",
                  style: { padding: "12px 16px", fontWeight: 500 },
               }}
            />
         </ThemeProvider>
      );
   },
   progress: {
      color: "#4B5563",
   },
});
