import { createBrowserRouter,Navigate } from "react-router-dom";
import DefaultLayout from "../components/DefaultLayout";
import GuestLayout from "../components/GuestLayout";
import Login from "../pages/Login";
import NotFound from "../pages/NotFound";
import Signup from "../pages/Signup";
import News from "../pages/News.jsx";
import MyNews from "../pages/MyNews.jsx";

const router = createBrowserRouter([
  {
    path: "/",
    element: <DefaultLayout />,
    children: [
      {
        path: "/",
        element: <News />,
      },
      {
        path: "/my_news",
        element: <MyNews />,
      },
    ],
  },
  {
    path: "/",
    element: <GuestLayout />,
    children: [
      {
        path: "/login",
        element: <Login />,
      },
      {
        path: "/signup",
        element: <Signup />,
      },
    ],
  },
  {
    path: "*",
    element: <NotFound />,
  },
]);

export default router;
