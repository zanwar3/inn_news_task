import { createContext, useContext, useState } from "react";

const StateContext = createContext({
  user: null,
  token: null,
  notification: null,
  keywords: null,
  parms: null,
  defaultParms: {
    formDate: "",
    toDate: "",
    keywords: "",
    categories: [],
    sources: [],
  },
  setDefaultParms: () => {},
  setKeywords: () => {},
  setParms: () => {},
  setUser: () => {},
  setToken: () => {},
  setNotification: () => {},
});

export const ContextProvider = ({ children }) => {
  const [user, setUser] = useState("");
  const [keywords, setKeywords] = useState("");
  const [parms, setParms] = useState({});
  const [defaultParms, setDefaultParms] = useState({
    formDate: "",
    toDate: "",
    keywords: "",
    categories: ['business','sports','science','health','entertainment','technology'],
    sources: ['google','bbc','forbes','bloomberg'],
  });
  const [token, _setToken] = useState(localStorage.getItem("ACCESS_TOKEN"));
  const [notification, _setNotification] = useState("");

  const setToken = (token) => {
    _setToken(token);
    if (token) {
      localStorage.setItem("ACCESS_TOKEN", token);
    } else {
      localStorage.removeItem("ACCESS_TOKEN");
    }
  };

  const setNotification = (message) => {
    _setNotification(message);

    setTimeout(() => {
      _setNotification("");
    }, 5000);
  };
  return (
    <StateContext.Provider
      value={{
        user,
        setUser,
        token,
        setToken,
        notification,
        setNotification,
        keywords,
        setKeywords,
        parms,
        setParms,
        defaultParms,
        setDefaultParms,
      }}
    >
      {children}
    </StateContext.Provider>
  );
};

export const useStateContext = () => useContext(StateContext);
