import "./App.css";
import router from "./routes/router";
import { RouterProvider } from "react-router-dom";
import { ContextProvider } from "./context/ContextProvider.jsx";

function App() {
  return (
    <ContextProvider>
      <RouterProvider router={router} />
    </ContextProvider>
  );
}

export default App;
