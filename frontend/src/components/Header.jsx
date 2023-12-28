// Header.jsx
import React from "react";
import { AppBar, Toolbar, Button } from "@mui/material";
import { useStateContext } from "../context/ContextProvider";
import useAxios from "../hooks/useAxios";
import { useNavigate } from "react-router-dom";

export default function Header() {
  const { user, token, setUser, setToken } = useStateContext();

  const { callApi } = useAxios();
  const navigate = useNavigate();
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
    <AppBar position="sticky">
      <Toolbar sx={{ display: "flex", justifyContent: "space-between" }}>
        {token ? (
          <>
            <div>
              <p style={{ color: "whitesmoke" }}>{user}</p>
            </div>
            <div>
              <Button color="inherit" onClick={() => navigate("/")}>
                All
              </Button>
              <Button color="inherit" onClick={() => navigate("/my_news")}>
                Feed
              </Button>
              <Button color="inherit" onClick={onLogout}>
                Logout
              </Button>
            </div>
          </>
        ) : (
          <>
            <div></div>
            <div>
              <Button color="inherit" onClick={() => navigate("/login")}>
                Login
              </Button>
              <Button color="inherit" onClick={() => navigate("/signup")}>
                Sign Up
              </Button>
            </div>
          </>
        )}
      </Toolbar>
    </AppBar>
  );
}
