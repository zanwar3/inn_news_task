import { Box } from "@mui/material";
import { Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../context/ContextProvider";

export default function GuestLayout() {
  const {token } = useStateContext();

  if (token) {
    return <Navigate to="/" />;
  }

  return (
    <Box className="min-h-screen bg-gray-100 flex items-center justify-center">
      <Outlet />
    </Box>
  );
}