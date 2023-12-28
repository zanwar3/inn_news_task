import { Box, Container, Grid, Typography } from "@mui/material";
import {Outlet } from "react-router-dom";
import { useStateContext } from "../context/ContextProvider";
import useAxios from "../hooks/useAxios";
import Header from "./Header";

export default function DefaultLayout() {
  const { user, token, setUser, setToken, notification } = useStateContext();
  const { callApi, loading, error, data } = useAxios();

  const onLogout = async (ev) => {
    ev.preventDefault();

    callApi("/logout", "post")
      .then(() => {
        setUser({});
        setToken(null);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  return (
    <Box className="min-h-screen bg-gray-100">
      <Header/>
      <Container className="mt-4">
        <Grid container spacing={2}>
          <Grid item xs={12}>
            <Outlet/>
          </Grid>
        </Grid>
        {notification && (
          <Box className="fixed bottom-0 right-0 m-4 p-2 bg-white rounded shadow-lg">
            <Typography variant="body1">{notification}</Typography>
          </Box>
        )}
      </Container>
    </Box>
  );
}
