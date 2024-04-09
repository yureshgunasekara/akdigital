import { useMemo, useReducer, createContext, useState, useEffect } from "react";

export const AppContext = createContext(null);

function reducer(state, action) {
   switch (action.type) {
      case "OPEN_SIDENAV": {
         return { ...state, openSidenav: action.value };
      }
      case "MOBILE_SIDENAV": {
         return { ...state, mobileSidenav: action.value };
      }
      case "SIDENAV_TYPE": {
         return { ...state, sidenavType: action.value };
      }
      case "SIDENAV_COLOR": {
         return { ...state, sidenavColor: action.value };
      }
      case "TRANSPARENT_NAVBAR": {
         return { ...state, transparentNavbar: action.value };
      }
      case "FIXED_NAVBAR": {
         return { ...state, fixedNavbar: action.value };
      }
      case "OPEN_CONFIGURATOR": {
         return { ...state, openConfigurator: action.value };
      }
      default: {
         throw new Error(`Unhandled action type: ${action.type}`);
      }
   }
}

export function AppContextProvider({ children }) {
   const initialState = {
      openSidenav: true,
      mobileSidenav: false,
      sidenavColor: "blue",
      sidenavType: "dark",
      transparentNavbar: true,
      fixedNavbar: true,
      openConfigurator: false,
   };

   const [windowWidth, setWindowWidth] = useState(window.innerWidth);
   useEffect(() => {
      const handleResize = () => setWindowWidth(window.innerWidth);
      window.addEventListener("resize", handleResize);
      return () => window.removeEventListener("resize", handleResize);
   }, []);

   useEffect(() => {
      if (windowWidth < 1024) {
         dispatch({ type: "OPEN_SIDENAV", value: false });
      } else {
         dispatch({ type: "OPEN_SIDENAV", value: true });
      }
   }, [windowWidth]);

   const [state, dispatch] = useReducer(reducer, initialState);
   const value = useMemo(() => [state, dispatch], [state, dispatch]);

   return <AppContext.Provider value={value}>{children}</AppContext.Provider>;
}

// Predefine functions
export const setOpenSidenav = (dispatch, value) =>
   dispatch({ type: "OPEN_SIDENAV", value });
export const setMobileSidenav = (dispatch, value) =>
   dispatch({ type: "MOBILE_SIDENAV", value });
export const setSidenavType = (dispatch, value) =>
   dispatch({ type: "SIDENAV_TYPE", value });
export const setSidenavColor = (dispatch, value) =>
   dispatch({ type: "SIDENAV_COLOR", value });
export const setTransparentNavbar = (dispatch, value) =>
   dispatch({ type: "TRANSPARENT_NAVBAR", value });
export const setFixedNavbar = (dispatch, value) =>
   dispatch({ type: "FIXED_NAVBAR", value });
export const setOpenConfigurator = (dispatch, value) =>
   dispatch({ type: "OPEN_CONFIGURATOR", value });
